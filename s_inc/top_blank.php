<html>
<head>
<title><?=$CONF_TITLE_TAG?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?if($mode!="excel"){?>
<link href="/css/gautech.css" rel="stylesheet" type="text/css" />
<link rel=stylesheet href=/s_inc/total_style.css type=text/css>
<script language=javascript src=/s_inc/total_script.js></script>
<?}?>
</head>
<body <?=$CONF_BGCOLOR?> leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="page_load();">
		<?	if($page_title){	?>
		<table width=100% cellpadding=0 cellspacing=1>
		<tr><td colspan=2 height=1 bgcolor=#aaaaaa></td></tr>
		<tr>
		<td bgcolor=#eeeeee><font size=3 color=green style=font-weight:bold;height:30;padding:5;><?=$page_title?></font></td>
		</tr>
		<tr><td colspan=2 height=1 bgcolor=#aaaaaa></td></tr>
		<tr><td colspan=2 height=5></td></tr>
		</table>
		<?	}	?>
<center>