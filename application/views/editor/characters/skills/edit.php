<div class="pane">
	<div class="page-header">
		<h1>Edit Skill</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<legend>Basics</legend>
		<?=bootstrap_input('name', 'Name', $skill->name, $skill->name)?>
		<?=bootstrap_input('description', 'Description', $skill->description, $skill->description)?>
		<?=bootstrap_dropdown('class', 'Class', $classes, $skill->class)?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Update Skill', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/skills')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>