<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;


class TestsController extends AppController {

    public $helpers = ['Html', 'Form', 'Session'];

    

    // default view 
    public function show()
    {
      // passing values to Views
      $data = ['value1' => 'Passing the value to the view from TestsController show() method', 'value2' => 'Successfully done '];
      $this->set('data', $data);


    // redirect to another action within the same controller
    //   return $this->redirect(['action' => 'customView']);

    }

    // customizable view file render
    public function customView()
    {
      // 	redirect to another action and current action

    //   $this->viewBuilder()->setTemplate('custom_view');


      // 	Set layout and element for an action or controller.
    

      $this->viewBuilder()->setLayout('ajax');
   
    }

    public function redirectToAnotherAction()
    {
        return $this->redirect(['action' => 'show']);
    }

    
    public function redirectToAnotherControllerAction()
    {
        return $this->redirect(['controller' => 'Books', 'action' => 'index']);
    }

     public function add()
    {
        $test = $this->Tests->newEmptyEntity();

        if ($this->request->is('post')) {
            $test = $this->Tests->patchEntity($test, $this->request->getData());
            if ($this->Tests->save($test)) {
                $this->Flash->success(__('Data Successfully Saved.'));
                return $this->redirect(['action' => 'display']);
            }
            $this->Flash->error(__('Unable to add the data.'));
        }

        $this->set('test', $test);
        $this->render('add_edit');
    }

    public function edit($id = null)
    {
        $test = $this->Tests->get($id);

        if ($this->request->is(['post', 'put'])) {
            $test = $this->Tests->patchEntity($test, $this->request->getData());
            if ($this->Tests->save($test)) {
                $this->Flash->success(('Data Successfully updated.'));
                return $this->redirect(['action' => 'display']);
            }
            $this->Flash->error(('Unable to update the data.'));
        }

        $this->set('test', $test);
        $this->render('add_edit');
    }


    public function display()
    {

        // Add search form in index page with custom search fields based on the selection like (name, price etc...)

        $key= $this->request->getQuery('key');
        if($key){
            //  using get method (where)
            // $query=$this->Tests->find('all')->where(['first_name like'=>'%'.$key.'%']);
            // dynamic finder
            $query=$this->Tests->findByFirstName($key);

        }else{
            $query=$this->Tests;
        }

        $this->paginate = [
            'limit' => 5, // Number of items in per page
            'order' => ['created' => 'asc'], 
        ];
    
        // Retrieve paginated data from the Tests model
        $tests = $this->paginate($query);
        // $tests = $this->Tests->find('all'); // fetch all data
       
        $this->set(compact('tests'));
    }

    // Use AJAX for displaying the records in index for following actions:

    public function fetchdata()
    {
      
        $data = $this->Tests->find('all')->toArray();
     
        $response = [
            'success' => true,
            'data' => $data,
        ];

        // Return response as JSON
        $this->response = $this->response->withType('application/json')->withStringBody(json_encode($response));
        return $this->response;
    }

    public function datas()
    {
    }
   
}
