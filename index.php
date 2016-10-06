<?php
	// Load current color values
	$colorString = file_get_contents('color.txt');
	$r = hexdec(file_get_contents('color.txt', NULL, NULL, 1, 2));
        $g = hexdec(file_get_contents('color.txt', NULL, NULL, 3, 2));
	$b = hexdec(file_get_contents('color.txt', NULL, NULL, 5, 2));
?>

<html>
	<head>

		<!-- Latest compiled and minified Bootstrap CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- Latest compiled Jquery-UI CSS -->
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css">

		<!-- Custom style Jquery sliders to match colors -->
		<style>
			body {
				text-align: center;
				background-image: url('images/mochi.JPG');
				background-size: 100% auto;
			}
			.panel1 {
				background-color:rgba(0,0,0,0.5);
				color: <?php echo $colorString; ?>;
			}
			.slider[data-color="r"] .ui-slider-range { background: #ff0000; }
			.slider[data-color="g"] .ui-slider-range { background: #00ff00; }
			.slider[data-color="b"] .ui-slider-range { background: #0000ff; }
			.input-group-addon { min-width: 180px; }
			.input-group-addon-slider { width: 50%; }
		</style>

	</head>
	<body> 	

		<!-- Title -->
		<div class="panel panel1"><h1 id="title" style="">Control my lights!</h1></div>

		<!-- Main Content -->
		<div class="container">
			<!-- Color Title -->
			<div class="panel panel-default" style="margin:0;">
				<div class="panel-heading" style="margin:0;"><h2><b>Color</b><h2></div>
			</div>

			<!-- Red Control Fields -->
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><b>Red</b></span>
				<input type="text" id="r" class="form-control text-center" value="<?php echo $r; ?>"><br>
				<span class="input-group-addon input-group-addon-slider"><div id="rslider" class="slider" data-color="r"></div></span>
			</div>

			<!-- Green Control Fields -->
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><b>Green</b></span>
				<input type="text" id="g" class="form-control text-center" value="<?php echo $g; ?>"><br>
				<span class="input-group-addon input-group-addon-slider"><div id="gslider" class="slider" data-color="g"></div></span>
			</div>

			<!-- Blue Control Fields -->
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><b>Blue</b></span>
				<input type="text" id="b" class="form-control text-center" value="<?php echo $b; ?>"><br>
				<span class="input-group-addon input-group-addon-slider"><div id="bslider" class="slider" data-color="b"></div></span>
			</div>

			<!-- HTML5 Color-Picker Control Field  and Submit-->
			<div class="panel panel-default" style="margin:0;">
				<div class="panel-heading" style="margin:0;">
					<form  method="get" action="form.php" onSubmit="return false;">
						Color Value (#ffffff):<br>
						<input type="color" id="color" name="color" value="<?php echo $colorString; ?>"><br>
						<br>
						<input id="submit" type="submit">
						<br>
					</form>
				</div>
			</div>

		</div>
	</body>
</html>

<!-- Latest compiled Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
	// Pre-made functions for loading title color
	function hexFromRGB(r, g, b) {
		var hex = [
			r.toString( 16 ),
			g.toString( 16 ),
        		b.toString( 16 )
	      	];
		$.each( hex, function( nr, val ) {
			if ( val.length === 1 ) {
				hex[ nr ] = "0" + val;
			}
		});
		return hex.join( "" ).toUpperCase();
	}
	function refreshTitleColor() {
		var red = $("#rslider").slider("value");	// Poll current values
		var green = $("#gslider").slider("value");
		var blue = $("#bslider").slider("value");
		var hex = hexFromRGB( red, green, blue );
		$("#title").css("color", "#"+hex);		// Update title color
		$("#color").val("#"+hex);			// Update color-picker input color 
	}

	// Document ready functions
	$(document).ready(function() {
		
		// Preload color values
		var rgb = {
			r: <?php echo $r; ?>,
			g: <?php echo $g; ?>,
			b: <?php echo $b; ?>
		}

		// See if browser supports color picker
		var input = document.createElement("input");
		input.type = "color";
		var color_support = input.type === "color";

		// Set up JS sliders	
		$('.slider').each(function() {
			$(this).slider({
				orientation: "horizontal",
				range: "min",
				max: 255,
				value: rgb[$(this).data('color')],
				slide: function(event, ui) {
					$("#"+$(this).attr("data-color")).val($(this).slider("value"));
					refreshTitleColor();},
				change: function(event, ui) {
					$("#"+$(this).attr("data-color")).val($(this).slider("value"));
					refreshTitleColor();},
			});
		});
		
		// Update sliders from text box
		$('input:text').on('input', function() {
			$('#'+this.id+'slider').slider('value', this.value);
		});

		// Update sliders from color picker
		if (color_support) {	// Browsers that support color input type (Chrome, android devices, etc...)
			$('#color').on('input', function() {
				// Get individual color values
				var r = parseInt(this.value.substring(1, 3), 16),
				g = parseInt(this.value.substring(3, 5), 16),
				b = parseInt(this.value.substring(5, 7), 16);
				// Update sliders with values
				$('#rslider').slider('value', r);
				$('#gslider').slider('value', g);
				$('#bslider').slider('value', b);
			});
		} else {		// Devices that don't support color input type (Safari, Crapple, etc...)
			$('#color').on('blur', function() {
				// Get individual color values
				var r = parseInt(this.value.substring(1, 3), 16),
				g = parseInt(this.value.substring(3, 5), 16),
				b = parseInt(this.value.substring(5, 7), 16);
				// Update sliders with values
				$('#rslider').slider('value', r);
				$('#gslider').slider('value', g);
				$('#bslider').slider('value', b);
			});
		}

		// Submit values on button press
		$("#submit").click(function() {
			var url = "form.php";
			var params = "color="+encodeURIComponent(document.getElementById("color").value);
			var http = new XMLHttpRequest();
			http.open("GET", url+"?"+params, true);
			http.onreadystatechange = function() {
				if(http.readyState == 4 && http.status == 200) {
					alert(http.responseText);
				}
			}
			http.send(null);
		});
	});

</script>
