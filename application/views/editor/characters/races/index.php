<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/races/create')?>" class="btn pull-right">Create Race</a>
		<h1>All Races</h1>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Attributes</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($races as $race): ?>
			<tr>
				<td><?=$race->name?></td>
				<td><?=$race->description?></td>
				<td><?=$race->attributes?></td>
				<td>
					<a href="<?=base_url('editor/characters/races/edit/'.$race->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/characters/races/delete/'.$race->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>