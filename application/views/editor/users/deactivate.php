<div class="page-header">
	<h1>Deactivate User</h1>
</div>
<p>Are you sure you want to deactivate the user '<?=$user->username?>'?</p>
<?=form_open(current_url())?>
	<div class="control-group">
		<div class="controls">
			<label class="radio"><input type="radio" name="confirm" value="yes" checked="checked"> Yes</label>
			<label class="radio"><input type="radio" name="confirm" value="no"> No</label>
		</div>
	</div>
	<?=form_hidden($csrf)?>
	<?=form_hidden(array('id' => $user->id))?>
	<div class="form-actions">
		<?=bootstrap_submit('submit', 'Submit', 'class="btn btn-primary"')?>
		<a href="<?=base_url('admin/users')?>" class="btn">Cancel</a>
	</div>
<?=form_close()?>