<?php
/*
================================================
LEFT 4 DEAD AND LEFT 4 DEAD 2 PLAYER RANK
Copyright (c) 2010 Mikko Andersson
================================================
Game server "Message of the Day" page - "motd.php"
================================================
*/

$motd_page = 1;
$motd_body = "";

// Include the primary PHP functions file
include("./common.php");

// Load outer template
$tpl = new Template("./templates/" . $templatefiles['motd.tpl']);

	// Multilang support
		//-- BASE
	$tpl->set("lang_tpl_layout_ply", $lang_tpl_layout_ply);
	$tpl->set("lang_tpl_layout_points", $lang_tpl_layout_points);
	$tpl->set("lang_tpl_layout_mode", $lang_tpl_layout_mode);
	$tpl->set("lang_tpl_layout_playtime", $lang_tpl_layout_playtime);
		//-- MENU
	$tpl->set("lang_tpl_layout_menutitle", $lang_tpl_layout_menutitle);
	$tpl->set("lang_tpl_layout_top10", $lang_tpl_layout_top10);
	$tpl->set("lang_tpl_layout_plyonline", $lang_tpl_layout_plyonline);
	$tpl->set("lang_tpl_layout_plyrank", $lang_tpl_layout_plyrank);
	$tpl->set("lang_tpl_layout_plysearch", $lang_tpl_layout_plysearch);
	$tpl->set("lang_tpl_layout_plyaward", $lang_tpl_layout_plyaward);
	$tpl->set("lang_tpl_layout_modestats", $lang_tpl_layout_modestats);
	$tpl->set("lang_tpl_layout_servstats", $lang_tpl_layout_servstats);
		//-- SEARCH
	$tpl->set("lang_tpl_layout_search", $lang_tpl_layout_search);
	$tpl->set("lang_tpl_layout_search_btn", $lang_tpl_layout_search_btn);
	
	// End

$tpl->set("stylesheet", $templatefiles['style.css']); // Stylesheet for the page
$tpl->set("header_extra", $header_extra); // Players served
$tpl->set("site_name", $site_name); // Site name
$tpl->set("site_logo", $imagefiles['logo.png']); // Site logo
$tpl->set("title", "Message Of The Day"); // Window title

$motd_header = getserversettingsvalue("motdheader");
if (strlen($motd_header) > 0)
	$tpl->set("motd_header", $motd_header);
else
	$tpl->set("motd_header", "Left 4 Dead Player Stats");

if (strlen($motd_message) > 0)
{
	$tpl_msg = new Template("./templates/" . $templatefiles['motd_message.tpl']);
	$tpl_msg->set("motd_message", $motd_message);
	$tpl->set("motd_message", $tpl_msg->fetch("./templates/" . $templatefiles['motd_message.tpl']));
}

$result = mysql_query("SELECT * FROM " . $mysql_tableprefix . "players ORDER BY " . $TOTALPOINTS . " DESC LIMIT 10");
if ($result && mysql_num_rows($result) > 0)
{
	$top10 = array();
	$i = 1;

	while ($row = mysql_fetch_array($result))
	{
		// This character is A PAIN... Find out how to convert it in to a HTML entity!
		// http://www.fileformat.info/info/unicode/char/06d5/index.htm
		// Maybe it's the same with all Arabic characters???? From right to left type of writing.

		$name = htmlentities($row['name'], ENT_COMPAT, "UTF-8");
		//$name = str_replace("" , "&#1749;", $name);
		//$titlename = str_replace("\"" , "\\\"", $name);

		$top10[] = array("rank" => $i++,
										 "flag" => ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : ""),
										 "name" => $name,
										 "score" => gettotalpointsraw($row));
	}

	$tpl_top10 = new Template("./templates/" . $templatefiles['motd_top10.tpl']);
	$tpl_top10->set("motd_top10", $top10);
	$tpl->set("motd_top10", $tpl_top10->fetch("./templates/" . $templatefiles['motd_top10.tpl']));
}

$real_playtime_sql = $TOTALPLAYTIME;
$real_playtime = "real_playtime";
$real_points_sql = $TOTALPOINTS;
$real_points = "real_points";
$extrasql = ", " . $real_points_sql . " as " . $real_points . ", " . $real_playtime_sql . " as " . $real_playtime;

$query = "SELECT *" . $extrasql . " FROM " . $mysql_tableprefix . "players WHERE (" . $real_playtime_sql . ") >= " . $award_minplaytime . " ORDER BY (" . $real_points . " / " . $real_playtime . ") DESC LIMIT 5";
$result = mysql_query($query);

if ($result && mysql_num_rows($result) > 0)
{
	$topppm = array();
	$i = 1;

	while ($row = mysql_fetch_array($result))
	{
		// This character is A PAIN... Find out how to convert it in to a HTML entity!
		// http://www.fileformat.info/info/unicode/char/06d5/index.htm
		// Maybe it's the same with all Arabic characters???? From right to left type of writing.

		$name = htmlentities($row['name'], ENT_COMPAT, "UTF-8");
		//$name = str_replace("" , "&#1749;", $name);
		//$titlename = str_replace("\"" , "\\\"", $name);

		$topppm[] = array("rank" => $i++,
										 "flag" => ($showplayerflags ? $ip2c->get_country_flag($row['ip']) : ""),
										 "name" => $name,
										 "score" => $row[$real_points] / $row[$real_playtime]);
	}

	$tpl_topppm = new Template("./templates/" . $templatefiles['motd_topppm.tpl']);
	$tpl_topppm->set("motd_topppm", $topppm);
	$tpl->set("motd_topppm", $tpl_topppm->fetch("./templates/" . $templatefiles['motd_topppm.tpl']));
}

// Print out the page!
echo $tpl->fetch("./templates/" . $templatefiles['motd.tpl']);
?>
