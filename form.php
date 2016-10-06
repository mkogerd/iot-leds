<?php
	// Pre-load previous values
	$color = file_get_contents('color.txt');
	$r = hexdec(file_get_contents('color.txt', NULL, NULL, 1, 2));
	$g = hexdec(file_get_contents('color.txt', NULL, NULL, 3, 2));
	$b = hexdec(file_get_contents('color.txt', NULL, NULL, 5, 2));
	$newColor = strtolower($_GET["color"]);
	
	// Set LEDs based on color form
	if($newColor !=$color && $newColor !=""){
		$myfile = fopen("color.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $newColor);
		echo "Updated color to ".$newColor."\n";
                fclose($myfile);
	}
	else echo "Please enter a valid new color";
/*
	# Return to original page
	if(isset($_REQUEST["destination"])){			// Not currently used since the request form is coming from an html page
      		header("Location: {$_REQUEST["destination"]}");
  	}else if(isset($_SERVER["HTTP_REFERER"])){		// Currently what is working
      		header("Location: {$_SERVER["HTTP_REFERER"]}");
  	}else{
       		// some fallback, maybe redirect to index.php	// Not implemented yet
	}*/
?>

