<?php
/*==================================
#	Language File created by:	   #
#			JonnyBoy0719		   #
#	============================   #
#	L4D/L4D2 Stats created by:     #
#		   Mikko Andersson		   #
==================================*/

// Always load the plugin default language in background
include("./language.en.php");

// Look for new set value
if ($_GET["lang"])
{
	$lang = $_GET["lang"];
	setcookie("lang", $lang, time() + (10 * 365 * 24 * 60 * 60)); // Expires in 10 years
}
else
{
	// Find a cookie
	$lang = $_COOKIE["lang"];
}

// User has not set the language preference
if (!$lang)
{
	$lang = $default_lang;
}

$lang = strtolower($lang);

if (!file_exists("./language." . $lang . ".php"))
{
	$lang = strtolower($default_lang);
}

// Load user preferenced language on top
include("./language." . $lang . ".php");

?>