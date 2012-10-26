<div class="pane">
	<div class="page-header">
		<h1>Create Group</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<?=bootstrap_input('name', 'Name')?>
		<?=bootstrap_input('description', 'Description')?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Create Group', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/groups')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>