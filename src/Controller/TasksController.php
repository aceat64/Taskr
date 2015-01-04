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
    public function beforeFilter(\Cake\Event\Event $event)
    {
        // Allow actions to public
        $this->Auth->allow(['index','view','tags']);

        parent::beforeFilter($event);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->params['action'];

        // Allow actions to logged in users
        if (in_array($action, ['add'])) {
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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
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
            'contain' => ['Users', 'Tags', 'Comments', 'Completions', 'Gifts', 'Votes']
        ]);
        $this->set('task', $task);
    }

    public function tags()
    {
        $tags = $this->request->params['pass'];
        $tasks = $this->Tasks->find('tagged', [
            'tags' => $tags
        ]);
        $this->set(compact('tasks', 'tags'));
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success('The task has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The task could not be saved. Please, try again.');
            }
        }
        $users = $this->Tasks->Users->find('list', ['limit' => 200]);
        $tags = $this->Tasks->Tags->find('list', ['limit' => 200]);
        $this->set(compact('task', 'users', 'tags'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->data);
            if ($this->Tasks->save($task)) {
                $this->Flash->success('The task has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The task could not be saved. Please, try again.');
            }
        }
        $users = $this->Tasks->Users->find('list', ['limit' => 200]);
        $tags = $this->Tasks->Tags->find('list', ['limit' => 200]);
        $this->set(compact('task', 'users', 'tags'));
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
