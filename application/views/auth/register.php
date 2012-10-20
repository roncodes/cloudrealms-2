<div class="start-window outer">
	<div class="start-window container alpha60">
		<div class="start-window window">
			<div class="tab-content start-content" style="height:450px;">
				<?=form_open(current_url(), 'class="form-vertical"')?>
					<div class="control-group ">
						<div class="controls">
							<input id="username" name="username" type="text" value="" placeholder="Username" class="span6" style="height:30px;width:586px;line-height:30px;font-size:20px;">
						</div>
					</div>
					<div class="control-group ">
						<div class="controls">
							<input id="first_name" name="first_name" type="text" value="" placeholder="First Name" class="span6" style="height:30px;width:586px;line-height:30px;font-size:20px;">
						</div>
					</div>
					<div class="control-group ">
						<div class="controls">
							<input id="last_name" name="last_name" type="text" value="" placeholder="Last Name" class="span6" style="height:30px;width:586px;line-height:30px;font-size:20px;">
						</div>
					</div>
					<div class="control-group ">
						<div class="controls">
							<input id="email" name="email" type="text" value="" placeholder="Email" class="span6" style="height:30px;width:586px;line-height:30px;font-size:20px;">
						</div>
					</div>
					<div class="control-group ">
						<div class="controls">
							<input id="password" name="password" type="password" value="" placeholder="Password" class="span6" style="height:30px;width:586px;line-height:30px;font-size:20px;">
						</div>
					</div>
					<div class="control-group ">
						<div class="controls">
							<input id="password_confirm" name="password_confirm" type="password" value="" placeholder="Confirm Password" class="span6" style="height:30px;width:586px;line-height:30px;font-size:20px;">
						</div>
					</div>
					<?=form_submit('submit', 'Register', 'class="btn btn-primary btn-large btn-block"')?>
					<a href="<?=base_url()?>" class="btn btn-danger btn-large btn-block">Cancel</a>
				<?=form_close()?>
			</div>
		</div>
	</div>
</div>