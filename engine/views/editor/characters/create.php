<div class="pane">
	<div class="page-header">
		<h1>Create Character</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<?=bootstrap_dropdown('player_id', 'Player', $users)?>
		<?=bootstrap_input('name', 'Name')?>
		<?=bootstrap_input('level', 'Level')?>
		<?=bootstrap_dropdown('home', 'Home', $locations)?>
		<?=bootstrap_input('gold', 'Gold')?>
		<?=bootstrap_input('skill_points', 'Skill Points')?>
		<?=bootstrap_input('attack', 'Attack Points')?>
		<?=bootstrap_input('defense', 'Defense Points')?>
		<?=bootstrap_dropdown('zodiac', 'Zodiac', $zodiacs)?>
		<?=bootstrap_input('avatar', 'Avatar')?>
		<?=bootstrap_input('face', 'Face')?>
		<?=bootstrap_dropdown('martial_status', 'Martial Status', $characters)?>
		<?=bootstrap_dropdown('class', 'Class', $classes)?>
		<?=bootstrap_dropdown('gender', 'Gender', array('Male', 'Female'))?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Create Character', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>