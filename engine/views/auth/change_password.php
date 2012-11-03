<div class="page-header">
	<h1>Change Password</h1>
</div>
<?=form_open(current_url(), 'class="form-horizontal"')?>
	<?php bootstrap_password('old', 'Old Password'); ?>
	<?php bootstrap_password('new', 'New Password'); ?>
	<?php bootstrap_password('new_confirm', 'Confirm New Password'); ?>
	<?=form_input($user_id)?>
	<div class="form-actions">
		<?=form_submit('submit', 'Submit', 'class="btn btn-primary"')?>
	</div>
<?=form_close()?>