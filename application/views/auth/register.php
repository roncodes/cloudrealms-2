<div class="page-header">
	<h1>Register</h1>
</div>
<?=form_open(current_url(), 'class="form-horizontal"')?>
	<?php bootstrap_input('username', 'Username'); ?>
	<?php bootstrap_input('first_name', 'First Name'); ?>
	<?php bootstrap_input('last_name', 'Last Name'); ?>
	<?php bootstrap_input('email', 'Email'); ?>
	<?php bootstrap_input('company', 'Company'); ?>
	<?php bootstrap_input('phone', 'Phone'); ?>
	<?php bootstrap_password('password', 'Password'); ?>
	<?php bootstrap_password('password_confirm', 'Confirm Password'); ?>
	<div class="form-actions">
		<?=form_submit('submit', 'Register', 'class="btn btn-primary"')?>
	</div>
<?=form_close()?>