<?php
	// Set LEDs based on text fields
	$r = $_GET["r"];
	$g = $_GET["g"];
	$b = $_GET["b"];
	// Check for valid input (0-255)
	if($r >= "0" && $r <="255" && $g >="0" && $g <="255" && $b >="0"&& $b <="255"){
		// Record input
		$myfile = fopen("color.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $_GET["r"]." ".$_GET["g"]." ".$_GET["b"]);
		fclose($myfile);
	}

	// Set LEDs based on radio selection
	else if($_GET["color"] !="0"){
		$myfile = fopen("color.txt", "w") or die("Unable to open file!");

		// Record input
		if($_GET["color"] =="red"){
			fwrite($myfile, "255 0 0");
		}elseif($_GET["color"] =="green"){
			fwrite($myfile,"0 255 0");
		}elseif($_GET["color"] =="blue"){
			fwrite($myfile,"0 0 255");
		}
		fclose($myfile);
	}
	
	# Return to original page
	if(isset($_REQUEST["destination"])){			// Not currently used since the request form is coming from an html page
      		header("Location: {$_REQUEST["destination"]}");
  	}else if(isset($_SERVER["HTTP_REFERER"])){		// Currently what is working
      		header("Location: {$_SERVER["HTTP_REFERER"]}");
  	}else{
       		// some fallback, maybe redirect to index.php	// Not implemented yet
  	}

?>
