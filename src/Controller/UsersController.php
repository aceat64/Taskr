<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        // Allow actions to public
        $this->Auth->allow(['login','logout','register','view']);

        parent::beforeFilter($event);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->params['action'];

        // Allow actions to logged in users
        if (in_array($action, ['profile','settings'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    /**
    * Register method
    *
    * @return void
    */
    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            // Don't let them set any of these fields
            $this->request->data['admin'] = false;
            $this->request->data['credits'] = 0;
            $this->request->data['lifetime_points'] = 0;
            $this->request->data['votes_count'] = 0;

            if ($this->request->data['password'] != $this->request->data['confirm_password']) {
                $this->Flash->error('Your passwords did not match. Please, try again.');
                unset($this->request->data['password']);
            } else {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Flash->success('Your account has been create.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('Your account could not be created. Please, try again.');
                }
            }
        }
        unset($user->password);
        unset($this->request->data['password']);
        unset($this->request->data['confirm_password']);
        $this->set(compact('user'));
    }

    /**
    * Profile method
    *
    * @return void
    */
    public function profile()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Comments', 'Completions', 'Flags', 'Gifts', 'Tasks', 'Votes']
        ]);
        $this->set('user', $user);
    }

    /**
    * Settings method
    *
    * @return void
    */
    public function settings()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->data['id'] != $this->Auth->user('id')) {
                throw new BadRequestException('Invalid user ID');
            }
            if ($this->request->data['password'] != $this->request->data['confirm_password']) {
                $this->Flash->error('Your passwords did not match. Please, try again.');
                unset($this->request->data['password']);
            } else {
                if (!$this->request->data['confirm_password']) {
                    unset($this->request->data['password']);
                }

                // Don't let them change any of these fields
                unset($this->request->data['username']);
                unset($this->request->data['admin']);
                unset($this->request->data['credits']);
                unset($this->request->data['lifetime_points']);
                unset($this->request->data['votes_count']);

                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Flash->success('Your profile has been updated.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('Your profile could not be saved. Please, try again.');
                }
            }
        }
        unset($user->password);
        $this->set(compact('user'));
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->Users));
    }

    /**
     * View method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Comments', 'Completions', 'Flags', 'Gifts', 'Tasks', 'Votes']
        ]);
        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            // Don't let them set any of these fields
            $this->request->data['credits'] = 0;
            $this->request->data['lifetime_points'] = 0;
            $this->request->data['votes_count'] = 0;

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!$this->request->data['password']) {
                unset($this->request->data['password']);
            }

            // Don't let them set any of these fields
            unset($this->request->data['votes_count']);

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        unset($user->password);
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
