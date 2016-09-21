<?php
	$colorString = file_get_contents('color.txt');
	$r = hexdec(file_get_contents('color.txt', NULL, NULL, 1, 2));
        $g = hexdec(file_get_contents('color.txt', NULL, NULL, 3, 2));
	$b = hexdec(file_get_contents('color.txt', NULL, NULL, 5, 2));
?>

<html>
	<head>
		<!-- Import Jquery UI stylesheets -->
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css">

		<!-- Custom style Jquery sliders to match colors -->
		<style>
			.clearfix {
				overflow: auto;
			}
			.slider {
				width: 50%;
				margin: 15px;
			}
			.slider[data-color="r"] .ui-slider-range { background: #ff0000; }
			.slider[data-color="g"] .ui-slider-range { background: #00ff00; }
			.slider[data-color="b"] .ui-slider-range { background: #0000ff; }
		</style>
	</head>
	<body> 
		<form id="form1" method="get" action="form.php">
			<div id="text">
				Red:<br>
				<input type="text" name="r" value="<?php echo $r; ?>"><br>
				Green:<br>
				<input type="text" name="g" value="<?php echo $g; ?>"><br>
				Blue:<br>
				<input type="text" name="b" value="<?php echo $b; ?>"><br>
			</div>
			<br>
			<div id="sliders">
				<div id="rslider" class="slider" data-color="r"></div>
				<div id="gslider" class="slider" data-color="g"></div>
				<div id="bslider" class="slider" data-color="b"></div>
			</div>
			<br>		
			<div id="colorPicker">
				Color Value (#ffffff):<br>
				<input type="color" name="color2" value="<?php echo $colorString; ?>"><br>
			</div>
			<br>
			<input id="submit" type="submit">
		</form>
		<br>
	</body>
</html>

<!-- Import Jquery Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>

<script>
	$(document).ready(function() {
		$('#radio').on('click', function() {
			$('#picker').slideToggle();
		});
		
		// Preload color values
		var rgb = {
			r: <?php echo $r; ?>,
			g: <?php echo $g; ?>,
			b: <?php echo $b; ?>
		}
		
		// Set up Jscript sliders	
		$('#rslider').slider({
			orientation: "horizontal",
			range: "min",
			max: 255,
			value: rgb['r']
		});
		$('#gslider').slider({
			orientation: "horizontal",
			range: "min",
			max: 255,
			value: rgb['g']
		});
		$('#bslider').slider({
			orientation: "horizontal",
			range: "min",
			max: 255,
			value: rgb['b']
		});

		// Append JS slider values to GET request
		$("#form1").on('submit',function(event){
			var slideRed = $("<input>").attr("type", "hidden").attr("name", "slideRed").val($("#rslider").slider("value"));
			var slideGreen = $("<input>").attr("type", "hidden").attr("name", "slideGreen").val($("#gslider").slider("value"));
			var slideBlue = $("<input>").attr("type", "hidden").attr("name", "slideBlue").val($("#bslider").slider("value"));
			$('#form1').append($(slideRed));
			$('#form1').append($(slideGreen));
			$('#form1').append($(slideBlue));
		});
	});

</script>
