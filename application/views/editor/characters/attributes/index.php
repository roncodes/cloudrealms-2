<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/attributes/create')?>" class="btn pull-right">Create Attribute</a>
		<h1>All Attributes</h1>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Acronym</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($attributes as $attr): ?>
			<tr>
				<td><?=$attr->name?></td>
				<td><?=$attr->acronym?></td>
				<td><?=$attr->description?></td>
				<td>
					<a href="<?=base_url('editor/characters/attributes/edit/'.$attr->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/characters/attributes/delete/'.$attr->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>