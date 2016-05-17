<h1>Contratos</h1>
<?php echo $this->Html->link('Agregar nuevo',
		array('controller' => 'contracts', 'action' => 'add')); ?>
<table>
<tr>
<th>Id</th>
<th>Title</th>
<th>Contenido</th>
<th>Precio</th>
<th>Descripcion</th>
	<?php foreach ($contracts as $contract): ?>
		<tr>
		<td><?php echo $contract['Contract']['id']; ?></td>
		<td>
		<?php echo $this->Html->link($contract['Contract']['title'],
		array('controller' => 'contracts', 'action' => 'view', $contract['Contract']['id'])); ?>
		</td>
		<td><?php echo $contract['Contract']['contents']; ?></td>
		<td><?php echo $contract['Contract']['price']; ?></td>
		<td><?php echo $contract['Contract']['description']; ?></td>
		<td>
			<?php echo $this->Html->link(' Editar ', array('controller' => 'contracts', 'action' => 'edit', $contract['Contract']['id'])); ?>
			<?php echo $this->Form->postLink(
            'Delete',
            array('action' => 'delete', $contract['Contract']['id']),
            array('confirm' => 'Are you sure?'));
        	?>
		</td>

		</tr>
	<?php endforeach; ?>
</table>

