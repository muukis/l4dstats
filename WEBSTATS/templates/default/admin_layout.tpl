<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<?php echo $statspagemeta;?>
	
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>  
	
	<title>Left 4 Dead 2 Player Stats :: <?php echo $title;?></title>
	<link href="./templates/Left4Dark/css/style.css" rel="stylesheet" type="text/css" />
	<link href="./templates/Left4Dark/css/player.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://servers.gamefurs.net/l4d2stats/savi/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="http://servers.gamefurs.net/l4d2stats/savi/steamprofile.js"></script>
</head>
<body>

<!-- start tooltip control -->
<script type="text/javascript" src="./templates/Left4Dark/js/statstooltip.js"></script>
<!-- end tooltip control -->

<!-- start combobox control -->
<script type="text/javascript" src="./templates/Left4Dark/js/statscombobox.js"></script>
<!-- end combobox control -->

<!-- start header -->
<div id="header">
</div>

<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content" style="margin-bottom:0px;height:0px;">
                <div class="post">
			<h1 class="title" style="background: none; padding: 0; margin-top: -10px;"><?php echo $page_heading;?></h1>
		</div>

		<?php echo $body;?>
	</div>
	<!-- end content -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->

<!-- start footer -->
<div id="footer">
	<p id="legal">
		<span id="legal1">Copyright &copy; 2010 <a href="http://forums.alliedmods.net/member.php?u=52082">muukis</a> | Left 4 Dead Stats written for <a href="http://forums.alliedmods.net/showthread.php?t=115965">SourceMod</a> | Designed by <a href="http://gamefurs.net/jonnyboy0719/">Johan Ehrendahl</a></span><br>
	</p>
</div>
<!-- end footer -->
</body>
</html>