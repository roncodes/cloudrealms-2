<div class="pane">
	<div class="page-header">
		<h1>Edit Player</h1>
	</div>
	<?=form_open(current_url(), 'class="form-horizontal"')?>
		<?=bootstrap_input('username', 'Username', $user->username)?>
		<?=bootstrap_input('first_name', 'First Name', $user->first_name)?>
		<?=bootstrap_input('last_name', 'Last Name', $user->last_name)?>
		<?=bootstrap_input('email', 'Email', $user->email)?>
		<?=bootstrap_input('company', 'Company', $user->company)?>
		<?=bootstrap_input('phone', 'Phone', $user->phone)?>
		<?=bootstrap_password('password', 'Password')?>
		<?=bootstrap_password('password_confirm', 'Confirm Password')?>
		<?=bootstrap_dropdown('group_id', 'Group', $groups, $user->group_id)?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Edit Player', 'class="btn btn-primary"'); ?>
			<a href="<?=base_url('editor/players')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>