<h1>Users list</h1>
<?php echo $this->Html->link('Add new',
		array('controller' => 'users', 'action' => 'add')); ?>
<table>
<tr>
<th>Id</th>
<th>Login</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Lenguage</th>
	<?php foreach ($users as $user): ?>
		<tr>
		<td><?php echo $user['User']['id']; ?></td>
		<td><?php echo $user['User']['first_name']; ?></td>
		<td>
		<?php echo $this->Html->link($user['User']['last_name'],
		array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
		</td>
		<td><?php echo $user['User']['email']; ?></td>
		<td><?php echo $user['Role']['label']; ?></td>
		<td><?php echo $user['WorkArea']['name']; ?></td>
		<td>
			<?php echo $this->Html->link(' Editar ', array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(
            'Delete',
            array('action' => 'delete', $user['User']['id']),
            array('confirm' => 'Are you sure?'));
        	?>
		</td>

		</tr>
	<?php endforeach; ?>
</table>

