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
		<?php foreach ($characters as $character): ?>
			<tr>
				<td><?=$character->user_id?></td>
				<td><?=$character->name?></td>
				<td><?=$character->level?></td>
				<td><?=$character->gold?></td>
				<td><?=$character->class?></td>
				<td><?=$character->gender?></td>
				<td><?=$character->zodiac?></td>
				<td>
					<a href="<?=base_url('editor/characters/edit/'.$character->id)?>"><i class="icon-pencil"></i></a>
					<a href="<?=base_url('editor/characters/delete/'.$character->id)?>"><i class="icon-trash"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>