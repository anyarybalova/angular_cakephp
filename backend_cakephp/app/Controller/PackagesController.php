<?php 

class PackagesController extends AppController {
	public $helpers = array('Html','Form');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->response->type('json');
	}

	public function index() {

		$packages = $this->Package->find('all', 
			array('contain' => array(
		    	'Contract' => array(
		        	'fields' => array('Contract.id', 'Contract.title', 'Contract.description', 'Contract.price')
		    	)
		)));
		
		$this->response->body(json_encode($packages));
	}

	public function private_index(){
		$packages =  $this->Package->find('all', array('recursive' => 1));

		$this->response->body(json_encode($packages));
	}

	public function view($id) {
		$this->Package->id = $id;
		$package =  $this->Package->find('first',
			array('contain' => array(
		    	'Contract' => array(
		        	'fields' => array('Contract.id','Contract.title', 'Contract.description', 'Contract.price')
		    	)),
			'conditions' => array('Package.id' => $id) 
			)
			);
		$this->response->body(json_encode($package));
	}
	

	public function private_view($id){
		$this->Package->id = $id;
		$package =  $this->Package->read();
		$this->response->body(json_encode($package));
	}

	public function add() {
		$response = array(
			'success' => false,
			'message' => 'Failed request save package.',
			'errors' => []
			);
		$data = $this->request->input ('json_decode', true) ;
		$errors = array();
		
		$this->Package->set($data['Package']);
		$errors = $this->validateErrors($this->Package);

		if(!count($data['listContracts'])){
   			$msg = array();
   			array_push($msg, 'Choose at least one contract.');
			$errors['list_contracts'] = $msg;
		}


       	if($errors){
       		 $response['errors'] = $errors;
		}
		else{
			if ($this->Package->save($data['Package'])) {
					$response['success'] = true;
					$response['message'] = 'Your package has been saved.';

				$package_id = $this->Package->id;
				if(count($data['listContracts']))
				{
					$contracts = $data['listContracts'];
					foreach ( $contracts as $contract_id ) {
						$this->Package->ContractsPackage->create();
						$this->Package->ContractsPackage->save(array(
							'ContractsPackage' => array(
								'package_id'  => $package_id,
								'contract_id' => $contract_id
							)));
					}

				}
			}else {

			    $response['errors'] = $this->Package->invalidFields();
			}
		}
		
		$this->response->body(json_encode($response));
		
	}


	public function edit($id = null) {
		$response = array(
			'success' => false,
			'message' => 'Unable to update package.',
			'errors' => []
			);

	    if (!$id) {
	        $response['message'] .= ' - Invalid package.';
	    }
	    
	    $package = $this->Package->findById($id);

	    if ($package) {
		   	$data = $this->request->input ('json_decode', true) ;
		    $this->Package->id = $id;
		        if ($this->Package->save($data)) {
		        	$response['success'] = true; 
		            $response['message'] = 'Package has been updated.';
		        }else {

			    $response['errors'] = $this->Package->invalidFields();
				}
	    }
	    $this->response->body(json_encode($response));

	}

	function delete($id) {
	    /*if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }*/
	    $package = $this->Package->findById($id);
	    if ($this->Package->delete($id)) {

	        $this->Session->setFlash('The package with title ' . $package['Package']['title'] . ' has been deleted.');
	        //$this->redirect(array('action' => 'index'));
	        $message = 'The package with title ' . $package['Package']['title'] . ' has been deleted.';
	        echo json_encode($message);
			die();
	    }
	}

	function deleteContract(){
		$package_id = $this->params['package_id'];
		$contract_id = $this->params['contract_id'];
		$message = 'Failed remove the contract from the package';

		$package = $this->Package->findById($package_id);
		$contract_package = $this->Package->ContractsPackage->find('first', array(
				'conditions' => array(
					'ContractsPackage.package_id = ' => $package_id,
					'ContractsPackage.contract_id = ' => $contract_id)
		));
		//var_dump($contract_package['ContractsPackage']['id']);
		
		if ($this->Package->ContractsPackage->delete($contract_package['ContractsPackage']['id'])) {
	        $message = 'The contract not belong to package anymore';
	    }
	    
		$this->response->body(json_encode($message));
	}


	function addContract(){
		$package_id = $this->params['package_id'];
		$contract_id = $this->params['contract_id'];
		$message = 'Failed add the contract to the package';

		$package = $this->Package->findById($package_id);
	
		if($package){
			$this->Package->ContractsPackage->create();

			$result = $this->Package->ContractsPackage->save(array(
				'ContractsPackage' => array(
					'package_id'  => $package_id,
					'contract_id' => $contract_id
				)));

			if($result){
				$message = "The contract was added to package.";
			}
		}
		
		$this->response->body(json_encode($message));
	}
}