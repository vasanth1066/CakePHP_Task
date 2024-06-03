<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

class TestsController extends AppController {

    

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

      // $this->viewBuilder()->setTemplate('custom_view');


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


}
