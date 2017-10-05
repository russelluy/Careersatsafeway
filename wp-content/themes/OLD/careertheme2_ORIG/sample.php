
<?php

//include slideshow.php in your script
include "slideshow.php";

//add 3 slides
$slideshow[ 'slide' ][ 0 ] = array ( 'url' => "ssimages/plant0.jpg" );
$slideshow[ 'slide' ][ 1 ] = array ( 'url' => "ssimages/plant1.jpg" );
$slideshow[ 'slide' ][ 2 ] = array ( 'url' => "ssimages/plant2.jpg" );
							
//send the slideshow data
Send_Slideshow_Data ( $slideshow );

?>
