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
			.slider {
				float: left;
				clear: left;
				width: 300px;
				margin: 15px;
			}
			.slider[data-color="r"] .ui-slider-range { background: #ff0000; }
			.slider[data-color="g"] .ui-slider-range { background: #00ff00; }
			.slider[data-color="b"] .ui-slider-range { background: #0000ff; }
		</style>
	</head>
	<body> 
		<form method="get" action="form.php">
			<div id="radio">
				<input type="radio" name="color" value="red" <?php if ($r =="255" && ($g+$b) =="0") echo "checked"; ?>>Red<br>
				<input type="radio" name="color" value="green" <?php if ($g =="255" && ($r+$b) =="0") echo "checked"; ?>>Green<br>
				<input type="radio" name="color" value="blue" <?php if ($b =="255" && ($r+$g) == "0") echo "checked"; ?>>Blue<br>
			</div>
			<br>
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
				R: 
				<input type="range" name="slideRed" value="<?php echo $r; ?>" min="0" max="255"><br>
				G: 
				<input type="range" name="slideGreen" value="<?php echo $g; ?>" min="0" max="255"><br>
				B: 
				<input type="range" name="slideBlue" value="<?php echo $b; ?>" min="0" max="255"><br>
			</div>
			<br>		
			<div id="picker">
				Color Value (#ffffff):<br>
				<input type="color" name="color2" value="<?php echo $colorString; ?>"><br>
			</div>
			<br>
			<input type="submit">
		</form>
		THE COLORED SLIDERS DO NOT CURRENTLY WORK
		<div id="rslider" class="slider" data-color="r"></div>
		<div id="gslider" class="slider" data-color="g"></div>
		<div id="bslider" class="slider" data-color="b"></div>
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
	});

</script>
