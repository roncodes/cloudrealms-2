<div class="pane">
	<div class="page-header">
		<a href="<?=base_url('editor/characters/create')?>" class="btn pull-right">Create Character</a>
		<h1>All Characters</h1>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>User</th>
				<th>Name</th>
				<th>Level</th>
				<th>Gold</th>
				<th>Class</th>
				<th>Gender</th>
				<th>Zodiac</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($characters as $character): 
			$player = $this->ion_auth->get_user($character->player_id);
			$class = $this->classes->get($character->class);
			$zodiac = $this->zodiacs->get($character->zodiac);
		?>
			<tr>
				<td><?=$player->username?></td>
				<td><?=$character->name?></td>
				<td><?=$character->level?></td>
				<td><?=$character->gold?></td>
				<td><?=$class->name?></td>
				<td><?=$character->gender?></td>
				<td><?=$zodiac->name?></td>
				<td>
					<a href="<?=base_url('editor/characters/edit/'.$character->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/characters/delete/'.$character->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>