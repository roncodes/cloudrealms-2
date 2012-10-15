<div class="pane">
	<div class="page-header">
		<h1>Resources</h1>
	</div>
	<div class="row-fluid">
		<div class="span3">
			<div class="well">
				<ul class="nav nav-list">
				  <li>
					<a href="<?=base_url('editor/resources/view/sprites/')?>" <?php if($resource=='sprites'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Sprites</a>
					<a href="<?=base_url('editor/resources/view/tiles/')?>" <?php if($resource=='tiles'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Tiles</a>
					<a href="<?=base_url('editor/resources/view/sounds/')?>" <?php if($resource=='sounds'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Sounds</a>
					<a href="<?=base_url('editor/resources/view/animations/')?>" <?php if($resource=='animations'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Animations</a>
					<a href="<?=base_url('editor/resources/view/faces/')?>" <?php if($resource=='faces'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Faces</a>
					<a href="<?=base_url('editor/resources/view/graphics/')?>" <?php if($resource=='graphics'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Graphics</a>
					<a href="<?=base_url('editor/resources/view/objects/')?>" <?php if($resource=='objects'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Objects</a>
					<a href="<?=base_url('editor/resources/view/video/')?>" <?php if($resource=='video'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Video</a>
					<a href="<?=base_url('editor/resources/view/misc/')?>" <?php if($resource=='misc'){ ?>class="active-resource"<?php } ?>><i class="icon-book"></i>Misc</a>
				  </li>
				</ul>
			</div>
			<div class="well">
				<form class="form-horizontal">
					<fieldset>
						<div class="control-group" style="margin-left:-75px;">
							<label class="control-label" for="select01">Upload to:</label>
							<div class="controls">
								<select name="resource_type" id="resource_type" style="width:130px;">
									<option>Sprites</option>
									<option>Tiles</option>
									<option>Sounds</option>
									<option>Animations</option>
									<option>Faces</option>
									<option>Graphics</option>
									<option>Objects</option>
									<option>Video</option>
									<option>Misc</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<div id="uploader"></div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="span9">
			<div class="well">
				<ul class="thumbnails">
					<?php if($resource!=''){ ?>
					<?php foreach($resources as $resource){ ?>
					<?php 
						$resource_id = explode('/', $resource);
						$resource_id = explode('.', $resource_id[count($resource_id)-1]);
						$resource_id = $resource_id[0];
					?>
					<li id="<?php echo $resource_id; ?>" class="span2">
						<div class="thumbnail" style="background:#fff;">
							<a onclick="display_resource_details('<?php echo $resource_id; ?>_details');" style="cursor:pointer;" class="thumbnail"><img src="<?=base_url()?><?php echo $resource; ?>" width="160" height="120" alt=""></a>
							<div id="<?php echo $resource_id; ?>_details" style="display:none;">
								<h5><?php echo str_replace('resources/', '', $resource); ?></h5>
								<?php list($width, $height, $type, $attr) = getimagesize(base_url().$resource); ?>
								<p><?php echo $width." x ".$height; ?></p>
								<p><button class="btn-danger" onclick="delete_resource('<?php echo $resource; ?>', '#<?php echo $resource_id; ?>');"><i class="icon-trash icon-white"></i></button></p>
							</div>
						</div>
					</li>
					<?php }} ?>
				</ul>
			</div>
		</div>
	</div>
</div>