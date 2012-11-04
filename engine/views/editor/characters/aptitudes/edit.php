<div class="pane">
	<div class="page-header">
		<h1>Edit Aptitude</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name', $aptitude->name)?>
		<?=bootstrap_input('description', 'Description', $aptitude->description)?>
		<?=bootstrap_input('damage', 'Damage', $aptitude->damage)?>
		<?=bootstrap_dropdown('race', 'Race', $races, $aptitude->race)?>
		<?=bootstrap_dropdown('class', 'Class', $classes, $aptitude->class)?>
		<?=bootstrap_dropdown('zodiac', 'Zodiac', $zodiacs, $aptitude->zodiac)?>
		<?=bootstrap_input('level', 'Level Required', $aptitude->level)?>
		<legend>Bonus Attribute Points</legend>
		<?php 
			$aptitude_attributes = json_decode($aptitude->attributes, true);
			foreach($attributes as $attr){ 
		?>
			<?=bootstrap_input(strtolower($attr->acronym), $attr->name.' +', $aptitude_attributes[strtolower($attr->acronym)])?>
		<?php } ?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Update Aptitude', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/aptitudes')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>