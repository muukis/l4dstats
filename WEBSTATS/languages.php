<?php
/*==================================
#	Language File created by:	   #
#			JonnyBoy0719		   #
#	============================   #
#	L4D/L4D2 Stats created by:     #
#		   Mikko Andersson		   #
==================================*/

$lang_file_prefix = './lang/language.';
$lang_file_prefix_len = strlen($lang_file_prefix);

$lang_file_postfix = '.php';
$lang_file_postfix_len = strlen($lang_file_postfix);

foreach (glob($lang_file_prefix . '*' . $lang_file_postfix) as $language_filename)
{
	$lang_id = substr($language_filename, $lang_file_prefix_len);
	$lang_id = substr($lang_id, 0, $lang_file_postfix_len * -1);
	$lang_id = strtolower($lang_id);
	
	$language_flag_path = './img/flags/' . $lang_id . '.gif';

	if (file_exists($language_flag_path))
	{
		require($lang_file_prefix . $lang_id . $lang_file_postfix);
		$language_selector[$lang_id] = array('name' => htmlentities($lang_name), 'path' => $language_flag_path, 'getprm' => $get_parameters . 'lang=' . $lang_id);
	}

	unset($language_pack);
}

$template_properties['language_selector'] = $language_selector;

// Always load the plugin default language in background
require($lang_file_prefix . 'en' . $lang_file_postfix);

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

if (!file_exists($lang_file_prefix . $lang . $lang_file_postfix))
{
	$lang = strtolower($default_lang);
}

// Load user preferenced language on top
require($lang_file_prefix . $lang . $lang_file_postfix);

$lang_name = htmlentities($lang_name);

$template_properties['current_language'] = $lang_name;
$template_properties['current_language_id'] = $lang;

?>