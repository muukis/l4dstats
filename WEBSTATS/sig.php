<?php
	header('content-type: image/png');
	
/*
	L4Dstats
*/

	// Include the primary PHP functions file
	include("./common.php");
	
	// Set Steam ID as var, and quit on hack attempt
	if (strstr($_GET['steamid'], "/")) exit;
	$id = mysql_real_escape_string($_GET['steamid']);
	
	// Lets load the configs from config.php
	$dbhandle = mysql_connect($mysql_server, $mysql_user, $mysql_password)
	or die($language_pack['str_error_1']);
	
	$result = mysql_query("SELECT * FROM " . $mysql_tableprefix . "players WHERE steamid = '" . $id . "'");
	$row = mysql_fetch_array($result);
	$totalpoints = $row['points'] + $row['points_survival'] + $row['points_survivors'] + $row['points_infected'] + ($game_version != 1 ? $row['points_realism'] + $row['points_scavenge_survivors'] + $row['points_scavenge_infected'] + $row['points_realism_survivors'] + $row['points_realism_infected'] + $row['points_mutations'] : 0);
	$rankrow = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS rank FROM " . $mysql_tableprefix . "players WHERE points + points_survival + points_survivors + points_infected" . ($game_version != 1 ? " + points_realism + points_scavenge_survivors + points_scavenge_infected + points_realism_survivors + points_realism_infected + points_mutations" : "") . " >= '" . $totalpoints . "'"));
	$rank = $rankrow['rank'];
	
/*
	Resources
*/
	
	$str_res_dir='./user/res/';

/*
	Fonts
*/

	$str_font_reg='tahoma.ttf';
	$str_font_bold='tahomabd.ttf';
	
/*
	Font Sizes
*/
	
	$num_font_size=10;
	$rank_font_size=10;
	$error_font_size=15;
	$error2_font_size=8;
	$nam_font_size=8;
	$sid_font_size=7;
	
/*
	Background Chooser
	// TODO: Make &?bg=
						www.example.com and/or http://example.com
						image function, .png, .jpg, jpeg
*/
	if ($str_bkgnd == null)
		$str_bkgnd = 'bgs/2.png';
	
	//$str_bkgnd=$_GET['bg'];

/*
	Font colors
*/
	
	$res_image_main=imagecreatefrompng($str_res_dir.$str_bkgnd);
	$res_font_color_lblue=imagecolorallocate($res_image_main,0,192,192);
	$res_font_color_white=imagecolorallocate($res_image_main,255,255,255);
	$res_font_color_rank1=imagecolorallocate($res_image_main,0,150,0);
	$res_font_color_rank2=imagecolorallocate($res_image_main,0,150,100);
	$res_font_color_rank3=imagecolorallocate($res_image_main,150,10,0);
	$res_font_color_rank=imagecolorallocate($res_image_main,255,255,255);
	$res_font_color_sid=imagecolorallocate($res_image_main,255,255,255);

/*
	Start Image
*/

