<?php
	// Pre-load previous values
	$color = file_get_contents('color.txt');
	$r = hexdec(file_get_contents('color.txt', NULL, NULL, 1, 2));
	$g = hexdec(file_get_contents('color.txt', NULL, NULL, 3, 2));
	$b = hexdec(file_get_contents('color.txt', NULL, NULL, 5, 2));
	
	// Set LEDs based on color form
	if($_GET["color2"] !=$color && $_GET["color2"] !=""){
		echo $_GET["color2"];

		$myfile = fopen("color.txt", "w") or die("Unable to open file!");
                fwrite($myfile, $_GET["color2"]);
                fclose($myfile);
	}

	// Set LEDs based on sliders
	else if($_GET["slideRed"] !=$r || $_GET["slideGreen"] !=$g || $_GET["slideBlue"] !=$b){
		echo "using sliders";
		// Make sure each color contributes two characters of data
		$wr = dechex($_GET["slideRed"]);
      		$wg = dechex($_GET["slideGreen"]);
      	  	$wb = dechex($_GET["slideBlue"]);
		if(strlen($wr) < "2")
			$wr = "0".$wr;
		if(strlen($wg) < "2")
                        $wg = "0".$wg;
		if(strlen($wb) < "2")
                        $wb = "0".$wb;

		// Record input
                $myfile = fopen("color.txt", "w") or die("Unable to open file!");
                fwrite($myfile, "#".$wr.$wg.$wb);
                fclose($myfile);
	}

	// Set LEDs based on text fields
	else if($_GET["r"] !=$r || $_GET["g"] !=$g || $_GET["b"] !=$b){
		// Check for valid input (0-255)
		if($_GET["r"] >= "0" && $_GET["r"] <="255" && $_GET["g"] >="0" && $_GET["g"] <="255" && $_GET["b"] >="0"&& $_GET["b"] <="255"){

			// Make sure each color contributes two characters of data
			$wr = dechex($_GET["r"]);
      			$wg = dechex($_GET["g"]);
			$wb = dechex($_GET["b"]);
			if(strlen($wr) < "2")
				$wr = "0".$wr;
			if(strlen($wg) < "2")
                	        $wg = "0".$wg;
			if(strlen($wb) < "2")
				$wb = "0".$wb;

        fwrite($testfile, "Opening file for TEXT #3 -> ");
			// Record input
			$myfile = fopen("color.txt", "w") or die("Unable to open file!");
			fwrite($myfile, "#".$wr.$wg.$wb);
			fclose($myfile);
		}
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

