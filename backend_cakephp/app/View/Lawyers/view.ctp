<h1><?php echo $lawyer['Lawyer']['full_name']?></h1>

<p><small>Precio: <?php echo $lawyer['Lawyer']['email']?></small></p>

<p><?php echo $lawyer['Lawyer']['login']?></p>
<p><?php echo $lawyer['Lawyer']['role_id']?></p>


<?php echo $this->Html->link('Todos', array('controller' => 'lawyers', 'action' => 'index')); ?>