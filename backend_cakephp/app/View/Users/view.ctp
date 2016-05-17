<h1><?php echo $user['User']['full_name']?></h1>

<p><small>Precio: <?php echo $user['User']['email']?></small></p>

<p><?php echo $user['User']['login']?></p>
<p><?php echo $user['User']['role_id']?></p>


<?php echo $this->Html->link('Todos', array('controller' => 'users', 'action' => 'index')); ?>