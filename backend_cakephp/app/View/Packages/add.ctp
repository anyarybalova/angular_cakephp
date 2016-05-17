<h1>Add Package</h1>
<?php
	echo $this->Form->create('Package');
	echo $this->Form->input('name');
	echo $this->Form->input('price');
	echo $this->Form->input('description', array('rows' => '3'));
	echo $this->Form->end('Save Package');
?>