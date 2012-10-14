<div class="page-header">
	<h1>Create User</h1>
</div>
<?=form_open(current_url(), 'class="form-horizontal"')?>
	<?=bootstrap_input('username', 'Username')?>
	<?=bootstrap_input('first_name', 'First Name')?>
	<?=bootstrap_input('last_name', 'Last Name')?>
	<?=bootstrap_input('email', 'Email')?>
	<?=bootstrap_input('company', 'Company')?>
	<?=bootstrap_input('phone', 'Phone')?>
	<?=bootstrap_password('password', 'Password')?>
	<?=bootstrap_password('password_confirm', 'Confirm Password')?>
	<?=bootstrap_dropdown('group_id', 'Group', $groups)?>
	<div class="form-actions">
		<?=bootstrap_submit('submit', 'Create User', 'class="btn btn-primary"')?>
		<a href="<?=base_url('admin/users')?>" class="btn">Cancel</a>
	</div>
<?=form_close()?>