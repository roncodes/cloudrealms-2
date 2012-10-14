<div class="page-header">
	<h1>Edit Option</h1>
</div>
<?=form_open(current_url(), 'class="form-horizontal"')?>
	<?=bootstrap_input('option_name', 'Option Name', $option_name, 'class="span4 uneditable-input" disabled="disabled"')?>
	<?=bootstrap_input('option_value', 'Option Value', $option_value)?>
	<div class="form-actions">
		<?=bootstrap_submit('submit', 'Edit', 'class="btn btn-primary"'); ?>
		<a href="<?=base_url('admin/options')?>" class="btn">Cancel</a>
	</div>
<?=form_close()?>