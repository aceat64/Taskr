<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Votes Controller
 *
 * @property \App\Model\Table\VotesTable $Votes
 */
class VotesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tasks', 'Users']
        ];
        $this->set('votes', $this->paginate($this->Votes));
    }

    /**
     * View method
     *
     * @param string|null $id Vote id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $vote = $this->Votes->get($id, [
            'contain' => ['Tasks', 'Users']
        ]);
        $this->set('vote', $vote);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $vote = $this->Votes->newEntity();
        if ($this->request->is('post')) {
            $vote = $this->Votes->patchEntity($vote, $this->request->data);
            if ($this->Votes->save($vote)) {
                $this->Flash->success('The vote has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The vote could not be saved. Please, try again.');
            }
        }
        $tasks = $this->Votes->Tasks->find('list', ['limit' => 200]);
        $users = $this->Votes->Users->find('list', ['limit' => 200]);
        $this->set(compact('vote', 'tasks', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vote id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $vote = $this->Votes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vote = $this->Votes->patchEntity($vote, $this->request->data);
            if ($this->Votes->save($vote)) {
                $this->Flash->success('The vote has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The vote could not be saved. Please, try again.');
            }
        }
        $tasks = $this->Votes->Tasks->find('list', ['limit' => 200]);
        $users = $this->Votes->Users->find('list', ['limit' => 200]);
        $this->set(compact('vote', 'tasks', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vote id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vote = $this->Votes->get($id);
        if ($this->Votes->delete($vote)) {
            $this->Flash->success('The vote has been deleted.');
        } else {
            $this->Flash->error('The vote could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
