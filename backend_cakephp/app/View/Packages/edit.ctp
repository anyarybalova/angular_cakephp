<h1>Edit package</h1>
<?php
    echo $this->Form->create('Package', array('action' => 'edit'));
    echo $this->Form->input('name');
    echo $this->Form->input('price');
    echo $this->Form->input('description');
    echo $this->Form->input('contract_id');
    echo $this->Form->input('id', array('type' => 'hidden'));
    
    echo $this->Form->end('Save');

    echo $this->Html->link(' Cancelar ', array('controller' => 'packages', 'action' => 'index')); 