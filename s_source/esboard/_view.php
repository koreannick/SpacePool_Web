<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if($viewable==0){
	echo "<script>alert('접근권한이 없습니다.');location.href='/';</script>";
	exit;
}
$uid = (int)$uid;
$page = (int)$page;

if(!$connect){	$connect=dbcon();	}

$result = mysql_query("select * from $table where uid=$uid");
if($row = mysql_fetch_array($result)){
	foreach($row as $key => $val){
		$$key = stripslashes(trim($val));
	}
	@mysql_free_result($result);
	if($secret==1){
		if($USESSION2[0]==$uid&&$USESSION2[1]=="true"){
		}else{
			redir_proc("$PHP_SELF?mode=secret_view&uid=$uid&page=$page&skey=$skey&skind=$skind&search=$search","");
		}
	}


	// 새글 이미지 달기 ------------------------------------------------------------
	$new_time = 1 * 24 * 60 * 60 * 2;	// 2일
	$new_img = "";
	if((time() - $wdate) < $new_time)		$new_img = "<img src='/s_source/images/bbs/icon_n.jpg' alt=\"\" />";
	else												$new_img = "";
	//-------------------------------------------------------------------------------
	$wdate = date("Y.m.d H:i", $wdate);

	if($skind)			$where = " and kind = '$skind' ";

	//이전글 구하기
	$resultp = mysql_query("select uid from $table where uid < $uid and thread = 'a' $where order by uid desc limit 1");
	if(mysql_num_rows($resultp)>0){
		$prev_uid = mysql_result($resultp,0,0);
		$prev_link = $PHP_SELF."?mode=view&uid=".$prev_uid."&skind=".$skind;
	}
	@mysql_free_result($resultp);
	//다음글 구하기
	$resultn = mysql_query("select uid from $table where uid > $uid and thread = 'a' $where order by uid asc limit 1");
	if(mysql_num_rows($resultn)>0){
		$next_uid = mysql_result($resultn,0,0);
		$next_link = $PHP_SELF."?mode=view&uid=".$next_uid."&skind=".$skind;
	}
	@mysql_free_result($resultn);
	$comment = preg_replace("/(\<img )([^\>]*)(\>)/i", "\\1 name='target_resize_image[]' onclick='image_window(this)' \\2 \\3", $comment);

	$puid = $uid;
}else{
	redir_proc("/","데이터가 존재하지 않습니다.");
	exit;
}
@mysql_free_result($result);

@mysql_query("Update $table Set readno = readno+1 Where uid = $uid");

$save_path = $DOCUMENT_ROOT."/DATAS/".$table."/";
?>
<link href="/s_source/esboard/board.css" rel="stylesheet" type="text/css">
<link href="/s_source/SmartEditor2/css/smart_editor2.css" rel="stylesheet" type="text/css">
<script src="/s_inc/total_script.js"></script>
<link href="/s_source/thumbnail.css" rel="stylesheet" type="text/css" />
<script src="/s_source/thumbnailviewer.js" type="text/javascript"></script>
<script language=javascript>
<!--
// 리스트
function go_list(){
	var form = document.form0;
	form.mode.value = "list";
	form.submit();
}
<?if($replable){?>
// 답글
function reply(){
	var form = document.form0;
	form.mode.value = "reply";
	form.submit();
}
<?}?>
<?	if($writable){	?>
// 쓰기
function go_write(){
	var form = document.form0;
	form.mode.value = "write";
	form.submit();
}
// 수정
function edit(){
	var form = document.form0;
	form.mode.value = "edit";
	form.submit();
}
// 삭제
function del_check(){
	var form = document.form0;
	form.mode.value = "del";
	form.submit();
}
<?}?>
-->
</script>


