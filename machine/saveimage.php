<?php
//just a random name for the image file
		$filename = $_POST["filename"];
		//$_POST[data][1] has the base64 encrypted binary codes.
		//convert the binary to image using file_put_contents
		$savefile = @file_put_contents($filename.".jpg",base64_decode(explode(",", $_POST["imagemine"])[1]));
		//if the file saved properly, print the file name
		if($savefile){
			echo $filename;
		}
?>