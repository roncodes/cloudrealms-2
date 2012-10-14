<div class="page-header">
	<h1>Create Option</h1>
</div>
<?=form_open(current_url(), 'class="form-horizontal"')?>
	<?=bootstrap_input('option_name', 'Option Name')?>
	<?=bootstrap_input('option_value', 'Option Value')?>
	<div class="form-actions">
		<?=bootstrap_submit('submit', 'Create', 'class="btn btn-primary"'); ?>
		<a href="<?=base_url('admin/options')?>" class="btn">Cancel</a>
	</div>
<?=form_close()?>