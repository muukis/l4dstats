<?php

	require_once('./lib/nusoap.php');
	require_once("../config.php");

	$namespace = "https://forums.alliedmods.net";
	
	$server = new soap_server;
	$server->soap_defencoding = 'utf-8';
	
	$server->configureWSDL("L4DStatsSoapServices", $namespace);
	$server->wsdl->schemaTargetNamespace = $namespace;

	$server->wsdl->addComplexType('Player', 'complexType', 'struct', 'all', '',
		array(
			'steamid' => array('name' => 'steamid', 'type' => 'xsd:string'),
			'name' => array('name' => 'name', 'type' => 'xsd:string'),
			'lastontime' => array('name' => 'lastontime', 'type' => 'xsd:string'),
			'lastgamemode' => array('name' => 'lastgamemode', 'type' => 'xsd:int'),
			'ip' => array('name' => 'ip', 'type' => 'xsd:string'),
			'playtime' => array('name' => 'playtime', 'type' => 'xsd:int'),
			'playtime_versus' => array('name' => 'playtime_versus', 'type' => 'xsd:int'),
			'playtime_realism' => array('name' => 'playtime_realism', 'type' => 'xsd:int'),
			'playtime_survival' => array('name' => 'playtime_survival', 'type' => 'xsd:int'),
			'playtime_scavenge' => array('name' => 'playtime_scavenge', 'type' => 'xsd:int'),
			'playtime_realismversus' => array('name' => 'playtime_realismversus', 'type' => 'xsd:int'),
			'points' => array('name' => 'points', 'type' => 'xsd:int'),
			'points_realism' => array('name' => 'points_realism', 'type' => 'xsd:int'),
			'points_survival' => array('name' => 'points_survival', 'type' => 'xsd:int'),
			'points_survivors' => array('name' => 'points_survivors', 'type' => 'xsd:int'),
			'points_infected' => array('name' => 'points_infected', 'type' => 'xsd:int'),
			'points_scavenge_survivors' => array('name' => 'points_scavenge_survivors', 'type' => 'xsd:int'),
			'points_scavenge_infected' => array('name' => 'points_scavenge_infected', 'type' => 'xsd:int'),
			'points_realism_survivors' => array('name' => 'points_realism_survivors', 'type' => 'xsd:int'),
			'points_realism_infected' => array('name' => 'points_realism_infected', 'type' => 'xsd:int'),
			'kills' => array('name' => 'kills', 'type' => 'xsd:int'),
			'melee_kills' => array('name' => 'melee_kills', 'type' => 'xsd:int'),
			'headshots' => array('name' => 'headshots', 'type' => 'xsd:int'),
			'kill_infected' => array('name' => 'kill_infected', 'type' => 'xsd:int'),
			'kill_hunter' => array('name' => 'kill_hunter', 'type' => 'xsd:int'),
			'kill_smoker' => array('name' => 'kill_smoker', 'type' => 'xsd:int'),
			'kill_boomer' => array('name' => 'kill_boomer', 'type' => 'xsd:int'),
			'kill_spitter' => array('name' => 'kill_spitter', 'type' => 'xsd:int'),
			'kill_jockey' => array('name' => 'kill_jockey', 'type' => 'xsd:int'),
			'kill_charger' => array('name' => 'kill_charger', 'type' => 'xsd:int'),
			'versus_kills_survivors' => array('name' => 'versus_kills_survivors', 'type' => 'xsd:int'),
			'scavenge_kills_survivors' => array('name' => 'scavenge_kills_survivors', 'type' => 'xsd:int'),
			'realism_kills_survivors' => array('name' => 'realism_kills_survivors', 'type' => 'xsd:int'),
			'jockey_rides' => array('name' => 'jockey_rides', 'type' => 'xsd:int'),
			'charger_impacts' => array('name' => 'charger_impacts', 'type' => 'xsd:int'),
			'award_pills' => array('name' => 'award_pills', 'type' => 'xsd:int'),
			'award_adrenaline' => array('name' => 'award_adrenaline', 'type' => 'xsd:int'),
			'award_fincap' => array('name' => 'award_fincap', 'type' => 'xsd:int'),
			'award_medkit' => array('name' => 'award_medkit', 'type' => 'xsd:int'),
			'award_defib' => array('name' => 'award_defib', 'type' => 'xsd:int'),
			'award_charger' => array('name' => 'award_charger', 'type' => 'xsd:int'),
			'award_jockey' => array('name' => 'award_jockey', 'type' => 'xsd:int'),
			'award_hunter' => array('name' => 'award_hunter', 'type' => 'xsd:int'),
			'award_smoker' => array('name' => 'award_smoker', 'type' => 'xsd:int'),
			'award_protect' => array('name' => 'award_protect', 'type' => 'xsd:int'),
			'award_revive' => array('name' => 'award_revive', 'type' => 'xsd:int'),
			'award_rescue' => array('name' => 'award_rescue', 'type' => 'xsd:int'),
			'award_campaigns' => array('name' => 'award_campaigns', 'type' => 'xsd:int'),
			'award_tankkill' => array('name' => 'award_tankkill', 'type' => 'xsd:int'),
			'award_tankkillnodeaths' => array('name' => 'award_tankkillnodeaths', 'type' => 'xsd:int'),
			'award_allinsafehouse' => array('name' => 'award_allinsafehouse', 'type' => 'xsd:int'),
			'award_friendlyfire' => array('name' => 'award_friendlyfire', 'type' => 'xsd:int'),
			'award_teamkill' => array('name' => 'award_teamkill', 'type' => 'xsd:int'),
			'award_left4dead' => array('name' => 'award_left4dead', 'type' => 'xsd:int'),
			'award_letinsafehouse' => array('name' => 'award_letinsafehouse', 'type' => 'xsd:int'),
			'award_witchdisturb' => array('name' => 'award_witchdisturb', 'type' => 'xsd:int'),
			'award_pounce_perfect' => array('name' => 'award_pounce_perfect', 'type' => 'xsd:int'),
			'award_pounce_nice' => array('name' => 'award_pounce_nice', 'type' => 'xsd:int'),
			'award_perfect_blindness' => array('name' => 'award_perfect_blindness', 'type' => 'xsd:int'),
			'award_infected_win' => array('name' => 'award_infected_win', 'type' => 'xsd:int'),
			'award_scavenge_infected_win' => array('name' => 'award_scavenge_infected_win', 'type' => 'xsd:int'),
			'award_bulldozer' => array('name' => 'award_bulldozer', 'type' => 'xsd:int'),
			'award_survivor_down' => array('name' => 'award_survivor_down', 'type' => 'xsd:int'),
			'award_ledgegrab' => array('name' => 'award_ledgegrab', 'type' => 'xsd:int'),
			'award_gascans_poured' => array('name' => 'award_gascans_poured', 'type' => 'xsd:int'),
			'award_upgrades_added' => array('name' => 'award_upgrades_added', 'type' => 'xsd:int'),
			'award_matador' => array('name' => 'award_matador', 'type' => 'xsd:int'),
			'award_witchcrowned' => array('name' => 'award_witchcrowned', 'type' => 'xsd:int'),
			'award_scatteringram' => array('name' => 'award_scatteringram', 'type' => 'xsd:int'),
			'infected_spawn_1' => array('name' => 'infected_spawn_1', 'type' => 'xsd:int'),
			'infected_spawn_2' => array('name' => 'infected_spawn_2', 'type' => 'xsd:int'),
			'infected_spawn_3' => array('name' => 'infected_spawn_3', 'type' => 'xsd:int'),
			'infected_spawn_4' => array('name' => 'infected_spawn_4', 'type' => 'xsd:int'),
			'infected_spawn_5' => array('name' => 'infected_spawn_5', 'type' => 'xsd:int'),
			'infected_spawn_6' => array('name' => 'infected_spawn_6', 'type' => 'xsd:int'),
			'infected_spawn_8' => array('name' => 'infected_spawn_8', 'type' => 'xsd:int'),
			'infected_boomer_vomits' => array('name' => 'infected_boomer_vomits', 'type' => 'xsd:int'),
			'infected_boomer_blinded' => array('name' => 'infected_boomer_blinded', 'type' => 'xsd:int'),
			'infected_hunter_pounce_counter' => array('name' => 'infected_hunter_pounce_counter', 'type' => 'xsd:int'),
			'infected_hunter_pounce_dmg' => array('name' => 'infected_hunter_pounce_dmg', 'type' => 'xsd:int'),
			'infected_smoker_damage' => array('name' => 'infected_smoker_damage', 'type' => 'xsd:int'),
			'infected_jockey_damage' => array('name' => 'infected_jockey_damage', 'type' => 'xsd:int'),
			'infected_jockey_ridetime' => array('name' => 'infected_jockey_ridetime', 'type' => 'xsd:decimal'),
			'infected_charger_damage' => array('name' => 'infected_charger_damage', 'type' => 'xsd:int'),
			'infected_tank_damage' => array('name' => 'infected_tank_damage', 'type' => 'xsd:int'),
			'infected_tanksniper' => array('name' => 'infected_tanksniper', 'type' => 'xsd:int'),
			'infected_spitter_damage' => array('name' => 'infected_spitter_damage', 'type' => 'xsd:int'),
			'mutations_kills_survivors' => array('name' => 'mutations_kills_survivors', 'type' => 'xsd:int'),
			'playtime_mutations' => array('name' => 'playtime_mutations', 'type' => 'xsd:int'),
			'points_mutations' => array('name' => 'points_mutations', 'type' => 'xsd:int')
		));

	$server->wsdl->addComplexType('Players', 'complexType', 'array', '', 'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:Player[]')), 'tns:Player');

	$server->wsdl->addComplexType('PlayerCompact', 'complexType', 'struct', 'all', '',
		array(
			'steamid' => array('name' => 'steamid', 'type' => 'xsd:string'),
			'name' => array('name' => 'name', 'type' => 'xsd:string'),
			'lastontime' => array('name' => 'lastontime', 'type' => 'xsd:string'),
			'playtime' => array('name' => 'playtime', 'type' => 'xsd:int'),
			'points' => array('name' => 'points', 'type' => 'xsd:int'),
			'kills' => array('name' => 'kills', 'type' => 'xsd:int'),
			'kill_infected' => array('name' => 'kill_infected', 'type' => 'xsd:int')
		));

	$server->wsdl->addComplexType('PlayersCompact', 'complexType', 'array', '', 'SOAP-ENC:Array',
		array(),
		array(array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:PlayerCompact[]')), 'tns:PlayerCompact');
	
	$server->register(
		// method name:
		'GetPlayer', 	
		// parameter list:
		array('steamId' => 'xsd:string'), 
		// return value(s):
		array('return' => 'tns:Player'),
		// namespace:
		$namespace,
		// soapaction: (use default)
		false,
		// style: rpc or document
		'rpc',
		// use: encoded or literal
		'encoded',
		// description: documentation for the method
		'Returns a player from stats database.');
	
	$server->register(
		// method name:
		'GetPlayerCompact', 	
		// parameter list:
		array('steamId' => 'xsd:string'), 
		// return value(s):
		array('return' => 'tns:PlayerCompact'),
		// namespace:
		$namespace,
		// soapaction: (use default)
		false,
		// style: rpc or document
		'rpc',
		// use: encoded or literal
		'encoded',
		// description: documentation for the method
		'Returns a player with compact info from stats database.');
	
	$server->register(
		// method name:
		'GetPlayersCompact', 	
		// parameter list:
		array('commaSeparatedSteamId' => 'xsd:string'), 
		// return value(s):
		array('return' => 'tns:PlayersCompact'),
		// namespace:
		$namespace,
		// soapaction: (use default)
		false,
		// style: rpc or document
		'rpc',
		// use: encoded or literal
		'encoded',
		// description: documentation for the method
		'Returns a player with compact info from stats database.');
	
	$server->register(
		// method name:
		'GetTopPlayersCompact', 	
		// parameter list:
		array('startIndex' => 'xsd:int', 'pageSize' => 'xsd:int'), 
		// return value(s):
		array('return' => 'tns:PlayersCompact'),
		// namespace:
		$namespace,
		// soapaction: (use default)
		false,
		// style: rpc or document
		'rpc',
		// use: encoded or literal
		'encoded',
		// description: documentation for the method
		'Returns players with compact info from stats database.');
	
  $g_link = false;
 
  function GetDbConnection()
  {
    global $g_link, $mysql_db, $mysql_server, $mysql_user, $mysql_password;
    
    if ($g_link)
    {
    	return $g_link;
    }
    
    $g_link = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db) or die('Could not connect to server.');
    $g_link->query("SET NAMES 'utf8'");
    
    return $g_link;
  }

  function CleanUpDb()
  {
		global $g_link;
		
		if ($g_link != false)
		{
			mysql_close($g_link);
		}
		
		$g_link = false;
  }
	
	function ParsePlayer($row)
	{
		return array(
			'steamid' => $row["steamid"],
			'name' => $row["name"],
			'lastontime' => $row["lastontime"],
			'lastgamemode' => $row["lastgamemode"],
			'ip' => $row["ip"],
			'playtime' => $row["playtime"],
			'playtime_versus' => $row["playtime_versus"],
			'playtime_realism' => $row["playtime_realism"],
			'playtime_survival' => $row["playtime_survival"],
			'playtime_scavenge' => $row["playtime_scavenge"],
			'playtime_realismversus' => $row["playtime_realismversus"],
			'points' => $row["points"],
			'points_realism' => $row["points_realism"],
			'points_survival' => $row["points_survival"],
			'points_survivors' => $row["points_survivors"],
			'points_infected' => $row["points_infected"],
			'points_scavenge_survivors' => $row["points_scavenge_survivors"],
			'points_scavenge_infected' => $row["points_scavenge_infected"],
			'points_realism_survivors' => $row["points_realism_survivors"],
			'points_realism_infected' => $row["points_realism_infected"],
			'kills' => $row["kills"],
			'melee_kills' => $row["melee_kills"],
			'headshots' => $row["headshots"],
			'kill_infected' => $row["kill_infected"],
			'kill_hunter' => $row["kill_hunter"],
			'kill_smoker' => $row["kill_smoker"],
			'kill_boomer' => $row["kill_boomer"],
			'kill_spitter' => $row["kill_spitter"],
			'kill_jockey' => $row["kill_jockey"],
			'kill_charger' => $row["kill_charger"],
			'versus_kills_survivors' => $row["versus_kills_survivors"],
			'scavenge_kills_survivors' => $row["scavenge_kills_survivors"],
			'realism_kills_survivors' => $row["realism_kills_survivors"],
			'jockey_rides' => $row["jockey_rides"],
			'charger_impacts' => $row["charger_impacts"],
			'award_pills' => $row["award_pills"],
			'award_adrenaline' => $row["award_adrenaline"],
			'award_fincap' => $row["award_fincap"],
			'award_medkit' => $row["award_medkit"],
			'award_defib' => $row["award_defib"],
			'award_charger' => $row["award_charger"],
			'award_jockey' => $row["award_jockey"],
			'award_hunter' => $row["award_hunter"],
			'award_smoker' => $row["award_smoker"],
			'award_protect' => $row["award_protect"],
			'award_revive' => $row["award_revive"],
			'award_rescue' => $row["award_rescue"],
			'award_campaigns' => $row["award_campaigns"],
			'award_tankkill' => $row["award_tankkill"],
			'award_tankkillnodeaths' => $row["award_tankkillnodeaths"],
			'award_allinsafehouse' => $row["award_allinsafehouse"],
			'award_friendlyfire' => $row["award_friendlyfire"],
			'award_teamkill' => $row["award_teamkill"],
			'award_left4dead' => $row["award_left4dead"],
			'award_letinsafehouse' => $row["award_letinsafehouse"],
			'award_witchdisturb' => $row["award_witchdisturb"],
			'award_pounce_perfect' => $row["award_pounce_perfect"],
			'award_pounce_nice' => $row["award_pounce_nice"],
			'award_perfect_blindness' => $row["award_perfect_blindness"],
			'award_infected_win' => $row["award_infected_win"],
			'award_scavenge_infected_win' => $row["award_scavenge_infected_win"],
			'award_bulldozer' => $row["award_bulldozer"],
			'award_survivor_down' => $row["award_survivor_down"],
			'award_ledgegrab' => $row["award_ledgegrab"],
			'award_gascans_poured' => $row["award_gascans_poured"],
			'award_upgrades_added' => $row["award_upgrades_added"],
			'award_matador' => $row["award_matador"],
			'award_witchcrowned' => $row["award_witchcrowned"],
			'award_scatteringram' => $row["award_scatteringram"],
			'infected_spawn_1' => $row["infected_spawn_1"],
			'infected_spawn_2' => $row["infected_spawn_2"],
			'infected_spawn_3' => $row["infected_spawn_3"],
			'infected_spawn_4' => $row["infected_spawn_4"],
			'infected_spawn_5' => $row["infected_spawn_5"],
			'infected_spawn_6' => $row["infected_spawn_6"],
			'infected_spawn_8' => $row["infected_spawn_8"],
			'infected_boomer_vomits' => $row["infected_boomer_vomits"],
			'infected_boomer_blinded' => $row["infected_boomer_blinded"],
			'infected_hunter_pounce_counter' => $row["infected_hunter_pounce_counter"],
			'infected_hunter_pounce_dmg' => $row["infected_hunter_pounce_dmg"],
			'infected_smoker_damage' => $row["infected_smoker_damage"],
			'infected_jockey_damage' => $row["infected_jockey_damage"],
			'infected_jockey_ridetime' => $row["infected_jockey_ridetime"],
			'infected_charger_damage' => $row["infected_charger_damage"],
			'infected_tank_damage' => $row["infected_tank_damage"],
			'infected_tanksniper' => $row["infected_tanksniper"],
			'infected_spitter_damage' => $row["infected_spitter_damage"],
			'mutations_kills_survivors' => $row["mutations_kills_survivors"],
			'playtime_mutations' => $row["playtime_mutations"],
			'points_mutations' => $row["points_mutations"]
		);
	}

	function GetPlayer($steamId)
	{
		global $l4dstats_web_installed, $mysql_tableprefix, $enable_soap;
		
		if (!$enable_soap || !$l4dstats_web_installed)
		{
			return NULL;
		}

		GetDbConnection();
		
		$query = "select * from " . $mysql_tableprefix . "players where steamid = '" . mysqli_real_escape_string($steamId) . "'";
  	$result = $g_link->query($query);
	
		if (!$result)
		{
			CleanUpDb();
			return NULL;
		}
	
		if (!($row = $result->fetch_assoc()))
		{
			CleanUpDb();
			return NULL;
		}
	
		$retval = ParsePlayer($row);
		
		CleanUpDb();
		
		return $retval;
	}
	
	function ParsePlayerCompact($row)
	{
		return array(
			'steamid' => $row["steamid"],
			'name' => $row["name"],
			'lastontime' => $row["lastontime"],
			'playtime' => $row["playtime"],
			'points' => $row["points"],
			'kills' => $row["kills"],
			'kill_infected' => $row["kill_infected"]
		);
	}

	function GetPlayerCompact($steamId)
	{
		global $l4dstats_web_installed, $mysql_tableprefix, $enable_soap;
		
		if (!$enable_soap || !$l4dstats_web_installed)
		{
			return NULL;
		}

		GetDbConnection();
		
		$query = "select steamid, name, lastontime, playtime, points, kills, kill_infected from " . $mysql_tableprefix . "players where steamid = '" . mysqli_real_escape_string($steamId) . "'";
  	$result = $g_link->query($query);
	
		if (!$result)
		{
			CleanUpDb();
			return NULL;
		}
	
		if (!($row = $result->fetch_assoc()))
		{
			CleanUpDb();
			return NULL;
		}
	
		$retval = ParsePlayerCompact($row);
		
		CleanUpDb();
		
		return $retval;
	}

	function GetPlayersCompact($commaSeparatedSteamId)
	{
		global $l4dstats_web_installed, $mysql_tableprefix, $enable_soap;
		
		if (!$enable_soap || !$l4dstats_web_installed)
		{
			return NULL;
		}

		$steamIds = explode(',', $commaSeparatedSteamId);
		
		foreach ($steamIds as $steamId)
		{
			$securedSteamIds[] = "steamid = '" . mysqli_real_escape_string($steamId) . "'";
		}
		
		if (!isset($securedSteamIds))
		{
			return NULL;
		}
		
		$where = "where " . implode(' or ', $securedSteamIds);
		
		GetDbConnection();
		
		$query = "select steamid, name, lastontime, playtime, points, kills, kill_infected from " . $mysql_tableprefix . "players " . $where;
  	$result = $g_link->query($query);
	
		if (!$result)
		{
			CleanUpDb();
			return NULL;
		}

		while ($row = $result->fetch_assoc())
		{
			$retval[] = ParsePlayerCompact($row);
		}	
		
		CleanUpDb();
		
		if (!isset($retval))
		{
			return NULL;
		}
		
		return $retval;
	}

	function GetTopPlayersCompact($startIndex, $pageSize)
	{
		global $l4dstats_web_installed, $mysql_tableprefix, $enable_soap;
		
		if (!$enable_soap || !$l4dstats_web_installed || !is_int($startIndex) || !is_int($pageSize))
		{
			return NULL;
		}

		GetDbConnection();
		
		$query = "select steamid, name, lastontime, playtime, points, kills, kill_infected from " . $mysql_tableprefix . "players order by points desc limit " . $startIndex . ", " . ($startIndex + $pageSize);
  	$result = $g_link->query($query);
	
		if (!$result)
		{
			CleanUpDb();
			return NULL;
		}

		while ($row = $result->fetch_assoc())
		{
			$retval[] = ParsePlayerCompact($row);
		}	
		
		CleanUpDb();
		
		if (!isset($retval))
		{
			return NULL;
		}
		
		return $retval;
	}

	// Use the request to (try to) invoke the service
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>