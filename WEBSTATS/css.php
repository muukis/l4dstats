<?php

error_reporting(E_ERROR);
header("Content-type: text/css", true);

$cssfile = isset($_GET['file']) ? $_GET['file'] : null;

if (!$cssfile || strlen($cssfile) <= 0 || preg_match("/^[a-zA-Z0-9]+$/", $cssfile) != 1)
{
	echo '/* Invalid CSS file name */';
	exit;
}

// Include configuration file
require("./config.php");

// Include template
require("./templates.php");

$cssfilename_path = $site_template_path . '/css/' . $cssfile;
$cssfile_path = $cssfilename_path . '.css';
$csstemplatefile_path = $cssfilename_path . '.tpl';

// First priority for the template file
if (file_exists($csstemplatefile_path) && !is_dir($csstemplatefile_path))
{
	$tpl = new Template($csstemplatefile_path);
	echo '/* This CSS template file is located at ' . $csstemplatefile_path . ' */

' . $tpl->fetch($csstemplatefile_path);;
	exit;
}

// Second priority for the CSS file
if (file_exists($cssfile_path) && !is_dir($cssfile_path))
{
	echo '/* This CSS file is located at ' . $cssfile_path . ' */

';
	echo file_get_contents($cssfile_path);
	exit;
}

$cssfilename_path = $default_site_template_path . '/css/' . $cssfile;
$cssfile_path = $cssfilename_path . '.css';
$csstemplatefile_path = $cssfilename_path . '.tpl';

// First priority for the template file
if (file_exists($csstemplatefile_path) && !is_dir($csstemplatefile_path))
{
	$tpl = new Template($csstemplatefile_path);
	echo '/* This CSS template file is located at ' . $csstemplatefile_path . ' */

' . $tpl->fetch($csstemplatefile_path);;
	exit;
}

// Second priority for the CSS file
if (file_exists($cssfile_path) && !is_dir($cssfile_path))
{
	echo '/* This CSS file is located at ' . $cssfile_path . ' */

';
	echo file_get_contents($cssfile_path);
	exit;
}

echo '/* CSS file ' . $cssfile . ' was not found */';

?>