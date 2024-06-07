<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 */
class BooksController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('BooksLayout');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Books->find()
            ->contain(['Publishers', 'Authors']);
        $books = $this->paginate($query);

        $this->set(compact('books'));
    }

    public function fetchBooksByFilters() {
        $this->autoRender = false; 
        
        $authors = $this->request->getQuery('authors');
        $publishers = $this->request->getQuery('publishers');
        $conditions = [];

        if (!empty($authors)) {
            $authorIds = explode(',', $authors);
            $conditions['Books.author_id IN'] = $authorIds;
        }

        if (!empty($publishers)) {
            $publisherIds = explode(',', $publishers);
            $conditions['Books.publisher_id IN'] = $publisherIds;
        }

        $books = $this->Books->find('all', [
            'conditions' => $conditions,
            'contain' => ['Authors', 'Publishers'] 
        ])->toArray();

        // return books as json 
        echo json_encode($books);
    }

    public function fetchBooksBySearch() {
        $this->autoRender = false;
        $search = $this->request->getQuery('search');
    
        $books = $this->Books->find('all', [
            'conditions' => ['Books.title LIKE' => '%' . $search . '%'],
            'contain' => ['Authors', 'Publishers']
        ]);
    
        echo json_encode($books);
        $this->set(compact('books'));
        $this->viewBuilder()->setOption('serialize', ['books']);
    }
  
    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $book = $this->Books->get($id, contain: ['Publishers', 'Authors']);
        $this->set(compact('book'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $book = $this->Books->newEmptyEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $publishers = $this->Books->Publishers->find('list', limit: 200)->all();
        $authors = $this->Books->Authors->find('list', limit: 200)->all();
        $this->set(compact('book', 'publishers', 'authors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $book = $this->Books->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $publishers = $this->Books->Publishers->find('list', limit: 200)->all();
        $authors = $this->Books->Authors->find('list', limit: 200)->all();
        $this->set(compact('book', 'publishers', 'authors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
