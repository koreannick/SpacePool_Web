<?

if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

## 페이징 설정 ##
if(!$num_per_page){	$num_per_page = 15;	}
if(!$page_per_block){	$page_per_block = 10;	}
if(!$page){			$page=1;	}

$search = urldecode($search);

if($status){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "status = '$status' ";
}

if($search){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "$skey Like '%$search%' ";
}

if($skind){
	if($tmp_where){	$tmp_where .= "And ";	}
	$tmp_where .= "kind = '$skind' ";
}

if($tmp_where){	$tmp_where .= "And ";	}
$tmp_where .= "top=0 ";

if($tmp_where){
	$tmp_where = "Where " . $tmp_where;
}

$result = mysql_query("Select count(*) From $table $tmp_where");
if(!$result)		redir_proc("/","");
$total_record = mysql_result($result,0,0);
@mysql_free_result($result);
flush2();

$total_page = ceil($total_record/$num_per_page);
if($total_page==0)		$total_page = 1;
$start = $num_per_page * ($page - 1);
$index = $total_record - ($num_per_page * ($page - 1));
?>
<link rel="stylesheet" href="/s_source/esboard/board.css">
<script language=javascript src="/s_inc/total_script.js"></script>
<script language=javascript>
<!--
function check_search(){
	var form = document.form0;
	if(form.search.value){
		form.mode.value = "list";
		form.page.value = 1;
		return true;
	}else{
		return err_proc(form.search, "Enter the Keyword!");
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

<form name="form0" method="get" action="<?=$_SERVER[PHP_SELF]?>" onSubmit="return check_search();">
<input type="hidden" name="mode" value="list">
<input type="hidden" name="uid">
<input type="hidden" name="page" value="<?=$page?>">
<?if($kind_chk){?>
<input type="hidden" name="skind" value="<?=$skind?>">
<?}?>

<?if($board_type=="gallery"){?>
<div id="board-ocean-gallery-list">
    <!-- 리스트 시작 -->
    <div class="board-list">
	<?
	$result = mysql_query("Select * From $table $tmp_where Order By uid desc Limit $start, $num_per_page");
	if(!$result){
		redir_proc($PHP_SELF,"Error.");
		exit;
	}
	if($total_record>0){
		$i = 1;
		while($row=mysql_fetch_array($result)){
			$uid = $row["uid"];
			$subject = han_cut(stripslashes($row["subject"]),44);
			$wdate = $row["wdate"];
			$name = $row["name"];
			$wdate = date("Y/m/d",$wdate);

			$file = "";
			$sresult = mysql_query("Select file From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc Limit 1");
			if($sresult&&mysql_num_rows($sresult)>0){
				$file = stripslashes(mysql_result($sresult,0,0));
			}
			@mysql_free_result($sresult);

			if($listonly)		$subject = "<b>".stripslashes($row["subject"])."</b>";
			else				$subject = "<a href=# onClick=\"view('$uid');return false;\"><b>" . $subject . "</b></a> " . $new_img;

			$resultc = mysql_query("select count(uid) from es_comment_board where puid = '$uid' and tbl = '$table'");
			if(mysql_result($resultc,0,0)>0){
				$comment_cnt = " [".mysql_result($resultc,0,0)."]";
			}else{
				$comment_cnt = "";
			}
			@mysql_free_result($resultc);
	?>
		<div class="board-gallery-item">
            <div class="board-gallery-thumbnail"><img src="<?=$link_path."thum/".rawurlencode("t_".$file)?>" alt="" onerror="this.src='/s_source/images/bbs/noimg.jpg';" />
                <div class="board-gallery-foreground"><a href="#" onClick="view('<?=$uid?>');return false;"><img src="/s_source/esboard/over-foreground.png" style="max-width: 220px;" alt="" /></a></div>
                <div class="board-gallery-username"><?=$wdate?> by. <?=$name?></div>
            </div>
            <div class="board-gallery-title cut_strings"><?=$subject?><?if($comment_cnt>0)		echo "(".$comment_cnt.")";?></div>
        </div>

	<?
		}
	}else{

	}
	@mysql_free_result($result);
	?>
    </div>
    <!-- 리스트 끝 -->
</div>
<?}elseif($board_type=="webzine"){?>
<div id="board-webzine-list">
    <div class="board-header"> </div>

	<!-- 리스트 시작 -->
    <div class="board-list">
	<?
	$result = mysql_query("Select * From $table $tmp_where Order By uid desc Limit $start, $num_per_page");
	if(!$result){
		redir_proc($PHP_SELF,"Error.");
		exit;
	}
	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$subject = stripslashes(trim($row["subject"]));
		$comment = stripslashes(trim($row["comment"]));
		$name = stripslashes(trim($row["name"]));
		$subject = han_cut($subject,46);
		$comment = han_cut(strip_tags($comment),100);
		$wdate = $row["wdate"];
		$readno = $row["readno"];
		$new_time = 1 * 24 * 60 * 60 * 2 ;	// 하루
		$file_img = "";

		// 파일정보
		$sql = "Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc Limit 1";
		$sresult = mysql_query($sql, $connect);
		if($srow=mysql_fetch_array($sresult)){
			$file = $srow[file];
			$extension = selectExtension($file);
			if($extension=="gif"||$extension=="jpg"||$extension=="bmp"||$extension=="png"){
				$file_img = "<img src='${link_path}thum/".rawurlencode("t_".$file)."' style=\"max-width: 100%; height: 100%;\" alt=\"\" />";
			}
		}

		$wdate = date("Y/m/d",$wdate);

		$subject = "<a href=# onClick=\"view('$uid');return false;\"><b>" . $subject . "</b></a> " . $new_img;
	?>
        <div class="board-webzine-item">
            <div class="board-webzine-thumbnail"><a href="#" onClick="view('<?=$uid?>');return false;"><?=$file_img?></a></div>
            <div class="board-webzine-wrap">
                <div class="board-webzine-title cut_strings"><a href="#" onClick="view('<?=$uid?>');return false;"><?=$subject?></a></div>
                <div class="board-webzine-content"><a href="#" onClick="view('<?=$uid?>');return false;"><?=$comment?></a></div>
                <div class="board-webzine-info"> <span class="board-info-name">Date :</span> <span class="board-info-value"><?=$wdate?></span> <span class="board-info-separator">|</span> <span class="board-info-name">Author :</span> <span class="board-info-value"><?=$name?></span> <span class="board-info-separator">|</span> <span class="board-info-name">Hit :</span> <span class="board-info-value"><?=$readno?></span> </div>
            </div>
        </div>
<?
		$index--;
	}
?>
    </div>
    <!-- 리스트 끝 -->
</div>
<?}else{?>
<div id="board-thumbnail-list">
    <!-- 리스트 시작 -->
    <div class="board-list">
        <table>
            <thead>
                <tr>
                    <td class="board-list-uid">No</td>
                    <td class="board-list-title">Title</td>
                    <td class="board-list-user">Author</td>
                    <td class="board-list-date">Date</td>
                    <td class="board-list-view">Hit</td>
                </tr>
            </thead>
            <tbody>
				<?
				// Top 글 ///////////////////////////////////////////////////////////////////////////////
				$result = mysql_query("Select * From $table Where top=1 Order By wdate desc, uid desc limit 0,10");
				if(!$result){
					redir_proc($PHP_SELF,"Error.");
					exit;
				}
				while($row = mysql_fetch_array($result)){
					$uid = $row["uid"];
					$name = $row["name"];
					$subject = han_cut(stripslashes($row["subject"]),68);
					$readno = $row["readno"];
					$wdate = $row["wdate"];
					$new_time = 1 * 24 * 60 * 60 * 2;	//2일
					$kind = $row["kind"];

					// 파일정보
					$sresult = mysql_query("Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc Limit 1");
					if($srow=mysql_fetch_array($sresult)){
						$file = trim($srow[file]);
						$extension = selectExtension($file);
						$file_icon = "<img src=/s_source/images/file/" . $extension . ".gif alt=\"\" />&nbsp;";
					}else{
						$file_icon = "";
					}

					// new 글
					$new_img = "";
					if($wdate > (time() - $new_time))				$new_img = "<img src='/s_source/images/bbs/icon_n.jpg' alt=\"\" />";
					$wdate = date("Y.m.d", $wdate);

					$resultc = mysql_query("select count(uid) from es_comment_board where puid = '$uid' and tbl = '$table'");
					if(mysql_result($resultc,0,0)>0){
						$comment_cnt = " [".mysql_result($resultc,0,0)."]";
					}else{
						$comment_cnt = "";
					}
					@mysql_free_result($resultc);

					$subject = "<a href=# onClick=\"view('$uid');return false;\">" . $subject . "</a> " . $new_img;
					?>
                <tr>
                    <td class="board-list-uid"><img src="/s_source/images/bbs/icon_notice.jpg" alt="Notice"></td>
                    <td class="board-list-title">
                        <div class="cut_strings"><?=$file_icon.$subject?><?if($comment_cnt>0)		echo " (".$comment_cnt.")";?></div>
                    </td>
                    <td class="board-list-user"><?=$name?></td>
                    <td class="board-list-date"><?=$wdate?></td>
                    <td class="board-list-view"><?=$readno?></td>
                </tr>
				<?
				}
				@mysql_free_result($result);

				if($total_record>0){
					$result = mysql_query("Select * From $table $tmp_where Order By gid desc, thread Asc Limit $start, $num_per_page");
					if(!$result){
						redir_proc($PHP_SELF,"Error.");
						exit;
					}
					while($row = mysql_fetch_array($result)){
						$uid = $row["uid"];
						$name = $row["name"];
						$subject = han_cut(stripslashes($row["subject"]),68);
						$readno = $row["readno"];
						$wdate = $row["wdate"];
						$thread = $row["thread"];
						$new_time = 1 * 24 * 60 * 60 * 2 ;	// 2일
						$secret = $row["secret"];
						$kind = $row["kind"];

						// 파일정보
						$sresult = mysql_query("Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc Limit 1");
						if($srow=mysql_fetch_array($sresult)){
							$file = trim($srow[file]);
							$extension = selectExtension($file);
							$file_icon = "<img src=/s_source/images/file/" . $extension . ".gif alt=\"\" />&nbsp;";
						}else{
							$file_icon = "";
						}

						// new 글
						$new_img = "";
						if($wdate > (time() - $new_time))				$new_img = "<img src='/s_source/images/bbs/icon_n.jpg' alt=\"\" />";
						$wdate = date("Y.m.d", $wdate);

						//들여쓰기
						$blank = "";
						for($k=1; $k<strlen($thread); $k++){
							$blank .= "&nbsp;&nbsp;";
						}

						if($blank)	$icon = "$blank<img src='/s_source/images/bbs/reply.gif' alt=\"\" /> ";
						else			$icon = "";

						if($kind){
							if($secret==1){
								$subject = $icon . "&nbsp;<a href=# onClick=\"scret_view('$uid');return false;\" title='$subject'>[".$kind_arr[$kind]."] ".$subject . "</a> <img src='/s_source/images/key.gif' alt=\"\" />" . $new_img;
							}else{
								$subject = $icon . "&nbsp;<a href=# onClick=\"view('$uid');return false;\" title='$subject'>[".$kind_arr[$kind]."] " . $subject . "</a> " . $new_img;
							}
						}else{
							if($secret==1){
								$subject = $icon . "&nbsp;<a href=# onClick=\"scret_view('$uid');return false;\" title='$subject'>" . $subject . "</a> <img src='/s_source/images/key.gif' alt=\"\" />" . $new_img;
							}else{
								$subject = $icon . "&nbsp;<a href=# onClick=\"view('$uid');return false;\" title='$subject'>" . $subject . "</a> " . $new_img;
							}
						}

						$resultc = mysql_query("select count(uid) from es_comment_board where puid = '$uid' and tbl = '$table'");
						if(mysql_result($resultc,0,0)>0){
							$comment_cnt = " [".mysql_result($resultc,0,0)."]";
						}else{
							$comment_cnt = "";
						}
						@mysql_free_result($resultc);

				?>
                <tr>
                    <td class="board-list-uid"><?=$index?></td>
                    <td class="board-list-title">
                        <div class="cut_strings"><?=$file_icon.$subject?><?if($comment_cnt>0)		echo " (".$comment_cnt.")";?></div>
                    </td>
                    <td class="board-list-user"><?=$name?></td>
                    <td class="board-list-date"><?=$wdate?></td>
                    <td class="board-list-view"><?=$readno?></td>
                </tr>
                <?
						$index--;
					}
					@mysql_free_result($result);
				}else{
					echo "<tr><td colspan=5 >No Data.</td></tr>";
				}
				?>
			</tbody>
        </table>
    </div>
    <!-- 리스트 끝 -->
</div>
<?}?>
<div id="board-ocean-gallery-list">
	<?if($total_record>0){?>
    <!-- 페이징 시작 -->
    <div class="board-pagination">
        <ul class="board-pagination-pages">
		<?
			$link = $_SERVER[PHP_SELF] . "?mode=list&skey=$skey&search=$search&skind=$skind";

			$total_page = ceil($total_record/$num_per_page);
			if($total_page==0){
				$total_page = 1;
			}

			$page_i = ( ( (int)( ($page - 1 ) / $page_per_block ) ) * $page_per_block ) + 1;
			$end_page = $page_i + $page_per_block - 1;


			if($page > $page_per_block){
				echo "<li><a href=\"" . $link . "&page=" . ($page-$page_per_block) . "\">≪</a></li>";
			}else{
				echo "<li><a href=\"#\">≪</a></li>";
			}

			for($i=$page_i; $i<=$end_page; $i++){
				if($i <= $total_page){
					if($i == $page){
						echo "<li class=\"active\"><a href=\"" . $link . "&page=" . $i . "\">$i</a></li>";
					}else{
						echo "<li><a href=\"" . $link . "&page=" . $i . "\">$i</a></li>";
					}
				}
			}

			if($total_page > ($page + $page_per_block)){
				echo "<li><a href=\"" . $link . "&page=" . ($page+$page_per_block) . "\">≫</a></li>";
			}else{
				echo "<li><a href=\"#\">≫</a></li>";
			}
		?>
        </ul>
    </div>
    <!-- 페이징 끝 -->


		<?if($searchform){?>
        <div class="board-search">
            <select name="skey">
                <option value="subject" <?if($skey=="subject")	echo "selected";?>>Title</option>
                <option value="comment" <?if($skey=="comment")	echo "selected";?>>Contents</option>
                <option value="name" <?if($skey=="name")	echo "selected";?>>Author</option>
            </select>
            <input type="text" name="search" value="<?=$search?>">
            <button type="submit" class="board-ocean-gallery-button-small">Search</button>
        </div>
		<?}?>
	<?}?>

	<?if($writable){?>
    <!-- 버튼 시작 -->
    <div class="board-control"> <a href="<?=$PHP_SELF?>?mode=write&skind=<?=$skind?>" class="board-ocean-gallery-button-small">Write</a> </div>
    <!-- 버튼 끝 -->
	<?}?>
</div>
</form>
<br /><br />