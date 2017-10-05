<?php
	/********************************************
		eProgress Notes
		Configuration File
		Author: JJ May - jjm@cfssinc.com
	*********************************************/
	
	/**
	  * Default DB Settings
	*/
	define('DEFAULT_DB_HOST','localhost');
	define('DEFAULT_DB_USER','familyi1_adminll'); 
	define('DEFAULT_DB_PASSWORD','f@m!ly!!'); 
	define('DEFAULT_DB_NAME','familyi1_progressnotes'); 
	
	/**
	  * Site Settings
	*/
	define('DEFAULT_PAGE_TITLE','Electronic Progress Notes');
	define('AJAX_REQUEST_KEY','ajax');
	define('AJAX_REQUEST_VALUE','true');
	define('FORM_METHOD_NAME','FormHandlerMethod');
	
	/**
	  * Application Settings
	*/
	define('CHECK_TIME_OVERLAP',true);
	
	/**
	  * Directory Settings
	*/
	define('PATH_PAGES','pages/');
	define('PATH_INCLUDES','includes/');
	define('PATH_ACCESS_LISTS','security/');
	
	/**
	  * Dynamically Set URL Constants 
	  * (You shouldn't need to mess with this) 
	*/
	$EXPLODE = explode('/',$_SERVER['SCRIPT_NAME']);
	$TRASH = array_pop($EXPLODE);
	define('BASE_URL','http://'.$_SERVER['HTTP_HOST'].implode('/',$EXPLODE).'/');
	define('SITE_URL',BASE_URL);
	define('ABS_LINK',BASE_URL.'index.php');
	define('BASE_URL','index.php');
	define('ABS_CONSOLE_LINK',BASE_URL.'console.php');
	
?>