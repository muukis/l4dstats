<?php
/*==================================
#	Language File created by:	   #
#			JonnyBoy0719		   #
#	============================   #
#	L4D/L4D2 Stats created by:     #
#		   Mikko Andersson		   #
==================================*/

if ($_GET["lang"])
{
	$lang = $_GET["lang"];
	setcookie("lang", $lang, time() + (10 * 365 * 24 * 60 * 60)); // Expires in 10 years
}
else
{
	$lang = $_COOKIE["lang"];
}

if (!$lang)
{
	$lang = $default_lang;
}

$lang = strtolower($lang);

if (!file_exists("./language." . $lang . ".php"))
{
	$lang = strtolower($default_lang);
}

include("./language." . $lang . ".php");

?>