<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Tasks.created' => 'asc'
        ],
        'contain' => [
            'Users',
            'Tags',
            'Votes'
        ],
        'sortWhitelist' => [
            'id',
            'name',
            'created',
            'Users.username',
            'total_points',
            'base_points',
            'gift_points',
            'vote_count',
            'comment_count'
        ]
    ];

    public function beforeFilter(\Cake\Event\Event $event)
    {
        // Allow actions to public
        $this->Auth->allow(['index', 'view', 'leaderboard']);

        parent::beforeFilter($event);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->params['action'];

        // Allow actions to logged in users
        if (in_array($action, ['create',  'like', 'unlike'])) {
            return true;
        }

        if ($action == 'edit') {
            // Edit action requires an id.
            if (empty($this->request->params['pass'][0])) {
                return false;
            }

            // Check that the task belongs to the current user.
            $id = $this->request->params['pass'][0];
            $task = $this->Tasks->get($id);
            if ($task->user_id == $user['id']) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index($status = null)
    {
        switch ($status) {
            case 'open':
            case 'completed':
            case 'closed':
                $this->paginate['conditions'] = ['status' => $status];
                break;
            case null:
                // default to showing open tasks
                $this->paginate['conditions'] = ['status' => 'open'];
                break;
            // all others, assume they wanted all and don't set a condition
        }

        $this->set('tasks', $this->paginate($this->Tasks));
    }

    /**
     * View method
     *
     * @param string|null $id Task id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Users', 'Tags', 'Comments', 'Completions', 'Gifts' => ['Users'], 'Votes' => ['Users']]
        ]);
        $this->set('task', $task);
    }

    public function tagged()
    {
        $tags = $this->request->params['pass'];
        $tasks = $this->Tasks->find('tagged', [
            'tags' => $tags
        ]);
        $this->set(compact('tasks', 'tags'));
    }

    /**
    * Leaderboard method
    *
    * @return void
    */
    public function leaderboard()
    {
        // Nothing here yet
    }

    /**
     * Add method
     *
     * @return void
     */
    public function create()
    {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            // Don't let them set any of these fields
            $this->request->data['status'] = 'open';
            $this->request->data['user_id'] = $this->Auth->user('id');
            $this->request->data['base_points'] = 1;
            $this->request->data['gift_points'] = 0;
            $this->request->data['votes_count'] = 0;
            $this->request->data['completions_count'] = 0;
            $this->request->data['comments_count'] = 0;

            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success('The task has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The task could not be saved. Please, try again.');
            }
        }
        $this->set(compact('task'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Tags']
        ]);

        if (in_array($task->status, ['completed', 'closed'])) {
            $this->Flash->error('You can not edit a task that has been completed or closed.');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Don't let them change any of these fields
            unset($this->request->data['id']);
            unset($this->request->data['status']);
            unset($this->request->data['user_id']);
            unset($this->request->data['base_points']);
            unset($this->request->data['gift_points']);
            unset($this->request->data['votes_count']);
            unset($this->request->data['completions_count']);
            unset($this->request->data['comments_count']);

            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success('The task has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The task could not be saved. Please, try again.');
            }
        }
        $this->set(compact('task'));
    }

    /**
    * like method
    *
    * @param string|null $id Task id
    * @return void
    * @throws \Cake\Network\Exception\NotFoundException
    */
    public function like($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $task = $this->Tasks->get($id);

        if ($task->user_id == $this->Auth->user('id')) {
            $this->Flash->error('You are not allowed to like your own tasks!');
            return $this->redirect($this->referer());
        }

        if ($task->status != 'open') {
            $this->Flash->error('This task is not open and can not be liked.');
            return $this->redirect($this->referer());
        }

        $vote = $this->Tasks->Votes->find(
            'all',
            ['conditions' => ['user_id' => $this->Auth->user('id'), 'task_id' => $id]]
        );

        // No previous vote by this user, so create a new one
        if ($vote->first() === null) {
            $this->Tasks->Votes->save(
                $this->Tasks->Votes->newEntity(['task_id' => $task->id, 'user_id' => $this->Auth->user('id')])
            );
        }

        return $this->redirect($this->referer());
    }

    /**
    * unlike method
    *
    * @param string|null $id Task id
    * @return void
    * @throws \Cake\Network\Exception\NotFoundException
    */
    public function unlike($id = null)
    {
        // I feel like this whole method is done wrong
        $this->request->allowMethod(['post', 'delete']);

        $task = $this->Tasks->get($id);

        if ($task->status != 'open') {
            $this->Flash->error('This task is not open and can not be unliked.');
            return $this->redirect($this->referer());
        }

        $votes = $this->Tasks->Votes->find(
            'all',
            ['conditions' => ['user_id' => $this->Auth->user('id'), 'task_id' => $id]]
        );

        $first = $votes->first();

        if ($first) {
            $this->Tasks->Votes->delete($this->Tasks->Votes->get($first->id));
        }
        return $this->redirect($this->referer());
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success('The task has been deleted.');
        } else {
            $this->Flash->error('The task could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
