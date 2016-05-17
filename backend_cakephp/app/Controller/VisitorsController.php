<?php 

App::uses('CakeEmail', 'Network/Email');

class VisitorsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->response->type('json');
	}

	
	public function index() {
		$visitors =  $this->Visitor->find('all');
		$this->response->body(json_encode($visitors));
	}

	public function view($id) {
		$this->Visitor->id = $id;
		$visitor =  $this->Visitor->read();
		$this->response->body(json_encode($visitor));
	}

	public function add() {
		$response = array(
			'success' => false,
			'message' => 'Failed request save visitor.',
			'errors' => [],
			'content' => []
			);
		
		$this->data = $this->request->input ('json_decode', true) ;

		if ($this->Visitor->save($this->data)) {
			//$this->send_email($this->data['Visitor']['email']);
			$response['success'] = true;
			$response['message'] = 'New user record has been saved. ';
			$response['content'] = $this->Visitor->find('first', array('fields' => 'id', 'first_name','last_name'));
		}else {

		    $response['errors'] = $this->Visitor->invalidFields();
		}

		$this->response->body(json_encode($response));
	}

	public function edit($id = null) {
		$response = array(
			'success' => false,
			'message' => 'Unable to update user data.',
			'errors' => []
			);

	    if (!$id) {
	        $response['message'] .= ' - Invalid user id.';
	    }
	    
	    $visitor = $this->Visitor->findById($id);

	    if ($visitor) {
		   	$data = $this->request->input ('json_decode', true) ;
		    $this->Visitor->id = $id;
		    
		        if ($this->Visitor->save($data)) {
		        	$response['success'] = true; 
		            $response['message'] = 'Visitor has been updated.';
		        }else {
			    	$response['errors'] = $this->Visitor->invalidFields();
				}
	    }
	    $this->response->body(json_encode($response));
	}

	public function delete($id) {
		$response = array(
			'success' => false,
			'message' => 'Failed delete visitor.'
		);

	    $visitor = $this->Visitor->findById($id);
	    if ($this->Visitor->delete($id)) {
	    	$response['success'] = true;
	        $response['message'] = 'The record of user ' . $visitor['Visitor']['first_name'] .' '.$visitor['Visitor']['last_name']  . ' has been deleted.';
	        $this->response->body(json_encode($response));
	    }
	}

	public function send_email($dest=null)
	{
      /*  $Email = new CakeEmail();
        $Email->to('anya.rybalova@gmail.com');
        $Email->subject('Automagically generated email');
        $Email->from ('ganna@vnstudios.com');
        $Email->send("Hola");
*/
		        // the message
		$msg = "First text";

		// use wordwrap() if lines are longer than 70 characters

		// send email
		mail("anya.rybalova@gmail.com","My subject",$msg);
	}
}