if (file_exists('./common.php')) {
// Load the database
if ($dbhandle) {
//select a database to work with
if (mysql_select_db($mysql_db,$dbhandle)) {
	if (mysql_num_rows($result) > 0)
	{
		// Rank IMG
			
		if ($rank == 1) {
			$rank_img = 'img/1.png';
			$res_rank_color_choose = $res_font_color_rank1;
		} elseif ($rank == 2) {
			$rank_img = 'img/2.png';
			$res_rank_color_choose = $res_font_color_rank2;
		} elseif ($rank == 3) {
			$rank_img = 'img/3.png';
			$res_rank_color_choose = $res_font_color_rank3;
		} else {
			$rank_img = 'img/0.png';
			$res_rank_color_choose = $res_font_color_rank;
		}
		
		$res_rank=imagecreatefrompng($str_res_dir.$rank_img);
		imagecopy($res_image_main,$res_rank,316.7,-2,0,0,34,34);
		// End Rank IMG
		
		// Name
		imagettftext($res_image_main,$nam_font_size,0,7,18,$res_font_color_lblue,$str_res_dir.$str_font_bold,$language_pack['str_name'] . ": " . $row['name']);
		
		// Achivements
		$arr_achievements = array();
		$maxachivements = 30;
		
		// Start List
		
		//ach 1
		if ($row['kills'] > $population_minkills) {$arr_achievements[] = "";}
		//ach 2
		if ($row['melee_kills'] >= 1500) {$arr_achievements[] = "";}
		//ach 3
		if ($row['headshots'] >= 500) {$arr_achievements[] = "";}
		//ach 4	
		if ($row['playtime'] >= 500) {$arr_achievements[] = "";}
		//ach 5
		if ($row['award_witchdisturb'] >= 15) {$arr_achievements[] = "";}
		//ach 6
		if ($row['award_teamkill'] >= 15) {$arr_achievements[] = "";}
		//ach 7
		if ($row['award_fincap'] >= 30) {$arr_achievements[] = "";}
		//ach 8
		if ($row['kill_boomer'] >= 4) {$arr_achievements[] = "";}
		//ach 9
		if ($row['award_pills'] >= 1) {$arr_achievements[] = "";}
		//ach 10
		if ($row['award_tankkillnodeaths'] >= 10) {$arr_achievements[] = "";}
		//ach 11
		if ($row['award_medkit'] >= 4) {$arr_achievements[] = "";}
		
		// End List
		
		imagettftext($res_image_main,$nam_font_size,0,7,30,$res_font_color_lblue,$str_res_dir.$str_font_bold,$language_pack['str_ach'] . ": " . count($arr_achievements));
		
		// Rank
		imagettftext($res_image_main,$rank_font_size,0,330,20,$res_rank_color_choose,$str_res_dir.$str_font_bold,$rank);
		
		// Points
		imagettftext($res_image_main,$nam_font_size,0,7,42,$res_font_color_lblue,$str_res_dir.$str_font_bold,$language_pack['str_points'] . ": " . number_format($totalpoints));
		
		// Achivement borders
		$ach_border = 'img/ach.png';
		$ach_border_no = 'img/ach_no.png';
		
		// ACH IMG
		$ach_id1 = 'img/ach1.jpg';
		$ach_id2 = 'img/ach2.jpg';
		$ach_id3 = 'img/ach3.jpg';
		$ach_id4 = 'img/ach4.jpg';
		// Callers - ACH IMG
		$res_ach_1=imagecreatefromjpeg($str_res_dir.$ach_id1);
		$res_ach_2=imagecreatefromjpeg($str_res_dir.$ach_id2);
		$res_ach_3=imagecreatefromjpeg($str_res_dir.$ach_id3);
		$res_ach_4=imagecreatefromjpeg($str_res_dir.$ach_id4);
		
		// Border - Achived
		$res_ach_a=imagecreatefrompng($str_res_dir.$ach_border);
		$res_ach_b=imagecreatefrompng($str_res_dir.$ach_border);
		$res_ach_c=imagecreatefrompng($str_res_dir.$ach_border);
		$res_ach_d=imagecreatefrompng($str_res_dir.$ach_border);
		// Border - Not achived
		$res_ach_a_no=imagecreatefrompng($str_res_dir.$ach_border_no);
		$res_ach_b_no=imagecreatefrompng($str_res_dir.$ach_border_no);
		$res_ach_c_no=imagecreatefrompng($str_res_dir.$ach_border_no);
		$res_ach_d_no=imagecreatefrompng($str_res_dir.$ach_border_no);
		
		// Show ach (top 6)
		
		if ($row['playtime'] >= 500) {$arr_achievements[] = "" . 
			imagecopy($res_image_main,$res_ach_1,200,5,0,0,20,20);
			imagecopy($res_image_main,$res_ach_a,200,5,0,0,20,20)
		
		;} else {$arr_achievements[] = "" .
			imagecopy($res_image_main,$res_ach_1,200,5,0,0,20,20);
			imagecopy($res_image_main,$res_ach_a_no,200,5,0,0,20,20)
		;}
		
		if ($row['headshots'] >= 500) {$arr_achievements[] = "" . 
			imagecopy($res_image_main,$res_ach_2,222,5,0,0,20,20);
			imagecopy($res_image_main,$res_ach_b,222,5,0,0,20,20)
		
		;} else {$arr_achievements[] = "" .
			imagecopy($res_image_main,$res_ach_2,222,5,0,0,20,20);
			imagecopy($res_image_main,$res_ach_b_no,222,5,0,0,20,20)
		;}
		
		if ($row['award_tankkillnodeaths'] >= 10) {$arr_achievements[] = "" . 
			imagecopy($res_image_main,$res_ach_3,244,5,0,0,20,20);
			imagecopy($res_image_main,$res_ach_c,244,5,0,0,20,20)
		
		;} else {$arr_achievements[] = "" .
			imagecopy($res_image_main,$res_ach_3,244,5,0,0,20,20);
			imagecopy($res_image_main,$res_ach_c_no,244,5,0,0,20,20)
		;}
		
		if ($row['award_witchdisturb'] >= 15) {$arr_achievements[] = "" . 
			imagecopy($res_image_main,$res_ach_4,266,5,0,0,20,20);
			imagecopy($res_image_main,$res_ach_c,266,5,0,0,20,20)
		
		;} else {$arr_achievements[] = "" .
			imagecopy($res_image_main,$res_ach_4,266,5,0,0,20,20);
			imagecopy($res_image_main,$res_ach_c_no,266,5,0,0,20,20)
		;}

		// STEAMID
		$dimensions = imagettfbbox($sid_font_size,0,$str_res_dir.$str_font_bold,$row['steamid']);
		$textWidth = abs($dimensions[4] - $dimensions[0]) + 7;
		$x = imagesx($res_image_main) - $textWidth;
		imagettftext($res_image_main,$sid_font_size,0,$x,70,$res_font_color_sid,$str_res_dir.$str_font_bold,$row['steamid']);
		
		// L4Dstats LOGO
		imagettftext($res_image_main,$num_font_size,0,2,73,$res_font_color_white,$str_res_dir.$str_font_bold,$title);

	// Normal Error - Wrong ID, or null
	} else {
		
		imagettftext($res_image_main,$error_font_size,0,37,42,$res_font_color_white,$str_res_dir.$str_font_bold,$language_pack['str_error']);
		imagettftext($res_image_main,$error2_font_size,0,37,52,$res_font_color_white,$str_res_dir.$str_font_reg,$language_pack['str_error_id']);
		
	}
	// Error Code 2 - Table can't be loaded, did the install.php work, or did you run it?
	} else {
		imagettftext($res_image_main,$error_font_size,0,37,42,$res_font_color_white,$str_res_dir.$str_font_bold,$language_pack['str_error']);
		imagettftext($res_image_main,$error2_font_size,0,37,52,$res_font_color_white,$str_res_dir.$str_font_reg,$language_pack['str_error_2']);
	}
	// Error Code 1 - MySQL not loading correctly/Loading, but not connected to database
	} else {
		imagettftext($res_image_main,$error_font_size,0,37,42,$res_font_color_white,$str_res_dir.$str_font_bold,$language_pack['str_error']);
		imagettftext($res_image_main,$error2_font_size,0,37,52,$res_font_color_white,$str_res_dir.$str_font_reg,$language_pack['str_error_1']);
		
	}
// Error code 3 - Can't load SteamID
} else {
	imagettftext($res_image_main,$error_font_size,0,37,42,$res_font_color_white,$str_res_dir.$str_font_bold,$language_pack['str_error']);
	imagettftext($res_image_main,$error2_font_size,0,37,52,$res_font_color_white,$str_res_dir.$str_font_reg,$language_pack['str_error_3']);
	imagettftext($res_image_main,$error2_font_size,0,37,62,$res_font_color_white,$str_res_dir.$str_font_reg,$language_pack['str_error_3b']);
}
	imagepng($res_image_main,NULL,9); 
	imagedestroy($res_image_main);
?>
