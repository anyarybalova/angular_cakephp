<h1>Edit lawyer profile</h1>
<?php
    echo $this->Form->create('Lawyer', array('action' => 'edit'));
    echo $this->Form->input('full_name' , array('label' => 'Add your name'));
    echo $this->Form->input('email');
    echo $this->Form->input('lenguage');
    echo $this->Form->input('work_area_id');
    echo $this->Form->input('id', array('type' => 'hidden'));
    
    echo $this->Form->end('Save');

    echo $this->Html->link(' Cancelar ', array('controller' => 'lawyers', 'action' => 'index')); 
