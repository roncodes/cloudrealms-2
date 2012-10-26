<div class="page-header">
	<h1>Forgot Password <small>Please enter your <?=$identity_human?> so we can send you an email to reset your password.</small></h1>
</div>
<?=form_open(current_url(), 'class="form-horizontal"')?>
	<?php bootstrap_input($identity, $identity_human); ?>
	<div class="form-actions">
		<?=form_submit('submit', 'Submit', 'class="btn btn-primary"')?>
	</div>
<?=form_close()?>