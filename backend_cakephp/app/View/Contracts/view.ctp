<h1><?php echo $contract['Contract']['title']?></h1>

<p><small>Precio: <?php echo $contract['Contract']['price']?></small></p>

<p><?php echo $contract['Contract']['contents']?></p>
<p><?php echo $contract['Contract']['description']?></p>


<?php echo $this->Html->link('Todos', array('controller' => 'contracts', 'action' => 'index')); ?>