<?php
App::uses('AppModel', 'Model');
 
class User extends AppModel {
 
    public $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email')
            ),
        ),
    );
 
    //The Associations below have been created with all possible keys, those that are not needed can be removed
 
   
/**
 * hasMany associations
 *
 * @var array
 */ 
    public $hasOne=array(
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => 'user_id'));
    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
 
}
