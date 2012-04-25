<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>gameQuery shim</title>
		<script type="text/javascript" src="public/js/jquery.js"></script>
		<script type="text/javascript" src="public/js/gamequery.js"></script>
		<script>
			$(function(){
				// sets the div to use to display the game and its dimension
				$("#playground").playground({width: 640, height: 480});

				// configure the loading bar
				$.loadCallback(function(percent){
					$("#loadBar").width(400*percent);
					$("#loadtext").html(""+percent+"%")
				});

				// register the start button and remove the splash screen once the game is ready to starts
				$("#start").click(function(){
					$.playground().startGame(function(){
						 $("#splash").remove();
					});
				});

			});
		</script>
	</head>
	<body>
		<div id="playground">
			<div id ="splash">
				<a id="start">Start</a>
				<div id="loadbar" style="background: 000; height: 32px; overflow: visible;"><span id="loadtext" style="color: red"></span></div>
			</div>
		</div>
	</body>
</html>