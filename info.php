<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
?>
<!doctype html>
<html>
<head>
<?php virtual('/include/headinfo.php'); ?>

<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:14px;
	top:139px;
	width:420px;
	height:214px;
	z-index:1;
}
-->
</style>
</head>
<body>
<div id="apDiv1">
  <div align="center">
    <textarea name="textfield" cols="74" rows="14" class="inputbox_multi" id="textfield" style="padding:10px 10px 10px 10px; width:400px;"  readonly="readonly"><?include $DOCUMENT_ROOT."/s_source/member/_yack_txt2.php"?></textarea>
  </div>
</div>
<a href="javascript:window.close();"><img src="/images/info.gif" width="450" height="400" border="0"></a>
</body>
</html>
