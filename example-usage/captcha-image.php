<?php
/*
 * captcha-image.php
 *
 * The captcha-image.php is meant to render the CAPTCHA Image.
 * 
 * Written by: Nanu Alan Kachari, Department of CSE, IIT Guwahati on July 7, 2017.
 *
 */
?>
<?php

	//include the config file
	include_once('config.php');
   
	// create new image
	$objCaptchaImage = new iitgCaptcha(CAPTCHAWIDTH, CAPTCHAHEIGHT, CAPTCHACHARS, CAPTCHALINES, CAPTCHAFONTSIZE, CAPTCHAFONTANGLE, CAPTCHAFONT);
	
	if ($objCaptchaImage->Create()) {
		//assign the corresponding code to a session variable
		//for checking against the user entered CAPTCHA value
		$_SESSION['icode'] = $objCaptchaImage->GetCode();
	} else {
		echo 'Image library is not installed.';
	}

?>
