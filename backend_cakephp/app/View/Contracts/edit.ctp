<h1>Edit Contract</h1>
<?php
    echo $this->Form->create('Contract', array('action' => 'edit'));
    echo $this->Form->input('title');
    echo $this->Form->input('contents', array('rows' => '3'));
    echo $this->Form->input('price');
    echo $this->Form->input('description');
    echo $this->Form->input('package_id');
    echo $this->Form->input('id', array('type' => 'hidden'));
    
    echo $this->Form->end('Save');

    echo $this->Html->link(' Cancelar ', array('controller' => 'contracts', 'action' => 'index')); 