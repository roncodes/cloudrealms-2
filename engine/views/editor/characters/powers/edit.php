<div class="pane">
	<div class="page-header">
		<h1>Edit Power</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name', $power->name)?>
		<?=bootstrap_input('description', 'Description', $power->description)?>
		<?=bootstrap_dropdown('race', 'Race', $races, $power->race)?>
		<?=bootstrap_dropdown('class', 'Class', $classes, $power->class)?>
		<?=bootstrap_dropdown('zodiac', 'Zodiac', $zodiacs, $power->zodiac)?>
		<?=bootstrap_input('level', 'Level Required', $power->level)?>
		<legend>Bonus Attribute Points</legend>
		<?php 
			$power_attributes = json_decode($power->attributes, true);
			foreach($attributes as $attr){ 
		?>
			<?=bootstrap_input(strtolower($attr->acronym), $attr->name.' +', $power_attributes[strtolower($attr->acronym)])?>
		<?php } ?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Update Power', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/powers')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>