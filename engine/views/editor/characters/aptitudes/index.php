<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/aptitudes/create')?>" class="btn pull-right">Create Aptitude</a>
		<a href="javascript:$('.info').slideToggle();" class="btn btn-info pull-right"><i class="icon-white icon-info-sign" style="margin-top:3px;"></i> Toggle Info</a>
		<h1>All Aptitudes</h1>
		<p class="info" style="display:none;">Aptitudes in Cloudrealms are essentialy skill based attacks, that can cause damage to an opponent, you can also use aptitudes to change attributes to players and players in a party, or an individual using the target system</p>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Damage</th>
				<th>Race</th>
				<th>Class</th>
				<th>Zodiac</th>
				<th>Attributes</th>
				<th>Level</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($aptitudes as $aptitude): 
			$race = $this->races->get($aptitude->race);
			$class = $this->classes->get($aptitude->class);
			$zodiac = $this->zodiacs->get($aptitude->zodiac);
		?>
			<tr>
				<td><?=$aptitude->name?></td>
				<td><?=$aptitude->description?></td>
				<td><?=$aptitude->damage?></td>
				<td><?php if(!empty($race->name)){ echo $race->name; } else { echo 'Any'; } ?></td>
				<td><?php if(!empty($class->name)){ echo $class->name; } else { echo 'Any'; } ?></td>
				<td><?php if(!empty($zodiac->name)){ echo $zodiac->name; } else { echo 'Any'; } ?></td>
				<td><?=$aptitude->attributes?></td>
				<td><?=$aptitude->level?></td>
				<td>
					<a href="<?=base_url('editor/characters/aptitudes/edit/'.$aptitude->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/characters/aptitudes/delete/'.$aptitude->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>