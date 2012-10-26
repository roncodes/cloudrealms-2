<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/groups/create')?>" class="btn pull-right">Create Group</a>
		<h1>All Groups</h1>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th class="span1"></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($groups as $group): ?>
			<tr>
				<td><?=$group->name?></td>
				<td><?=$group->description?></td>
				<td>
					<a href="<?=base_url('editor/groups/edit/'.$group->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/groups/delete/'.$group->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>