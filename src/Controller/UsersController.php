<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {

            //save data in session
            // $user = $this->Authentication->getIdentity();
            // $this->Auth->setUser($user);
            
            // redirect 
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Books',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);

        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }

        $this->viewBuilder()->setLayout('login');

    }


    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login','register']);
    }
    public function logout()
    {

        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            // clear the session
            // $this->request->getSession()->destroy();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Successfully Register.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable Register.'));
        }
        $this->set('user', $user);
        $this->viewBuilder()->setLayout('login');

    }   
   
    
    public function dashboard() {
        $this->viewBuilder()->setLayout('UsersLayout');

        // fetch publishers, authors, and books
        $publishersTable = TableRegistry::getTableLocator()->get('Publishers');
        $publishers = $publishersTable->find('all');
        
        $authorsTable = TableRegistry::getTableLocator()->get('Authors');
        $authors = $authorsTable->find('all');
        
        $booksTable = TableRegistry::getTableLocator()->get('Books');
        $books = $booksTable->find()
        ->contain(['Authors', 'Publishers'])
        ->all();

        $this->set(compact('publishers', 'authors', 'books'));
    }
    // /**
    //  * Index method
    //  *
    //  * @return \Cake\Http\Response|null|void Renders view
    //  */
    // public function index()
    // {
    //     $query = $this->Users->find();
    //     $users = $this->paginate($query);

    //     $this->set(compact('users'));
    // }

    // /**
    //  * View method
    //  *
    //  * @param string|null $id User id.
    //  * @return \Cake\Http\Response|null|void Renders view
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function view($id = null)
    // {
    //     $user = $this->Users->get($id, contain: ['Articles']);
    //     $this->set(compact('user'));
    // }

    // /**
    //  * Add method
    //  *
    //  * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
    //  */
    // public function add()
    // {
    //     $user = $this->Users->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $user = $this->Users->patchEntity($user, $this->request->getData());
    //         if ($this->Users->save($user)) {
    //             $this->Flash->success(__('The user has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The user could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('user'));
    // }

    // /**
    //  * Edit method
    //  *
    //  * @param string|null $id User id.
    //  * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function edit($id = null)
    // {
    //     $user = $this->Users->get($id, contain: []);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $user = $this->Users->patchEntity($user, $this->request->getData());
    //         if ($this->Users->save($user)) {
    //             $this->Flash->success(__('The user has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The user could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('user'));
    // }

    // /**
    //  * Delete method
    //  *
    //  * @param string|null $id User id.
    //  * @return \Cake\Http\Response|null Redirects to index.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $user = $this->Users->get($id);
    //     if ($this->Users->delete($user)) {
    //         $this->Flash->success(__('The user has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
