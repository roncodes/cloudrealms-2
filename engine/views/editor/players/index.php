<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/players/create')?>" class="btn pull-right">Create Player</a>
		<h1>All Players</h1>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Created</th>
				<th>Last Login</th>
				<th>Group</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?=trim($user->first_name.' '.$user->last_name)?></td>
				<td><?=$user->username?></td>
				<td><?=$user->email?></td>
				<td><?=date('F jS, Y', $user->created_on)?></td>
				<td><?=date('F jS, Y', $user->last_login)?></td>
				<td><?=ucfirst($user->group_description)?></td>
				<td><?=($user->active) ? anchor(base_url('editor/players/deactivate/'.$user->id), 'Active') : anchor(base_url('auth/activate/'.$user->id), 'Inactive'); ?></td>
				<td>
					<a href="<?=base_url('editor/players/edit/'.$user->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/players/delete/'.$user->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>