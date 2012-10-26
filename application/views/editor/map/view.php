<style>body, html { overflow:hidden; }</style>
<div id="map_tools" class="subnav subnav-fixed map_tools">
    <ul class="nav nav-pills">
		<li><a style="cursor:pointer;" onclick="open_tiles();">Tiles</a></li>
    </ul>
</div>
<div id="map">
	<div id="map_environment" class="map_grid"></div>
	<div id="map_ground" class="map_grid"></div>
</div>
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
load_map_ground('<?php echo $location; ?>');
load_map_environment('<?php echo $location; ?>');
<?php if($new_map){ ?>
first_save('<?php echo $location; ?>');
<?php } ?>
</script>

