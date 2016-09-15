<?php
	$r = $_GET["r"];
        $g = $_GET["g"];
        $b = $_GET["b"];

	// Set LEDs based on color form
	if($_GET["color2"] !="#000000"){
		echo $_GET["color2"];

		$myfile = fopen("color.txt", "w") or die("Unable to open file!");
                fwrite($myfile, $_GET["color2"]);
                fclose($myfile);

	}
	
	// Set LEDs based on text fields
	// Check for valid input (0-255)
	else if($r >= "0" && $r <="255" && $g >="0" && $g <="255" && $b >="0"&& $b <="255"){
		// Record input
		$myfile = fopen("color.txt", "w") or die("Unable to open file!");
		fwrite($myfile, "#".dechex($_GET["r"]).dechex($_GET["g"]).dechex($_GET["b"]));
		fclose($myfile);
	}

	// Set LEDs based on sliders
	else if($_GET["slideRed"] !="0" || $_GET["slideGreen"] !="0" || $_GET["slideBlue"] !="0"){
		// Make sure each color contributes two characters of data
		$r = dechex($_GET["slideRed"]);
      		$g = dechex($_GET["slideGreen"]);
      	  	$b = dechex($_GET["slideBlue"]);
		if(strlen($r) < "2")
			$r = "0".$r;
		if(strlen($g) < "2")
                        $g = "0".$g;
		if(strlen($b) < "2")
                        $b = "0".$b;

		// Record input
                $myfile = fopen("color.txt", "w") or die("Unable to open file!");
                fwrite($myfile, "#".$r.$g.$b);
                fclose($myfile);;
	}

	// Set LEDs based on radio selection
	else if($_GET["color"] !="0"){
		$myfile = fopen("color.txt", "w") or die("Unable to open file!");

		// Record input
		if($_GET["color"] =="red"){
			fwrite($myfile, "#ff0000");
		}elseif($_GET["color"] =="green"){
			fwrite($myfile,"#00ff00");
		}elseif($_GET["color"] =="blue"){
			fwrite($myfile,"#0000ff");
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
