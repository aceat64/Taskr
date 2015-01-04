<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Flags Controller
 *
 * @property \App\Model\Table\FlagsTable $Flags
 */
class FlagsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Completions', 'Users']
        ];
        $this->set('flags', $this->paginate($this->Flags));
    }

    /**
     * View method
     *
     * @param string|null $id Flag id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $flag = $this->Flags->get($id, [
            'contain' => ['Completions', 'Users']
        ]);
        $this->set('flag', $flag);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $flag = $this->Flags->newEntity();
        if ($this->request->is('post')) {
            $flag = $this->Flags->patchEntity($flag, $this->request->data);
            if ($this->Flags->save($flag)) {
                $this->Flash->success('The flag has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The flag could not be saved. Please, try again.');
            }
        }
        $completions = $this->Flags->Completions->find('list', ['limit' => 200]);
        $users = $this->Flags->Users->find('list', ['limit' => 200]);
        $this->set(compact('flag', 'completions', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Flag id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $flag = $this->Flags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flag = $this->Flags->patchEntity($flag, $this->request->data);
            if ($this->Flags->save($flag)) {
                $this->Flash->success('The flag has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The flag could not be saved. Please, try again.');
            }
        }
        $completions = $this->Flags->Completions->find('list', ['limit' => 200]);
        $users = $this->Flags->Users->find('list', ['limit' => 200]);
        $this->set(compact('flag', 'completions', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Flag id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $flag = $this->Flags->get($id);
        if ($this->Flags->delete($flag)) {
            $this->Flash->success('The flag has been deleted.');
        } else {
            $this->Flash->error('The flag could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
