<?php 

class WorkareasController extends AppController {
	public $helpers = array('Html','Form');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->response->type('json');
	}

	public function index() {
		$areas = $this->Workarea->find('all');
		$this->response->body(json_encode($areas));
	}
}
