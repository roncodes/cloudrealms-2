<div class="pane">
	<div class="page-header">
		<h1>Create Ability</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name')?>
		<?=bootstrap_input('description', 'Description')?>
		<?=bootstrap_dropdown('race', 'Race', $races)?>
		<?=bootstrap_dropdown('class', 'Class', $classes)?>
		<?=bootstrap_dropdown('zodiac', 'Zodiac', $zodiacs)?>
		<?=bootstrap_input('level', 'Level Required')?>
		<legend>Bonus Attribute Points</legend>
		<?php foreach($attributes as $attr){ ?>
			<?=bootstrap_input(strtolower($attr->acronym), $attr->name.' +')?>
		<?php } ?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Create Ability', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/abilities')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>