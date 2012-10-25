<div class="pane">
	<div class="page-header">
		<h1>Edit Race</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name', $class->name)?>
		<?=bootstrap_input('description', 'Description', $class->description)?>
		<legend>Attribute Points</legend>
		<?php 
			$class_attributes = json_decode($class->attributes, true);
			foreach($attributes as $attr){ 
		?>
			<?=bootstrap_input(strtolower($attr->acronym), $attr->name.' +', $class_attributes[strtolower($attr->acronym)])?>
		<?php } ?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Update Race', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/races')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>