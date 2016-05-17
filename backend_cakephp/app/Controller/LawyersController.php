<?php 

class LawyersController extends AppController {
	public $helpers = array('Html','Form');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->response->type('json');
	}

	
	public function index() {

		//$this->set('lawyers', $this->Lawyer->find('all'));
		
		$lawyers =  $this->Lawyer->find('all');
		echo json_encode($lawyers);
		die();
	}

	public function view($id) {
		$this->Lawyer->id = $id;
		$lawyer =  $this->Lawyer->read();
		echo json_encode($lawyer);
		die();
	}
	
	public function add() {
		$response = array(
			'success' => false,
			'message' => 'Failed request save lawyer.',
			'errors' => []
			);
		
		$this->data = $this->request->input ( 'json_decode', true) ;
		//$message = $data;
		if ($this->Lawyer->save($this->data)) {
			$response['success'] = true;
			$response['content'] = 'New lawyer record has been saved. ';
		}else {

		    $response['errors'] = $this->Lawyer->invalidFields();
		}

		$this->response->body(json_encode($response));
	}


	public function edit($id = null) {
		$response = array(
			'success' => false,
			'message' => 'Unable to update your lawyer.',
			'errors' => []
			);
		
	    if (!$id) {
	       $response['message'] .= ' - Invalid lawyer id';
	    }
	    $lawyer = $this->Lawyer->findById($id);
	    
	    if (!$lawyer) {
	       $response['message'] .= ' - Invalid lawyer';
	    }
	    else{
	    	$data = json_decode($this->request->data, true);

		   	if(!empty($_FILES)){
			   	$file = $_FILES['file'];
			   	
			   	if(!empty($file) && !empty($file['name']))
	            {
	                $name = $file['name'];
	                $ary_ext=array('jpg','jpeg','gif','png'); 
	                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); 
	                if(in_array($ext, $ary_ext))
	                {
	                	$new_name = time().$file['name'];
	                	$path = '/var/www/html/lexstart/web/lawyers_img/';
	                	if (!file_exists($path)) {
						    mkdir($path, 0755, true);
						}
	                    move_uploaded_file($file['tmp_name'], $path . $new_name);
	                    $data['Lawyer']['avatar'] = $new_name;
	                }
	            }
	        }

		    $this->Lawyer->id = $id;	    

	        if ($this->Lawyer->save($data)) {
	        	$response['success'] = true;
				$response['message'] = 'Your Lawyer has been updated.';
	        }else {

		    $response['errors'] = $this->Lawyer->invalidFields();
			}

		}    
	    $this->response->body(json_encode($response));
	}

	function delete($id) {
	    /*if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }*/
	    $lawyer = $this->Lawyer->findById($id);
	    if ($this->Lawyer->delete($id)) {

	       // $this->Session->setFlash('The Lawyer with title ' . $lawyer['Lawyer']['title'] . ' has been deleted.');
	        //$this->redirect(array('action' => 'index'));
	        $message = 'The record of lawyer ' . $lawyer['Lawyer']['first_name'].' '.$lawyer['Lawyer']['last_name'] . ' has been deleted.';
	        echo json_encode($message);
			die();
	    }
	}
}