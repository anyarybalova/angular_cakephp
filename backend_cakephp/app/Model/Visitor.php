<?php
App::uses('AppModel', 'Model');

class Visitor extends AppModel {
	var $name = 'Visitor';


    public $validate = array(
        'first_name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a first name. '
        ),
        'last_name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a last name. '
        ),
        'password' => array(
            'rule' => array('minLength', '6'),
            'required' => true,
            'message' => 'Minimum 6 characters long',
            'on' => 'create'
        ),
        'email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Your email is required'
            ),
            'email' => array(
                'rule' => array('email'),
                'required' => true,
                'message' => 'Your email is invalid'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'required' => true,
                'message' => 'That email has already been taken',
                'on' => 'create'
            )
            
        ),
        'company_name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a company name. '
        ),
    );
}