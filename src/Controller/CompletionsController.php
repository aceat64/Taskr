<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Completions Controller
 *
 * @property \App\Model\Table\CompletionsTable $Completions
 */
class CompletionsController extends AppController
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
        $this->set('completions', $this->paginate($this->Completions));
    }

    /**
     * View method
     *
     * @param string|null $id Completion id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $completion = $this->Completions->get($id, [
            'contain' => ['Tasks', 'Users', 'Flags']
        ]);
        $this->set('completion', $completion);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $completion = $this->Completions->newEntity();
        if ($this->request->is('post')) {
            $completion = $this->Completions->patchEntity($completion, $this->request->data);
            if ($this->Completions->save($completion)) {
                $this->Flash->success('The completion has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The completion could not be saved. Please, try again.');
            }
        }
        $tasks = $this->Completions->Tasks->find('list', ['limit' => 200]);
        $users = $this->Completions->Users->find('list', ['limit' => 200]);
        $this->set(compact('completion', 'tasks', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Completion id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $completion = $this->Completions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $completion = $this->Completions->patchEntity($completion, $this->request->data);
            if ($this->Completions->save($completion)) {
                $this->Flash->success('The completion has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The completion could not be saved. Please, try again.');
            }
        }
        $tasks = $this->Completions->Tasks->find('list', ['limit' => 200]);
        $users = $this->Completions->Users->find('list', ['limit' => 200]);
        $this->set(compact('completion', 'tasks', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Completion id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $completion = $this->Completions->get($id);
        if ($this->Completions->delete($completion)) {
            $this->Flash->success('The completion has been deleted.');
        } else {
            $this->Flash->error('The completion could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
