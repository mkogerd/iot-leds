<?php
	$colorString = file_get_contents('color.txt');
	$r = hexdec(file_get_contents('color.txt', NULL, NULL, 1, 2));
        $g = hexdec(file_get_contents('color.txt', NULL, NULL, 3, 2));
	$b = hexdec(file_get_contents('color.txt', NULL, NULL, 5, 2));
?>

<html>
	<body> 
		<form method="get" action="form.php">
			<input type="radio" name="color" value="red" <?php if ($r =="255" && ($g+$b) =="0") echo "checked"; ?>>Red<br>
			<input type="radio" name="color" value="green" <?php if ($g =="255" && ($r+$b) =="0") echo "checked"; ?>>Green<br>
			<input type="radio" name="color" value="blue" <?php if ($b =="255" && ($r+$g) == "0") echo "checked"; ?>>Blue<br>
			<br>
			Red:<br>
			<input type="text" name="r" value="<?php echo $r; ?>"><br>
			Green:<br>
			<input type="text" name="g" value="<?php echo $g; ?>"><br>
			Blue:<br>
			<input type="text" name="b" value="<?php echo $b; ?>"><br>
			<br>
			R: 
			<input type="range" name="slideRed" value="<?php echo $r; ?>" min="0" max="255"><br>
                        G: 
			<input type="range" name="slideGreen" value="<?php echo $g; ?>" min="0" max="255"><br>
                        B: 
			<input type="range" name="slideBlue" value="<?php echo $b; ?>" min="0" max="255"><br>
			<br>		
			Color Value (#ffffff):<br>
			<input type="color" name="color2" value="<?php echo $colorString; ?>"><br>
			<br>
			<input type="submit">
		</form>
	</body>
</html>
