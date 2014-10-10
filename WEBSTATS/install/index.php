<?php
/*
=====================================================
PHP Setup Wizard Script - by VLD Interactive
----------------------------------------------------
http://www.phpsetupwizard.com/
http://www.vldinteractive.com/
-----------------------------------------------------
Copyright (c) 2005-2011 VLD Interactive
=====================================================
THIS IS COPYRIGHTED SOFTWARE
PLEASE READ THE LICENSE AGREEMENT
http://www.phpsetupwizard.com/license/
=====================================================
*/

//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

$base_path = str_replace('\\', '/', realpath(dirname(__FILE__))).'/';
$virtual_path = str_replace('\\', '/', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])).'/';
define('BASE_PATH', $base_path);
define('VIRTUAL_PATH', $virtual_path);

include BASE_PATH . 'includes/core/wizard.php';
include BASE_PATH . 'includes/wizard.php';

$wizard = new phpSetupWizard();

$wizard->run();
