<?php
/*
 * IITG-Captcha-Class.php
 * 
 * The IITG CAPTCHA class is for generating the CAPTCHA image/code
 * for the login form/process
 * 
 * Written by: Nanu Alan Kachari, Department of CSE, IIT Guwahati on 7 July 2017
 * 
 * Licesed under the GNU General Public License v3.0
 * 
 */
   class iitgCaptcha {
      var $objImage;
      var $imageWidth;
      var $imageHeight;
      var $imageNumChars;
      var $imageNumLines;
      var $imageFontSize;
      var $imageFontAngle;
      var $imageCurrentFont;
      var $imageSpacing;
      var $captchaCode;
      
      function iitgCaptcha($imageWidth, $imageHeight, $imageNumChars, $imageNumLines, $imageFontSize, $imageFontAngle, $imageCurrentFont) {
         //get the parameters
         $this->imageWidth = $imageWidth;
         $this->imageHeight = $imageHeight;
         $this->imageNumChars = $imageNumChars;
         $this->imageNumLines = $imageNumLines;
         $this->imageFontSize = $imageFontSize;
         $this->imageFontAngle = $imageFontAngle;
         $this->imageCurrentFont = $imageCurrentFont;
         
         //create a new image
         $this->objImage = imagecreatetruecolor($imageWidth, $imageHeight);
         
         //create some colors
		 $white = imagecolorallocate($this->objImage, 255, 255, 255);
		 $grey = imagecolorallocate($this->objImage, 220, 220, 220);
		 $black = imagecolorallocate($this->objImage, 0, 0, 0);
         
         //set a background colour
         imagefilledrectangle($this->objImage, 0, 0, $imageWidth, $imageHeight, $white);
         
         //calculate required spacing between characters based on the width of image
         $this->imageSpacing = (int)($this->imageWidth / $this->imageNumChars);
      }
      
      function DrawLines() {
         for ($i = 0; $i < $this->imageNumLines; $i++) {
			//create some random values for the RGB values
            $iRandColourRed = rand(0, 255);
            $iRandColourGreen = rand(0, 255);
            $iRandColourBlue = rand(0, 255);
			
			//set a random line colour
            $iLineColour = imagecolorallocate($this->objImage, $iRandColourRed, $iRandColourGreen, $iRandColourBlue);
            
            //draw the line
            imageline($this->objImage, rand(0, $this->imageWidth), rand(0, $this->imageHeight), rand(0, $this->imageWidth), rand(0, $this->imageHeight), $iLineColour);
         }
      }
      
      function GenerateCode() {
         //reset the security code
         $this->captchaCode = '';
         
         //loop through the required no. of characters and generate the code char by char
         for ($i = 0; $i < $this->imageNumChars; $i++) {
            //select a random character and add to the code string
            $this->captchaCode .= chr(rand(65, 90)); //ASCII chars 65-90 (Capital Letters only)
         }
      }
      
      function DrawCharacters() {
         //loop through the generated code and write the desired number of characters
         for ($i = 0; $i < strlen($this->captchaCode); $i++) {
            
            //create some random values for the RGB values
            $iRandColourRed = rand(0, 255);
            $iRandColourGreen = rand(0, 255);
            $iRandColourBlue = rand(0, 255);
            
            //set a random text color
            $iTextColour = imagecolorallocate($this->objImage, $iRandColourRed, $iRandColourGreen, $iRandColourBlue);
            
			//draw the text
			imagettftext($this->objImage, $this->imageFontSize, $this->imageFontAngle, $this->imageSpacing / 16 + $i * $this->imageSpacing, ($this->imageHeight - imagefontheight(($this->imageCurrentFont)/3)) / 1.5, $iTextColour, $this->imageCurrentFont, $this->captchaCode[$i]);
         }
      }
      
      function Create($sFilename = '') {
         //check for existance of the GD PNG library
         if (!function_exists('imagepng')) {
            return false;
         }

         $this->DrawLines();
         $this->GenerateCode();
         $this->DrawCharacters();

         //draw the image to a file or browser
         if ($sFilename != '') {
            //write the stream to a file
            imagepng($this->objImage, $sFilename); //png image
         } else {
			//tell the browser that data is png
            header('Content-type: image/png');

            //write the stream to browser
            imagepng($this->objImage);
         }
         
         //free the memory used in creating the image
         imagedestroy($this->objImage);
         
         return true;
      }
      
      function GetCode() {
         return $this->captchaCode;
      }
   }
?>
