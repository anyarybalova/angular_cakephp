<h1>Add User</h1>
<?php
	echo $this->Form->create('User');
	echo $this->Form->input('first_name');
	echo $this->Form->input('last_name');
	echo $this->Form->input('phone');
	echo $this->Form->input('email');
	echo $this->Form->input('address');
	echo $this->Form->input('password');
	echo $this->Form->input('password2', array('type' => 'password'));
	echo $this->Form->input('company_name');
	echo $this->Form->input('company_web');
	
	echo $this->Form->input('work_area_id');
	echo $this->Form->input('role_id', array('type'=>'hidden', 'value' => '1'));
	echo $this->Form->end('Save');
?>