<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/abilities/create')?>" class="btn pull-right">Create Ability</a>
		<a href="javascript:$('.info').slideToggle();" class="btn btn-info pull-right"><i class="icon-white icon-info-sign" style="margin-top:3px;"></i> Toggle Info</a>
		<h1>All Abilities</h1>
		<p class="info" style="display:none;">Abilities in Cloudrealms are defined by their passive nature. They are magical effects that increase various stats and values relative to the player.
		Abilities are determined by the player's race, zodiac, or class or can be obtained by completing quests and tasks throughout the game. Active abilities will appear in the Active Effects list, under Magic.
		Abilities are considered separate from Powers as they do not require activation and are not restricted to once a day use.</p>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
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
			foreach ($abilities as $ability): 
			$race = $this->races->get($ability->race);
			$class = $this->classes->get($ability->class);
			$zodiac = $this->zodiacs->get($ability->zodiac);
		?>
			<tr>
				<td><?=$ability->name?></td>
				<td><?=$ability->description?></td>
				<td><?php if(!empty($race->name)){ echo $race->name; } else { echo 'Any'; } ?></td>
				<td><?php if(!empty($class->name)){ echo $class->name; } else { echo 'Any'; } ?></td>
				<td><?php if(!empty($zodiac->name)){ echo $zodiac->name; } else { echo 'Any'; } ?></td>
				<td><?=$ability->attributes?></td>
				<td><?=$ability->level?></td>
				<td>
					<a href="<?=base_url('editor/characters/abilities/edit/'.$ability->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/characters/abilities/delete/'.$ability->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>