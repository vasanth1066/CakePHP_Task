<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
  

public function index()
{
    //get logged in user information
    $loggedInUser = $this->request->getSession()->read('Auth');
    $userId = $loggedInUser['id'];
    $orders = $this->Orders->find('all', [
        'conditions' => ['Orders.user_id' => $userId],
        'contain' => ['OrderItems' => ['Books']]
    ]);
    $this->set(compact('orders'));
    $this->viewBuilder()->setLayout('UsersLayout');

}

      
public function checkout()
{
    $session = $this->request->getSession();
    $cart = $session->read('Cart') ?? [];
    $loggedInUser = $this->request->getSession()->read('Auth');
    
    $userId = $loggedInUser['id'];

    if ($this->request->is('post')) {
        // create a new entity
        $orderData = [
            'user_id' => $loggedInUser['id'],
            'total_price' => array_sum(array_map(function($item) {
                return $item['quantity'] * $item['price'];
            }, $cart)),
            'created' => date('Y-m-d H:i:s')
        ];
        $order = $this->Orders->newEntity($orderData);

        if ($this->Orders->save($order)) {
            // save each order item to database
            foreach ($cart as $item) {
                $orderItemData = [
                    'order_id' => $order->id,
                    'book_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ];
                $orderItem = $this->Orders->OrderItems->newEntity($orderItemData);
                $this->Orders->OrderItems->save($orderItem);
            }

            $session->delete('Cart');
            $this->Flash->success('Order placed successfully.');
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error('Could not place the order.');
        }
    }

    $this->set(compact('cart'));
    $this->viewBuilder()->setLayout('UsersLayout');

}




    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, contain: ['Users', 'OrderItems']);
        $this->set(compact('order'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $this->set(compact('order', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $this->set(compact('order', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
