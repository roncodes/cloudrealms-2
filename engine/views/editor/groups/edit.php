<div class="pane">
	<div class="page-header">
		<h1>Edit Group</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<?=bootstrap_input('name', 'Name', $group->name)?>
		<?=bootstrap_input('description', 'Description', $group->description)?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Edit Group', 'class="btn btn-primary"')?>
			<a href="<?=base_url('editor/groups')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>