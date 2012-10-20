<div class="pane">
	<div class="page-header">
		<h1>Create Attribute</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<?=bootstrap_input('name', 'Name')?>
		<?=bootstrap_input('acronym', 'Acronym')?>
		<?=bootstrap_input('description', 'Description')?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Create Attribute', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/characters/attributes')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>