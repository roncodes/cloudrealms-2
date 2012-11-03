<div class="pane">
	<div class="page-header">
		<h1>Edit Ability</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name', $ability->name)?>
		<?=bootstrap_input('description', 'Description', $ability->description)?>
		<?=bootstrap_dropdown('race', 'Race', $races, $ability->race)?>
		<?=bootstrap_dropdown('class', 'Class', $classes, $ability->class)?>
		<?=bootstrap_dropdown('zodiac', 'Zodiac', $zodiacs, $ability->zodiac)?>
		<?=bootstrap_input('level', 'Level Required', $ability->level)?>
		<legend>Bonus Attribute Points</legend>
		<?php 
			$ability_attributes = json_decode($ability->attributes, true);
			foreach($attributes as $attr){ 
		?>
			<?=bootstrap_input(strtolower($attr->acronym), $attr->name.' +', $ability_attributes[strtolower($attr->acronym)])?>
		<?php } ?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Update Ability', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/abilities')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>