<?php 

class MainController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->response->type('json');
	}

	public function index(){

	}

	public function getPathImg() {
		$path = Configure::read('path_img'); 
		$this->response->body(json_encode($path));
	}
}