<h1>Add Contract</h1>
<?php
	echo $this->Form->create('Contract');
	echo $this->Form->input('title');
	echo $this->Form->input('contents', array('rows' => '3'));
	echo $this->Form->input('price');
	echo $this->Form->input('description', array('rows' => '3'));
	echo $this->Form->input('package_id');
	echo $this->Form->end('Save Contract');
?>