<div id="board-thumbnail-document">
    <div class="board-document-wrap">
        <div class="board-title" itemprop="name">
            <p><?=($top)?"<img src=/s_source/images/bbs/icon_notice.jpg alt=공지 width=32 height=13 border=0 align=absmiddle>":""?> <?=$subject?></p>
        </div>
        <div class="board-detail">
			<?if($board_type=="bbs"){?>
            <div class="detail-attr detail-writer">
                <div class="detail-name">작성자</div>
                <div class="detail-value"><?=$name?></div>
            </div>
			<?}?>
            <div class="detail-attr detail-date">
                <div class="detail-name">작성일</div>
                <div class="detail-value"><?=$wdate?></div>
            </div>
            <div class="detail-attr detail-view">
                <div class="detail-name">조회</div>
                <div class="detail-value"><?=number_format($readno)?></div>
            </div>
        </div>
        <div class="board-content" >
            <div class="content-view">
			<?
			if($file_num>0){
				$result = mysql_query("Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc");
				if(mysql_num_rows($result)>0){
					$file_list = "";
					while($row=mysql_fetch_array($result)){
						$file = $row["file"];
						$ext = strtolower(substr($file, strrpos($file, ".")+1));
						if($ext=="gif" || $ext=="jpg" || $ext=="jpeg" || $ext=="png"){
							if(file_exists($save_path.$file)){
								echo "<img src='$link_path".rawurlencode($file)."' $width alt=\"\" name='target_resize_image[]' onclick='image_window(this)' /><br />";
							}
						}elseif($ext=="wmv"||$ext=="avi"){
							echo "<embed src='$link_path".rawurlencode($file)."' width=400 height=300></embed>";
						}

						$extension = selectExtension($file);
						$file_icon = "<img src=/s_source/images/file/" . $extension . ".gif alt=\"\" />&nbsp;";

						if($downble)	$file_list .= "<a href=\"/s_source/download.php?table=$table&uid=$uid&filename=".rawurlencode($file)."\" title=\"$file\">$file_icon $file</a>&nbsp;";
						else				$file_list .= "${file}&nbsp;&nbsp;";

						flush2();
					}
				}
				@mysql_free_result($result);
			}


			echo $comment;
			?>
			</div>
        </div>
		<?
		if($board_type!="gallery"){
			if($file_list)			echo "<div class=\"board-attach\"> 첨부파일 : ".$file_list."</div>";
		}
		?>
    </div>
	<div class="board-comments-area">
		<?
		if($commentable){
			$tbl = $table;
			include_once($_SERVER[DOCUMENT_ROOT] . "/s_source/esboard/_comment.php");
		}
		?>
        <div class="board-control">
            <div class="left"> <a href="#" onClick="go_list();return false;" class="board-thumbnail-button-small">목록보기</a><?if($prev_link){?> <a href="<?=$prev_link?>" class="board-thumbnail-button-small">이전글</a><?}?><?if($next_link){?> <a href="<?=$next_link?>" class="board-thumbnail-button-small">다음글</a><?}?> </div>
			<?
			//if($board_type=="bbs"){
				if($writable&&!$top){
			?>
            <div class="right"><?if($replable){?> <a href="#" onClick="reply();return false;" class="board-thumbnail-button-small">답글쓰기</a><?}?> <a href="#" onClick="edit();return false;" class="board-thumbnail-button-small">글수정</a> <a href="#" onClick="del_check();return false;" class="board-thumbnail-button-small">글삭제</a> </div>
			<?
				}
			//}
			?>
        </div>
    </div>
</div>
<form name="form0" method="POST" action="<?=$_SERVER[PHP_SELF]?>">
<input type="hidden" name="mode" value="list">
<input type="hidden" name="uid" value="<?=$puid?>">
<input type="hidden" name="page" value="<?=$page?>">
<?if($kind_chk){?><input type="hidden" name="skind" value="<?=$skind?>"><?}?>
</form>
<script type="text/javascript">
window.onload=function() {
	<?if($mobile){?>
	resizeBoardImage_M();
	<?}else{?>
    resizeBoardImage(850);
	<?}?>
}
</script>