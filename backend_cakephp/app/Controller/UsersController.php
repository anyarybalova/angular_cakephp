<?php 

class UsersController extends AppController {
	public $helpers = array('Html','Form');

	public function index() {

		$this->set('users', $this->User->find('all'));
	}

	public function view($id) {
		$this->User->id = $id;
		$this->set('user', $this->User->read());
		//$user =  $this->User->read();
		//echo json_encode($user);
		//die();
	}
	
	public function add() {
		$this->User->recursive = 2;
		if ($this->request->is('post')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Your user has been saved.');
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->set('work_areas', $this->User->WorkArea->find('list'));
		$this->set('roles', $this->User->Role->find('list', array('fields' => array('id', 'label'))));
	}

	public function edit($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Invalid user'));
	    }
	    $this->User->recursive = 2;
	    $user = $this->User->findById($id);

	    if (!$user) {
	        throw new NotFoundException(__('Invalid user'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->User->id = $id;
	        if ($this->User->save($this->request->data)) {
	            $this->Session->setFlash(__('Your User has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your user.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $user;
	    }
	    $this->set('options', array(1 => 'en', 2 => 'fr', 3 => 'es'));
	    $this->set('roles', $this->User->Role->find('list', array('fields' => array('id', 'label'))));
	}

	function delete($id) {
	    if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    $user = $this->User->findById($id);
	    if ($this->User->delete($id)) {

	        $this->Session->setFlash('The User with title ' . $user['User']['title'] . ' has been deleted.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}