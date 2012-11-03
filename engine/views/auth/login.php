<div class="start-window outer">
	<div class="start-window container alpha60">
		<div class="start-window window">
			<h2 style="text-align:center;"><img src="<?=base_url('public/img/logo.png')?>" alt="<?=$settings['game_title']?>"></h2>
			<div class="tab-content start-content">
				<div class="tab-pane" id="updates">
					<p>Updates</p>
				</div>
				<div class="tab-pane active" id="login">
					<?=form_open(current_url(), 'class="form-vertical"')?>
						<div class="control-group ">
							<div class="controls">
								<input id="email" name="email" type="text" value="" placeholder="Email" class="span6" style="height:30px;width:586px;line-height:30px;font-size:20px;">
							</div>
						</div>
						<div class="control-group ">
							<div class="controls">
								<input id="password" name="password" type="password" value="" class="span6" style="height:30px;width:586px;line-height:30px;font-size:20px;">
							</div>
						</div>
						<div class="controls">
							<?=form_submit('submit', 'Login', 'class="btn btn-primary btn-large btn-block"')?>
						</div>
					<?=form_close()?>
				</div>
				<div class="tab-pane" id="credits">
				
				</div>
			</div>
			<!-- Selection -->
			<ul class="nav nav-pills well" style="margin-right:auto;margin-left:auto;text-align:center;width:300px;">
				<li><a href="#updates"data-toggle="tab">Updates</a></li>
				<li class="active"><a href="#login" data-toggle="tab">Login</a></li>
				<li><a href="#credits" data-toggle="tab">Credits</a></li>
				<li><a href="<?=base_url('auth/register')?>" >Register</a></li>
			</ul>
		</div>
	</div>
</div>