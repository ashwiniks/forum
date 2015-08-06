<?php

  /*
   * To change this license header, choose License Headers in Project Properties.
   * To change this template file, choose Tools | Templates
   * and open the template in the editor.
   */

  App::uses('AppController', 'Controller');

  /**
   * CakePHP TopicsController
   * @author ashwinisingh
   */
  class TopicsController extends AppController {
       public $components = array('Paginator');
     
    public function beforeFilter() {
        $this->Auth->allow('index','view');
    }
     public function index($forumId=null) {
        if (!$this->Topic->Forum->exists($forumId)) {
            throw new NotFoundException(__('Invalid forum'));
        }
         
        $forum = $this->Topic->Forum->read(null,$forumId);
        //print_r($forum);
        $this->set('forum',$forum);
         
        $this->Paginator->settings['contain'] = array('User','Post'=>array('User'));
        $this->set('topics', $this->Paginator->paginate());
    }
    
    public function add()
    {
        $forums = $this->Topic->Forum->find('list');
        $this->set('forums',$forums);
        if(!empty($this->request->data))
        {    //echo $this->Auth->user('id');
            $this->request->data['Topic']['user_id']=$this->Auth->user('id');
            if($this->Topic->save($this->request->data))
            {
                
                $this->Session->setFlash('Topic added');
                $this->redirect('/index');
                
            }
            
        }
        
        
    }
    
    
    public function view($id)
    {
        $topic = $this->Topic->read(null,$id);
        $this->set('topic',$topic);
        $this->Paginator->settings['Post']['conditions'] = array('Post.topic_id'=>$topic['Topic']['id']);
        $this->set("posts",$this->Paginator->paginate('Post'));
        
        
        
    }
    
    public function update()
    {
        
    }
  }
  