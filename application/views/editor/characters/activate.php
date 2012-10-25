<div class="pane">
	<div class="page-header">
		<h1>Activate Character</h1>
	</div>
	<p>Are you sure you want to activate the character '<?=$character->name?>'?</p>
	<?=form_open(current_url())?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><input type="radio" name="confirm" value="yes" checked="checked"> Yes</label>
				<label class="radio"><input type="radio" name="confirm" value="no"> No</label>
			</div>
		</div>
		<?=form_hidden($csrf)?>
		<?=form_hidden(array('id' => $character->id))?>
		<div class="form-actions">
			<?=bootstrap_submit('submit', 'Activate Character', 'class="btn btn-success"')?>
			<a href="<?=base_url('editor/characters')?>" class="btn">Cancel</a>
		</div>
	<?=form_close()?>
</div>