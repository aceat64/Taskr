<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Gifts Controller
 *
 * @property \App\Model\Table\GiftsTable $Gifts
 */
class GiftsController extends AppController
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
        $this->set('gifts', $this->paginate($this->Gifts));
    }

    /**
     * View method
     *
     * @param string|null $id Gift id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $gift = $this->Gifts->get($id, [
            'contain' => ['Tasks', 'Users']
        ]);
        $this->set('gift', $gift);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $gift = $this->Gifts->newEntity();
        if ($this->request->is('post')) {
            $gift = $this->Gifts->patchEntity($gift, $this->request->data);
            if ($this->Gifts->save($gift)) {
                $this->Flash->success('The gift has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The gift could not be saved. Please, try again.');
            }
        }
        $tasks = $this->Gifts->Tasks->find('list', ['limit' => 200]);
        $users = $this->Gifts->Users->find('list', ['limit' => 200]);
        $this->set(compact('gift', 'tasks', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gift id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $gift = $this->Gifts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gift = $this->Gifts->patchEntity($gift, $this->request->data);
            if ($this->Gifts->save($gift)) {
                $this->Flash->success('The gift has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The gift could not be saved. Please, try again.');
            }
        }
        $tasks = $this->Gifts->Tasks->find('list', ['limit' => 200]);
        $users = $this->Gifts->Users->find('list', ['limit' => 200]);
        $this->set(compact('gift', 'tasks', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gift id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gift = $this->Gifts->get($id);
        if ($this->Gifts->delete($gift)) {
            $this->Flash->success('The gift has been deleted.');
        } else {
            $this->Flash->error('The gift could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
