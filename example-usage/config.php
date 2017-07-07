<?php
/*
 * config.php
 * 
 * Main configuration file.
 * 
 * Set the respective values as per your local CAPTCHA requirements.
 *
 * Written by: Nanu Alan Kachari, Department of CSE, IIT Guwahati on 07 July 2017
 * 
 */

//set your application captcha image parameters here
define('CAPTCHAWIDTH','250');
define('CAPTCHAHEIGHT','70');
define('CAPTCHACHARS','5');
define('CAPTCHALINES','50');
define('CAPTCHAFONTSIZE','50');
define('CAPTCHAFONTANGLE','0');
define('CAPTCHAFONT','fonts/xeroxmalfunction.ttf');

//classes used by the application
require('classes/iitg-captcha-class.php');
?>
