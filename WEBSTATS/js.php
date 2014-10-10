<?php

error_reporting(E_ERROR);
header("Content-type: text/javascript", true);

$jsfile = isset($_GET['file']) ? $_GET['file'] : null;

if (!$jsfile || strlen($jsfile) <= 0 || preg_match("/^[a-zA-Z0-9]+$/", $jsfile) != 1)
{
	echo '/* Invalid JavaScript file name */';
	exit;
}

// Include configuration file
require("./config.php");

// Include template
require("./templates.php");

$jsfilename_path = $site_template_path . '/js/' . $jsfile;
$jsfile_path = $jsfilename_path . '.js';
$jstemplatefile_path = $jsfilename_path . '.js';

// First priority for the JavaScript template file
if (file_exists($jstemplatefile_path) && !is_dir($jstemplatefile_path))
{
	$tpl = new Template($jstemplatefile_path);
	echo '/* This JavaScript template file is located at ' . $jstemplatefile_path . ' */

' . $tpl->fetch($jstemplatefile_path);;
	exit;
}

// Second priority for the JavaScript file
if (file_exists($jsfile_path) && !is_dir($jsfile_path))
{
	echo '/* This JavaScript file is located at ' . $jsfile_path . ' */

';
	echo file_get_contents($jsfile_path);
	exit;
}

$jsfilename_path = $default_site_template_path . '/js/' . $jsfile;
$jsfile_path = $jsfilename_path . '.js';
$jstemplatefile_path = $jsfilename_path . '.js';

// First priority for the JavaScript template file
if (file_exists($jstemplatefile_path) && !is_dir($jstemplatefile_path))
{
	$tpl = new Template($jstemplatefile_path);
	echo '/* This JavaScript template file is located at ' . $jstemplatefile_path . ' */

' . $tpl->fetch($jstemplatefile_path);;
	exit;
}

// Second priority for the JavaScript file
if (file_exists($jsfile_path) && !is_dir($jsfile_path))
{
	echo '/* This JavaScript file is located at ' . $jsfile_path . ' */

';
	echo file_get_contents($jsfile_path);
	exit;
}

echo '/* JavaScript file ' . $jsfile . ' was not found */';

?>