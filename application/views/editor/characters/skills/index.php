<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/skills/create')?>" class="btn pull-right">Create Skill</a>
		<h1>All Skills</h1>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Class</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($skills as $skill): 
			$class = $this->classes->get($skill->class);
		?>
			<tr>
				<td><?=$skill->name?></td>
				<td><?=$skill->description?></td>
				<td><?=$class->name?></td>
				<td>
					<a href="<?=base_url('editor/characters/skills/edit/'.$skill->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/characters/skills/delete/'.$skill->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>