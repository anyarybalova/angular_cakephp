<h1><?php echo $package['Package']['title']?></h1>

<p><small>Precio: <?php echo $package['Package']['price']?></small></p>

<p><?php echo $package['Package']['contents']?></p>
<p><?php echo $package['Package']['description']?></p>


<?php echo $this->Html->link('Todos', array('controller' => 'packages', 'action' => 'index')); ?>