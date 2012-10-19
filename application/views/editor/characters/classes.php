<div class="pane">
	<div class="row-fluid">
		<div class="span2">
			<?=$navbar?>
		</div>
		<div class="span10">
			<div class="page-header">
				<a href="<?=base_url('editor/characters/classes/create')?>" class="btn pull-right">Create Class</a>
				<h1>All Classes</h1>
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
				<?php foreach ($classes as $class): ?>
					<tr>
						<td><?=$class->name?></td>
						<td><?=$class->description?></td>
						<td><?=$class->attributes?></td>
						<td>
							<a href="<?=base_url('editor/characters/classes/edit/'.$class->id)?>"><i class="icon-pencil"></i></a>
							<a href="<?=base_url('editor/characters/classes/delete/'.$class->id)?>"><i class="icon-trash"></i></a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>