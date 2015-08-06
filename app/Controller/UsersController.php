<?php
App::uses('Controller', 'AppController');
 
class UsersController extends AppController {
     
    public function beforeFilter() {
        parent::beforeFilter();
         
        $this->Auth->allow('profile','register');
    }
     
    public function profile($id=null) {
        $id=$this->Auth->user('id');
        $profile=$this->User->find('all',array('conditions'=>array("User.id"=>$id)));
        //print_r($profile);
        $this->set('profile', $profile);
         
    }
     
    public function login() {
        if($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }
     
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function register()
    { 
      if (!empty(  $this->request->data))
    {
     $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
     
         //print_r($this->data);
        //$this->User->create();
       if($this->User->save($this->request->data))
        {
          //$this->Auth->login($this->data);
          $this->redirect(array('action' => 'login'));
        }
      
    }  
    }
    
 
}

