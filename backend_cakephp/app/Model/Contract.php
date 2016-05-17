<?php
App::uses('AppModel', 'Model');

class Contract extends AppModel {
	var $name = 'Contract';

	public $hasMany = array(
        'ContractsPackage' => array(
            'className' => 'ContractsPackage'
        )
    );

    public $hasAndBelongsToMany = array(
     'Package' =>
         array(
          'className'         => 'Package',
             'joinTable'             => 'contracts_packages',
             'foreignKey'            => 'contract_id',
             'associationForeignKey' => 'package_id'
         )
    );

	public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a title. '
        ),
        'contents' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Content is empty. '
        ),
        'price' => array(
            'Not empty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Please enter a price. '
            ),
            'Numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Not valid number. '
            )
        ),
        'description' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a description. '
        )
    );
}


