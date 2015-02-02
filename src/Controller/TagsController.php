<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 */
class TagsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        // Allow actions to public
        $this->Auth->allow(['index', 'view']);

        parent::beforeFilter($event);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('tags', $this->paginate($this->Tags));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['Tasks', 'TasksTags']
        ]);
        $this->set('tag', $tag);
    }
}
