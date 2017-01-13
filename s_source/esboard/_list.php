<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가
?>
<link rel="stylesheet" href="/s_source/esboard/board.css">
<script language=javascript src="/s_inc/total_script.js"></script>
<script language=javascript>
<!--
var page_url = "<?=$PHP_SELF?>?mode=list_ok&skind=<?=$skind?>&skey=<?=$skey?>&search=<?=$search?>&page=";
var result_id = "list_result";
var method = "post";

function check_search(){
	var form = document.form0;
	if(form.skind){
		Ajax_Request("<?=$PHP_SELF?>?mode=list_ok&page=1&skind="+form.skind.value+"&skey="+form.skey.value+"&search="+form.search.value,result_id,"Get");
	}else{
		Ajax_Request("<?=$PHP_SELF?>?mode=list_ok&page=1&skey="+form.skey.value+"&search="+form.search.value,result_id,"Get");
	}
}

<?	if($writable){	?>
function go_write(){
	var form = document.form0;
	form.mode.value = "write";
	form.submit();
}
<?}?>

function view(uid){
	var form = document.form0;
	form.mode.value = "view";
	form.uid.value = uid;
	form.submit();
}
<?if($w_secret){?>
function scret_view(uid){
	var form = document.form0;
	form.mode.value = "secret_view";
	form.uid.value = uid;
	form.submit();
}
<?}?>
-->
</script>
<?if($listonly){?>
<link href="/s_source/thumbnail.css" rel="stylesheet" type="text/css" />
<script src="/s_source/thumbnailviewer.js" type="text/javascript"></script>
<?}?>
<div id="list_result">

</div>
<script type="text/javascript">
<!--
$(document).ready(function(){
	PageLoad(page_url,1);
});

$(function (){
	$(window).unbind('hashchange').bind('hashchange', function (e){
		page_url = "<?=$PHP_SELF?>?mode=list_ok&skind="+skind+"&skey="+skey+"&search="+search+"&page=";
		PageLoad(page_url,1);
	});
});

function PageLoad(page_url,page){
	if(document.location.hash){
		var HashLocationName = document.location.hash;
		HashLocationName = HashLocationName.replace(/^.*#/, '');
		Ajax_Request(page_url+HashLocationName,result_id,method);
	}else{
		Ajax_Request(page_url+page,result_id,method);
	}
}
//-->
</script>