<div class="pane">
	<div class="page-header">
		<h1>Edit Attribute</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<?=bootstrap_input('name', 'Name', $attr->name)?>
		<?=bootstrap_input('acronym', 'Acronym', $attr->acronym)?>
		<?=bootstrap_input('description', 'Description', $attr->description)?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Update Attribute', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/attributes')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>