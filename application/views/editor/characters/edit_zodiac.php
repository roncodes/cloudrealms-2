<div class="pane">
	<div class="page-header">
		<h1>Edit Zodiac</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name', $zodiac->name)?>
		<?=bootstrap_input('description', 'Description', $zodiac->description)?>
		<legend>Attribute Points</legend>
		<?php 
			$zodiac_attributes = json_decode($zodiac->attributes, true);
			foreach($attributes as $attr){ 
		?>
			<?=bootstrap_input(strtolower($attr->acronym), $attr->name.' +', $zodiac_attributes[strtolower($attr->acronym)])?>
		<?php } ?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Update Zodiac', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/zodiacs')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>