<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/skills/create')?>" class="btn pull-right">Create Skill</a>
		<a href="javascript:$('.info').slideToggle();" class="btn btn-info pull-right"><i class="icon-white icon-info-sign" style="margin-top:3px;"></i> Toggle Info</a>
		<h1>All Skills</h1>
		<p class="info" style="display:none;">Skills represent actions that can be taken in game. 
		Skill points are a measure of how proficient the player is at these skills and increasing them grants benefits to the skill as well as granting access to perks that may be taken upon leveling up.</p>
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