<?php
App::uses('AppModel', 'Model');

class WorkArea extends AppModel {
	var $name = 'Work_area';

	
    public $hasMany = array('Lawyer');
}