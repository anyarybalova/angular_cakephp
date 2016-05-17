<h1>Packages</h1>
<?php echo $this->Html->link('Add new',
		array('controller' => 'packages', 'action' => 'add')); ?>
<table>
<tr>
<th>Id</th>
<th>Name</th>
<th>Price</th>
<th>Description</th>
<th>Actions</th>
	<?php foreach ($packages as $package): ?>
		<tr>
		<td><?php echo $package['Package']['id']; ?></td>
		<td>
		<?php echo $this->Html->link($package['Package']['name'],
		array('controller' => 'packages', 'action' => 'view', $package['Package']['id'])); ?>
		</td>
		<td><?php echo $package['Package']['price']; ?></td>
		<td><?php echo $package['Package']['description']; ?></td>
		<td>
			<?php echo $this->Html->link(' Editar ', array('controller' => 'packages', 'action' => 'edit', $package['Package']['id'])); ?>
			<?php echo $this->Form->postLink(
            'Delete',
            array('action' => 'delete', $package['Package']['id']),
            array('confirm' => 'Are you sure?'));
        	?>
		</td>

		</tr>
	<?php endforeach; ?>
</table>

