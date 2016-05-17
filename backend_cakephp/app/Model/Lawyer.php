<?php
App::uses('AppModel', 'Model');

class Lawyer extends AppModel {
	var $name = 'Lawyer';

    public $belongsTo = array('WorkArea');

        
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
            'rule' => array('minLength', '8'),
            'required' => true,
            'message' => 'Minimum 8 characters long',
            'on' => 'create'
        ),
        'pass_2' => array(
            array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please Enter Confirm password',
            'on' => 'create'
            ),
            array(
                'rule' => 'checkpasswords',
                'required' => true,
                'message' => 'Password & Confirm Password must be match.',
                'on' => 'create'
            )
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
        'phone' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a phone number. '
        ),
        'work_area_id' => array(
            'Not empty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Please choose a area of expertise. '
            ),
            'Numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Not valid number. '
            )
        ),
        'address' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a adress. '
        ),
        'company_name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a company name. '
        ),
        'company_web' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Please enter a web site'
            ),
            'website' => array(
                'rule' => 'url', 
                'required' => true,
                'message' => 'Not valid url'
            )
            
        ),
    );


    function checkpasswords()     // to check pasword and confirm password
    {  
        if(strcmp($this->data['Lawyer']['password'],$this->data['Lawyer']['pass_2']) == 0 ) 
        {
            return true;
        }
        
        return false;
    }


    
    
    function beforeSave($options = array()) { 
        parent::beforeSave();

        if(isset($this->data['Lawyer']['password'])){
            $this->data['Lawyer']['password'] = md5($this->data['Lawyer']['password']); 
        }
        return true;
    } 

}