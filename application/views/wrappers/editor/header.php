<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Cloudrealms Editor v3</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Ronald A. Richardson">
		<!-- Stylesheets -->
		<link href="<?=base_url()?>public/css/bootstrap.css" rel="stylesheet">
		<link href="<?=base_url()?>public/css/editor.css" rel="stylesheet">
		<link href="<?=base_url()?>public/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="<?=base_url()?>public/css/uploader.css" rel="stylesheet">
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- Javascript -->
		<script type="text/javascript" src="<?=base_url()?>public/js/jquery.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/js/jquery-ui.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/js/editor.js"></script>
		<script type="text/javascript" src="<?=base_url()?>public/js/uploader.js"></script>
	</head>
	
	<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="#">Cloudrealms v3 Editor</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li <?php if($page==''||$page=='dashboard'){ ?> class="active" <? } ?> id="dashboard"><a href="<?=base_url()?>editor">Home</a></li>
						<li <?php if($page=='map_editor'){ ?> class="dropdown active" <? } else { ?>class="dropdown"<?php } ?> id="map_editor">
							<a class="dropdown-toggle" data-toggle="dropdown" href="<?=base_url()?>editor/map_editor">Map Editor<b class="caret"></b></a>
							<ul class="dropdown-menu" style="z-index:999999;position:absolute;">
								<?php if($page=='map_editor'&&$location!=''){ ?>
								<li><a style="cursor:pointer;" onclick="location_properties();">Location Properties</a></li>
								<li><a style="cursor:pointer;" onclick="display_map();">Display Map</a></li>
								<li><a style="cursor:pointer;" onclick="ground_layer();">Ground Layer</a></li>
								<li><a style="cursor:pointer;" onclick="environment_layer();">Environment Layer</a></li>
								<li><a style="cursor:pointer;" onclick="open_tiles();">Tiles</a></li>
								<li><a style="cursor:pointer;" onclick="open_objects();">Objects</a></li>
								<li><a style="cursor:pointer;" onclick="open_creatures();">Creatures</a></li>
								<li><a style="cursor:pointer;" onclick="open_characters();">Characters</a></li>
								<li class="divider"></li>
								<li><a style="cursor:pointer;" href="<?=base_url()?>editor/map_editor">Start Page</a></li>
								<li><a style="cursor:pointer;" onclick="save_map('<?php echo $location; ?>');">Save Map</a></li>
								<?php } else { ?>
								<li><a style="cursor:pointer;" href="<?=base_url()?>editor/map_editor">Open</a></li>
								<?php } ?>
							</ul>
						</li>
						<li <?php if($page=='locations'){ ?> class="active" <? } ?> id="locations"><a href="<?=base_url()?>editor/locations">Locations</a></li>
						<li <?php if($page=='items'){ ?> class="active" <? } ?> id="items"><a href="<?=base_url()?>editor/items">Items</a></li>
						<li <?php if($page=='creatures'){ ?> class="active" <? } ?> id="creatures"><a href="<?=base_url()?>editor/creatures">Creatures</a></li>
						<li <?php if($page=='books'){ ?> class="active" <? } ?> id="books"><a href="<?=base_url()?>editor/books">Books</a></li>
						<li <?php if($page=='quests'){ ?> class="active" <? } ?> id="quests"><a href="<?=base_url()?>editor/quests">Quests</a></li>
						<li <?php if($page=='characters'){ ?> class="active" <? } ?> id="characters"><a href="<?=base_url()?>editor/characters">Characters</a></li>
						<li <?php if($page=='players'){ ?> class="active" <? } ?> id="players"><a href="<?=base_url()?>editor/players">Players</a></li>
						<li <?php if($page=='resources'){ ?> class="active" <? } ?> id="resources"><a href="<?=base_url()?>editor/resources">Resources</a></li>
						<li class="divider-vertical"></li>
						<li <?php if($page=='world'){ ?> class="active" <? } ?> id="world"><a href="#">World</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container">