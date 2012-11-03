<div class="pane">
	<div class="page-header">
		<h1>Create Skill</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name')?>
		<?=bootstrap_input('description', 'Description')?>
		<?=bootstrap_dropdown('class', 'Class', $classes)?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Create Skill', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/skills')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>