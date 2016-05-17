<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
	var $name = 'User';

    public $belongsTo = array('Role' , 'WorkArea');
}