<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

 

$connect = dbcon();

require "count.php";
?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
<?
require "popup_proc.php";
require "popup_layer.php";
?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="main">
		<?php virtual('/include/header.php'); ?>
	 