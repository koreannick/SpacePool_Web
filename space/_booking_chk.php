<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";

$connect = dbcon();

foreach($_POST as $key => $val){
	$$key = bad_tag_convert2($val);
}

require "_booking_chk_qry.php";
?>
<form name="bFrm" method="post" action="/space/booking.php" target="_parent">
<input type="hidden" name="uid" value="<?=$uid?>">
<input type="hidden" name="btype" value="<?=$btype?>">
<input type="hidden" name="sDate" value="<?=$sDate?>">
<input type="hidden" name="etc2" value="<?=$etc2?>">
<input type="hidden" name="eDate" value="<?=$eDate?>">
<input type="hidden" name="person" value="<?=$person?>">
<input type="hidden" name="sTime" value="<?=$sTime?>">
<input type="hidden" name="eTime" value="<?=$eTime?>">
<input type="hidden" name="sc_1" value="<?=$sc_1?>">
<input type="hidden" name="sc_2" value="<?=$sc_2?>">
<input type="hidden" name="sc_3" value="<?=$sc_3?>">
</form>
<script type="text/javascript">
document.bFrm.submit();
</script>
