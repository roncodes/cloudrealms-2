<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/zodiacs/create')?>" class="btn pull-right">Create Zodiac</a>
		<h1>All Zodiacs</h1>
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
		<?php foreach ($zodiacs as $zodiac): ?>
			<tr>
				<td><?=$zodiac->name?></td>
				<td><?=$zodiac->description?></td>
				<td><?=$zodiac->attributes?></td>
				<td>
					<a href="<?=base_url('editor/zodiacs/classes/edit/'.$zodiac->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/zodiacs/classes/delete/'.$zodiac->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>