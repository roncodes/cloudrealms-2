<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/powers/create')?>" class="btn pull-right">Create Power</a>
		<a href="javascript:$('.info').slideToggle();" class="btn btn-info pull-right"><i class="icon-white icon-info-sign" style="margin-top:3px;"></i> Toggle Info</a>
		<h1>All Powers</h1>
		<p class="info" style="display:none;">Powers in Cloudrealms are essentially magic spells, but are unique in that they have zero MP cost, are not learned from spell books, and can only be used once a day.</p>
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
			foreach ($powers as $power): 
			$race = $this->races->get($power->race);
			$class = $this->classes->get($power->class);
			$zodiac = $this->zodiacs->get($power->zodiac);
		?>
			<tr>
				<td><?=$power->name?></td>
				<td><?=$power->description?></td>
				<td><?php if(!empty($race->name)){ echo $race->name; } else { echo 'Any'; } ?></td>
				<td><?php if(!empty($class->name)){ echo $class->name; } else { echo 'Any'; } ?></td>
				<td><?php if(!empty($zodiac->name)){ echo $zodiac->name; } else { echo 'Any'; } ?></td>
				<td><?=$power->attributes?></td>
				<td><?=$power->level?></td>
				<td>
					<a href="<?=base_url('editor/characters/powers/edit/'.$power->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/characters/powers/delete/'.$power->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>