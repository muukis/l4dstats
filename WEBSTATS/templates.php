<?php
/*==================================
#	L4D/L4D2 Stats created by:     #
#		   Mikko Andersson		   #
==================================*/

$templates_path = './templates/';
$templates_path_len = strlen($templates_path);
$template_info_file = '/template.php';
$template_images_path = '/img/';
$default_template = 'default';
$default_template_path = $templates_path . $default_template;
$default_template_images_path = $default_template_path . $template_images_path;

if (!$default_site_template ||
    strlen($default_site_template) <= 0 ||
    !file_exists($templates_path . $default_site_template . $template_info_file))
{
	$default_site_template = $default_template;
}

$default_site_template_path = $templates_path . $default_site_template;
$default_site_template_images_path = $default_site_template_path . $template_images_path;

foreach (glob($templates_path . '*') as $template_path_entry)
{
	$template_path_entry_name = substr($template_path_entry, $templates_path_len);

	if (!is_dir($template_path_entry) ||
	    preg_match("/^[a-zA-Z0-9]+$/", $template_path_entry_name) != 1 ||
	    !file_exists($template_path_entry . $template_info_file))
	{
		continue;
	}

	$template_name = $template_path_entry_name;
	include($template_path_entry . $template_info_file);

	if (strlen($template_name) == 0)
	{
		$template_name = $template_path_entry_name;
	}

	$template_selector[$template_path_entry] = array('name' => htmlentities($template_name), 'getprm' => $get_parameters . 'template=' . $template_path_entry_name, 'templateid' => $template_path_entry_name);
}

$template_properties['template_selector'] = $template_selector;

// Look for new set value
if ($_GET["template"])
{
	$site_template = $_GET["template"];
	setcookie("template", $site_template, time() + (10 * 365 * 24 * 60 * 60)); // Expires in 10 years
}
else
{
	// Find a cookie
	$site_template = $_COOKIE["template"];
}

// User has not set the template preference
if (!$site_template ||
    preg_match("/^[a-zA-Z0-9]+$/", $site_template) != 1 ||
    (!file_exists($templates_path . $site_template) || !is_dir($templates_path . $site_template)))
{
	$site_template = $default_site_template;
}

$site_template = strtolower($site_template);
$site_template_path = $templates_path . $site_template;
$extra_headers = '';

require($site_template_path . $template_info_file);

$template_name = htmlentities($template_name);

$template_properties['current_template'] = $site_template;
$template_properties['current_template_path'] = $site_template_path;
$template_properties['current_template_name'] = $template_name;
$template_properties['extra_headers'] = $extra_headers;

// Always load the default template as the base template
if ($default_template_path != $default_site_template_path)
{
	$load_path = $default_template_path;
	$load_path .= '/';
	$load_path_len = strlen($load_path);
	
	foreach (glob($load_path . '*') as $template_file)
	{
		if (is_dir($template_file))
		{
			continue;
		}

		$file = substr($template_file, $load_path_len);
		$templatefiles[$file] = $template_file;
	}

	$load_path = $default_template_images_path;
	$load_path .= '/';
	$load_path_len = strlen($load_path);

	foreach (glob($load_path . '*') as $image_file)
	{
		if (is_dir($image_file))
		{
			continue;
		}

		$file = substr($image_file, $load_path_len);
		$imagefiles[$file] = $image_file;
	}
}

$load_path = $default_site_template_path;
$load_path .= '/';
$load_path_len = strlen($load_path);

// Load the default template on background
foreach (glob($load_path . '*') as $template_file)
{
	if (is_dir($template_file))
	{
		continue;
	}

	$file = substr($template_file, $load_path_len);
	$templatefiles[$file] = $template_file;
}

$load_path = $default_site_template_images_path;
$load_path .= '/';
$load_path_len = strlen($load_path);

foreach (glob($load_path . '*') as $image_file)
{
	if (is_dir($image_file))
	{
		continue;
	}

	$file = substr($image_file, $load_path_len);
	$imagefiles[$file] = $image_file;
}

if ($site_template != $default_site_template)
{
	$load_path = $site_template_path;
	$load_path .= '/';
	$load_path_len = strlen($load_path);

	// Load the selected template on top
	foreach (glob($load_path . '*') as $template_file)
	{
		if (is_dir($template_file))
		{
			continue;
		}

		$file = substr($template_file, $load_path_len);
		$templatefiles[$file] = $template_file;
	}

	$load_path = $site_template_images_path;
	$load_path .= '/';
	$load_path_len = strlen($load_path);

	foreach (glob($load_path . '*') as $image_file)
	{
		if (is_dir($image_file))
		{
			continue;
		}

		$file = substr($image_file, $load_path_len);
		$imagefiles[$file] = $image_file;
	}
}

?>