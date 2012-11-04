<style>body, html { overflow:hidden; }</style>
<div id="map_tools" class="subnav subnav-fixed map_tools">
    <ul class="nav nav-pills">
		<li><a style="cursor:pointer;" onclick="open_tiles();">Tiles</a></li>
    </ul>
</div>
<div id="map_environment" class="map_grid"></div>
<div id="map_ground" class="map_grid"></div>
<div class="cmodal tiles-box" id="tiles">
	<div class="modal-header">
		<a class="close" onclick="close_tiles();" data-dismiss="modal"><i class="icon-remove"></i></a>
		<h3>Map Tiles</h3>
	</div>
	<div class="modal-body" style="max-height:100%;">
		<ul class="nav nav-tabs">
		<?php 
			foreach($tiles as $tile){ 
				list($width, $height, $type, $attr) = getimagesize(base_url().$tile);
				?>
				<li><a style="cursor:pointer;" onclick="display_tilesheet('#<?php echo str_replace('resources/tiles/', '', str_replace('.png', '', $tile)); ?>', '<?php echo $width+50; ?>px');"><?php echo str_replace('resources/tiles/', '', str_replace('.png', '', $tile)); ?></a></li>
				<?
			}
			?>
			</ul>
			<div id="tile-container"></div>
			<?
			foreach($tiles as $tile){ 
				list($width, $height, $type, $attr) = getimagesize(base_url().$tile);
				$tile_size = $width/16;
				?><div id="<?php echo str_replace('resources/tiles/', '', str_replace('.png', '', $tile)); ?>" style="display:none;">
				<div style="width:<?php echo $width; ?>px;height:<?php echo $height; ?>px;"><?
				for($y=0;$y<$height;$y+=$tile_size){
					for($x=0;$x<$width;$x+=$tile_size){
						?><div class="resource-tile" onclick="select_tile('<?php echo $tile; ?>', '<?php echo $x; ?>', '<?php echo $y; ?>', '<?php echo $tile_size; ?>');" style="background:url('<?php echo base_url().$tile; ?>');background-position:-<?php echo $x; ?>px -<?php echo $y; ?>px;width:<?php echo $tile_size; ?>px;height:<?php echo $tile_size; ?>px;"></div><?
					}
				}
				?></div>
				</div><?
			}
		?>
	</div>
</div>
<script>
<?php if($location){ ?>
load_map_ground('<?php echo $location; ?>');
load_map_environment('<?php echo $location; ?>');
<?php } else { ?>
$('.dropdown-menu').hide();
<?php } ?>
</script>
<?php if($location==''){ ?>
<div class="cmodal" id="locations_navigator" style="width:700px;">
	<div class="modal-header">
		<h3>Map Editor</h3>
	</div>
	<div id="start_body" class="modal-body" style="max-height:100%;height:800px;">
		<p>Welcome to the Cloudrealms v3 Map Editor, this is the launch menu where you can open your saved locations or create a new location.</p>
		<div class="btn-group" style="float:left;margin-right:30px;">
			<a class="btn btn-primary" href="#"><i class="icon-share-alt icon-white"></i> Open a saved location</a>
			<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu" style="z-index:999999999;position:absolute;">
				<?php foreach($locations as $location){ ?>
				<li><a href="<?=base_url('editor/map/view/'.strtolower($location->name))?>"><i class="icon-edit"></i> <?php echo $location->name; ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<a class="btn btn-success" href="javascript:new_location_form();" style="float:left;"><i class="icon-plus icon-white"></i> Create a new location</a>
	</div>
</div>
<div id="start_page" style="display:none;">
	<p>Welcome to the Cloudrealms v3 Map Editor, this is the launch menu where you can open your saved locations or create a new location.</p>
	<div class="btn-group" style="float:left;margin-right:30px;">
		<a class="btn btn-primary" href="#"><i class="icon-share-alt icon-white"></i> Open a saved location</a>
		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
		<ul class="dropdown-menu" style="z-index:999999999;position:absolute;">
			<li><a href="#"><i class="icon-edit"></i> Gothenvillage</a></li>
		</ul>
	</div>
	<a class="btn btn-success" href="javascript:new_location_form();" style="float:left;"><i class="icon-plus icon-white"></i> Create a new location</a>
</div>
<div id="new_location" style="display:none;">
	<form class="form-horizontal">
		<fieldset>
			<legend>Create new location</legend>
			<div class="control-group">
				<label class="control-label" for="input01">Location Name</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="location_name" name="location_name">
					<p class="help-block">Enter a name for your new location ex. Winterhold</p>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="button" onclick="create_new_location();" class="btn btn-primary">Create!</button>
					<button class="btn" onclick="cancel_new_location();return false;">Cancel</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<script>
$("#map_environment").css({"background": '#000', 'pointer-events': 'none', 'opacity': '0.70'});
</script>
<?php } ?>
