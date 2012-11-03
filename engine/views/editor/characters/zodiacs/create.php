<div class="pane">
	<div class="page-header">
		<h1>Create Zodiac</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name')?>
		<?=bootstrap_input('description', 'Description')?>
		<legend>Attribute Points</legend>
		<?php foreach($attributes as $attr){ ?>
			<?=bootstrap_input(strtolower($attr->acronym), $attr->name.' +')?>
		<?php } ?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Create Zodiac', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/zodiacs')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>