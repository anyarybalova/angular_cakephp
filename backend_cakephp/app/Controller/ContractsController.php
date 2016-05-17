<?php 

class ContractsController extends AppController {
	public $helpers = array('Html','Form');
	public $components = array('Session');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->response->type('json');
	}

	public function index() {
		$this->Contract->recursive = 2;
		$contracts = $this->Contract->find('all', array(
				'fields' => array('id', 'title', 'description','price')
			));
		//echo json_encode($contracts);
		//die();
		$this->response->body(json_encode($contracts));
	}

	public function private_list() {
		$this->Contract->recursive = 2;
		$contracts = $this->Contract->find('all');
		//echo json_encode($contracts);
		//die();
		$this->response->body(json_encode($contracts));
	}
	

	//public view 
	public function detail($id) {
		$this->Contract->id = $id;
		$contract =  $this->Contract->find('first', array(
				'fields' => array('id', 'title', 'description','price')
			));
		echo json_encode($contract);
		die();
	}

	//private view
	public function view($id) {
		$this->Contract->id = $id;
		$this->set('contract', $this->Contract->read());
		$contract =  $this->Contract->read();
		echo json_encode($contract);
		die();
	}

	public function add() {
		$response = array(
			'success' => false,
			'message' => 'Failed request save contract.',
			'errors' => []
			);

		$data = $this->request->input ( 'json_decode', true) ;
	
		if ($this->Contract->save($data)) {
				$response['success'] = true;
				$response['message'] = 'Your contract has been saved.';
			}
		else {

		    $response['errors'] = $this->Contract->invalidFields();
		}

		$this->response->body(json_encode($response));
	}

	public function edit($id = null) {
		$response = array(
			'success' => false,
			'message' => "Unable to update contract.",
			'errors' => []
			);

	    if (!$id) {
	        $response['message'] .= ' - Invalid contract';
	    }
	    $this->Contract->recursive = 1;
	    $contract = $this->Contract->findById($id);

	    if (!$contract) {
	        $response['message'] .= ' - Invalid contract';
	    }
	    else{
		   	$data = $this->request->input ('json_decode', true) ;
		    $this->Contract->id = $id;
		        if ($this->Contract->save($data)) {
		        	$response['success'] = true;
		            $response['message'] .= 'Contract has been updated.';
		        }else {
					$response['errors'] = $this->Contract->invalidFields();
				}
	    }
	    $this->response->body(json_encode($response));
	}

	function delete($id) {
	    /*if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }*/
	    $contract = $this->Contract->findById($id);
	    if ($this->Contract->delete($id)) {

	        $this->Session->setFlash('The contract with title ' . $contract['Contract']['title'] . ' has been deleted.');
	        $this->redirect(array('action' => 'index'));
	    }
	}

}
