<?php
App::uses('AppModel', 'Model');

class Package extends AppModel {
	var $name = 'Package';
  public $actsAs = array('Containable');
  
    public $hasMany = array(
        'ContractsPackage' => array(
            'className' => 'ContractsPackage'
        )
    );

	public $hasAndBelongsToMany = array(
     'Contract' =>
         array(
          'className'         => 'Contract',
             'joinTable'             => 'contracts_packages',
             'foreignKey'            => 'package_id',
             'associationForeignKey' => 'contract_id'
         )
     );


	public $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Please enter a name. '
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