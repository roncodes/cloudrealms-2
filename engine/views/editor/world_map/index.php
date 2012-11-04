<div class="pane">
	<div class="page-header">
		<h1>World Map</h1>
	</div>
	<ul id="world" style="position:relative;margin-left:auto;margin-right:auto;list-style:none;">
		<?php 
			$count = 0;
			for($x=0;$x<count($locations)+12;$x++) { ?>
			<?php for($y=0;$y<count($locations)+5;$y++) { ?>
				<?php 
				if(!isset($locations[$count])) {
					echo '<li class="span1" style="border:1px #000 solid;margin:5px;text-align:center;cursor:pointer;"><br>['.$x.', '.$y.']</li>'; 
				} else {
					echo '<li class="span1" style="border:1px #000 solid;margin:5px;text-align:center;cursor:pointer;">'.$locations[$count]->name.'<br>['.$x.', '.$y.']</li>'; 
				}
				$count++;
				?>
			<?php } ?>
		<?php } ?>
		<?php echo '</div>'; ?>
	</ul>
</div>
<script>
$(function() {
	$( "#world" ).sortable();
	$( "#world" ).disableSelection();
});
</script>