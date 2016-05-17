<?php
App::uses('AppModel', 'Model');

class Role extends AppModel {
	var $name = 'Role';

  	public $hasMany = array('User');
}