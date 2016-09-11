<?php

	if($_GET["color"] !="0"){
		$myfile = fopen("color.txt", "w") or die("Unable to open file!");

		// Record input
		if($_GET["color"] =="red"){
			fwrite($myfile, "1");
		}elseif($_GET["color"] =="green"){
			fwrite($myfile,"2");
		}elseif($_GET["color"] =="blue"){
			fwrite($myfile,"3");
		}
		
		// Close and open the file so it can be overwritten rather than appended to
		fclose($myfile);
		sleep(5);
		$myfile = fopen("color.txt", "w") or die("Unable to open file!");
		fwrite($myfile,"0");
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
