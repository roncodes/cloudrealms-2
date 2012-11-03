<div class="pane">
	<div class="page-header">
		<h1>Edit Character</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<?=bootstrap_dropdown('player_id', 'Player', $users, $character->player_id)?>
		<?=bootstrap_input('name', 'Name', $character->name)?>
		<?=bootstrap_input('level', 'Level', $character->level)?>
		<?=bootstrap_dropdown('home', 'Home', $locations, $character->home)?>
		<?=bootstrap_input('gold', 'Gold', $character->gold)?>
		<?=bootstrap_input('skill_points', 'Skill Points', $character->skill_points)?>
		<?=bootstrap_input('attack', 'Attack Points', $character->attack)?>
		<?=bootstrap_input('defense', 'Defense Points', $character->defense)?>
		<?=bootstrap_dropdown('zodiac', 'Zodiac', $zodiacs, $character->zodiac)?>
		<?=bootstrap_input('avatar', 'Avatar', $character->avatar)?>
		<?=bootstrap_input('face', 'Face', $character->face)?>
		<?=bootstrap_dropdown('martial_status', 'Martial Status', $characters, $character->martial_status)?>
		<?=bootstrap_dropdown('class', 'Class', $classes, $character->class)?>
		<?=bootstrap_dropdown('gender', 'Gender', array('Male', 'Female'), $character->gender)?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Update Character', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>