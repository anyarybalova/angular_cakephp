<h1>Lawyers list</h1>
<?php echo $this->Html->link('Add new',
		array('controller' => 'lawyers', 'action' => 'add')); ?>
<table>
<tr>
<th>Id</th>
<th>Login</th>
<th>Name</th>
<th>Email</th>
<th>Lenguage</th>
	<?php foreach ($lawyers as $lawyer): ?>
		<tr>
		<td><?php echo $lawyer['Lawyer']['id']; ?></td>
		<td><?php echo $lawyer['Lawyer']['first_name']; ?></td>
		<td>
		<?php echo $this->Html->link($lawyer['Lawyer']['last_name'],
		array('controller' => 'lawyers', 'action' => 'view', $lawyer['Lawyer']['id'])); ?>
		</td>
		<td><?php echo $lawyer['Lawyer']['email']; ?></td>
		<td><?php echo $lawyer['WorkArea']['name']; ?></td>
		<td>
			<?php echo $this->Html->link(' Editar ', array('controller' => 'lawyers', 'action' => 'edit', $lawyer['Lawyer']['id'])); ?>
			<?php echo $this->Form->postLink(
            'Delete',
            array('action' => 'delete', $lawyer['Lawyer']['id']),
            array('confirm' => 'Are you sure?'));
        	?>
		</td>

		</tr>
	<?php endforeach; ?>
</table>

