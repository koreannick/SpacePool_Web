<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if($mode == "write_ok"){		//게시판 쓰기 완료/////////////////////////////////////////////////////////////////////////////////////

	include $_SERVER[DOCUMENT_ROOT]."/s_source/_robot_chk.php";

	$outlinecolor = array(255,255,255);
	$img_size = array($thum_width,$thum_height,$thum_width,$thum_height);

	if(!$connect){	$connect = dbcon();	}
	$id = $USESSION[0];
	$name = bad_tag_convert2($_POST["name"]);
	$subject = bad_tag_convert2($_POST["subject"]);
	$comment = conv_content($_POST["comment"]);
	$wdate = time();
	$pwd = $_POST["pwd"];

	$sql = mysql_query("select max(uid) FROM $table");
	$row = mysql_fetch_row($sql);
	if($row[0]){	$uid = $row[0] + 1;	}
	else{				$uid = 1;			}


	for($i=1; $i<=$file_num; $i++){
		if(${"file" . $i . "_name"}){
			$img_uid = uniqid("img_");
			// 원본저장
			$return_file = file_save(${"file" . $i}, ${"file" . $i . "_name"}, $save_path);
			$sql = "Insert Into $t_files Set uid='$img_uid', tbl='$table', puid='$uid', file='$return_file', sort=$i";
			mysql_query($sql);
			if(file_exists($save_path.$return_file)){
				$ext = selectExtension($return_file);
				if($ext=="jpg"||$ext=="gif"||$ext=="png"){
					//put_gdimage($return_file, $thum_width, $thum_height, "t_".$return_file,$table);
					thumbnail2($save_path.$return_file, $save_path."thum/t_".$return_file, $img_size, $outlinecolor);
				}
			}
		}
	}

	// gid 값 가져오기
	$sql = mysql_query("SELECT max(gid) FROM $table");
	$row = mysql_fetch_row($sql);
	if($row[0]){
		$gid = $row[0] + 1;
	}else{
		$gid = 1;
	}

	$kind = $skind;

	$sql = "Insert Into $table Set ";
	$sql .= "uid=$uid,";
	$sql .= "gid=$gid,";
	$sql .= "id='$id',";
	$sql .= "name='$name',";
	$sql .= "thread='a',";
	$sql .= "subject='$subject',";
	$sql .= "comment='$comment',";
	$sql .= "readno=0,";
	$sql .= "wdate='$wdate',";
	$sql .= "secret='$secret',";
	$sql .= "kind='$kind', ";
	$sql .= "ip='$REMOTE_ADDR',";
	$sql .= "pwd='$pwd'";
	$result = mysql_query($sql);

	if($result){
		redir_proc3($_SERVER["PHP_SELF"] . "?mode=list&page=$page&skind=$skind", "");
	}else{
		redir_proc2("오류가 발생하였습니다.");
	}
}elseif($mode == "edit_ok"){		//게시판 수정 완료/////////////////////////////////////////////////////////////////////////////////////
	if(!$connect){	$connect = dbcon();	}

	$outlinecolor = array(255,255,255);
	$img_size = array($thum_width,$thum_height,$thum_width,$thum_height);

	$uid = $_POST["uid"];
	$name = bad_tag_convert2($_POST["name"]);
	$subject = bad_tag_convert2($_POST["subject"]);
	$comment = conv_content($_POST["comment"]);
	$pwd = $_POST["pwd"];

	$sql = "Select pwd From $table Where uid=$uid";
	$origin_pwd = mysql_result(mysql_query($sql),0,0);
	if($pwd != $origin_pwd){
		redir_proc2("비밀번호가 일치하지 않습니다.");
	}

	for($i=1; $i<=$file_num; $i++){
		$being = "";
		if(${"file" . $i . "_name"}){
			// 파일 저장
			$return_file = file_save(${"file" . $i}, ${"file" . $i . "_name"}, $save_path);

			if(${"old_file" . $i}){
				// 기존 파일 삭제
				file_delete($save_path . ${"old_file" . $i});
				file_delete($save_path . "thum/t_".${"old_file" . $i});
				$sql = "Update $t_files Set file='$return_file' Where tbl='$table' And puid='$uid' And sort=$i";
			}else{
				$img_uid = uniqid("img_");
				$sql = "Insert Into $t_files Set uid='$img_uid', tbl='$table', puid='$uid', file='$return_file', sort=$i";
			}
			mysql_query($sql);
			if(file_exists($save_path.$return_file)){
				$ext = selectExtension($return_file);
				if($ext=="jpg"||$ext=="gif"||$ext=="png"){
					//put_gdimage($return_file, $thum_width, $thum_height, "t_".$return_file,$table);
					thumbnail2($save_path.$return_file, $save_path."thum/t_".$return_file, $img_size, $outlinecolor);
				}
			}
		}else{
			if(${"del_btn" . $i}=="Y"){	// 파일 삭제
				// 기존 파일 삭제
				file_delete($save_path . ${"old_file" . $i});
				file_delete($save_path . "thum/t_".${"old_file" . $i});
				$sql = "Delete From $t_files Where tbl='$table' And puid='$uid' And sort=$i";
				mysql_query($sql);
			}
		}
	}

	$sql = "Update $table Set subject='$subject', comment='$comment', ip='$REMOTE_ADDR', secret='$secret',kind='$kind' $etc_sql Where uid=$uid";
	mysql_query($sql);

	redir_proc3($_SERVER["PHP_SELF"] . "?mode=view&uid=$uid&skind=$skind", "");

}elseif($mode == "reply_ok"){		//게시판 뎃글 완료/////////////////////////////////////////////////////////////////////////////////////

	include $_SERVER[DOCUMENT_ROOT]."/s_source/_robot_chk.php";

	$outlinecolor = array(255,255,255);
	$img_size = array($thum_width,$thum_height,$thum_width,$thum_height);

	$page = $_POST["page"];
	$uid = $_POST["uid"];

	if(!$connect){	$connect=dbcon();	}

	// 원글 정보 가져오기
	$sql = "Select id, gid, thread From $table Where uid=$uid";
	$result = mysql_query($sql);
	if($row=mysql_fetch_array($result)){
		$o_id = $row["id"];
		$gid = $row["gid"];
		$thread = $row["thread"];
	}
	$sql = mysql_query("select max(uid) FROM $table");
	$row = mysql_fetch_row($sql);
	if($row[0]){	$uid = $row[0] + 1;	}
	else{				$uid = 1;			}

	// 파일저장
	for($i=1; $i<=$file_num; $i++){
		if(${"file" . $i . "_name"}){
			$img_uid = uniqid("img_");
			// 원본저장
			$return_file = file_save(${"file" . $i}, ${"file" . $i . "_name"}, $save_path);
			$sql = "Insert Into $t_files Set uid='$img_uid', tbl='$table', puid='$uid', file='$return_file', sort=$i";
			mysql_query($sql);
			if(file_exists($save_path.$return_file)){
				$ext = selectExtension($return_file);
				if($ext=="jpg"||$ext=="gif"||$ext=="png"){
					//put_gdimage($return_file, $thum_width, $thum_height, "t_".$return_file,$table);
					thumbnail2($save_path.$return_file, $save_path."thum/t_".$return_file, $img_size, $outlinecolor);
				}
			}
		}
	}

	$sql = "Select thread, right(thread,1) From $table Where gid = $gid And length(thread) = length('$thread')+1 And locate('$thread', thread) = 1 Order By thread desc Limit 1";
	$result = mysql_query($sql);
	$rows = mysql_num_rows($result);
	if($rows){
		$row = mysql_fetch_row($result);
		$thread_head = substr($row[0], 0, -1);
		$thread_foot = ++$row[1];
		$new_thread = $thread_head . $thread_foot;
	}else{
		$new_thread = $thread . "a";
	}

	$id = $USESSION[0];
	$name = bad_tag_convert($_POST["name"]);
	$subject = bad_tag_convert($_POST["subject"]);
	$comment = bad_tag_convert($_POST["comment"]);
	$wdate = time();

	$sql = "Insert Into $table Set ";
	$sql .= "uid=$uid,";
	$sql .= "gid=$gid,";
	$sql .= "id='$id',";
	$sql .= "name='$name',";
	$sql .= "thread='$new_thread',";
	$sql .= "subject='$subject',";
	$sql .= "comment='$comment',";
	$sql .= "readno=0,";
	$sql .= "wdate='$wdate',";
	$sql .= "secret='$secret',";
	$sql .= "kind='$kind', ";
	$sql .= "ip='$REMOTE_ADDR',";
	$sql .= "pwd='$pwd'";
	$result = mysql_query($sql);

	if($result){
		redir_proc3($_SERVER["PHP_SELF"] . "?mode=list&page=$page&skind=$skind", "");
	}else{
		redir_proc2("오류가 발생하였습니다.");
	}

}elseif($mode == "del_ok"){
	if(!$connect){	$connect = dbcon();	}
	$pwd = $_POST[pwd];
	$uid = $_POST[uid];

	// 파일/아이디
	$sql = "Select id, pwd From $table Where uid='$uid'";
	$result = mysql_query($sql);
	$id = mysql_result($result, 0, 0);
	$origin_pwd = mysql_result($result, 0, 1);

	if($pwd != $origin_pwd){
		redir_proc2("비밀번호가 일치하지 않습니다.");
	}

	// 파일 삭제
	$sql = "Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort";
	$result = mysql_query($sql);
	while($row=mysql_fetch_array($result)){
		$file = $row["file"];
		file_delete($save_path . $file);
		file_delete($save_path ."thum/t_".$file);
	}
	$sql = "Delete From $t_files Where tbl='$table' And puid='$uid'";
	mysql_query($sql);

	$sql = "Delete From $table Where uid=$uid";
	if(mysql_query($sql)){
		redir_proc3($_SERVER["PHP_SELF"] . "?mode=list&page=$page&skind=$skind","");
	}else{
		redir_proc2("오류가 발생하였습니다.");
	}
}elseif($mode=="pwd_ok"){
	if(!$connect){	$connect = dbcon();	}
	$pwd = $_POST[pwd];
	$uid = $_POST[uid];

	// 파일/아이디
	$sql = "Select pwd From $table Where uid='$uid'";
	$result = mysql_query($sql);
	$origin_pwd = mysql_result($result, 0, 0);

	if($pwd != $origin_pwd){
		redir_proc2("비밀번호가 일치하지 않습니다.");
	}else{
		$SN_USESSION2 = $uid . "|true|";
		session_register("SN_USESSION2");

		redir_proc3($_SERVER["PHP_SELF"]."?mode=view&uid=$uid&page=$page&skey=$skey&search=$search&skind=$skind", "");
	}


}elseif($mode=="comment_ok"){
	if(!$_SERVER[HTTP_REFERER]){
		redir_proc3("/","이전페이지 값이 없습니다.");
		exit;
	}else{
		// 우선 이 URL 로 부터 온것인지 검사
		$parse = parse_url($_SERVER[HTTP_REFERER]);
		// 3.35
		// 포트번호가 존재할 경우의 처리
		$parse2 = explode(":", $_SERVER[HTTP_HOST]);
		if ($parse[host] != $parse2[0]) {
			redir_proc3("/","올바른 접근이 아닌것 같습니다.");
			exit;
		}
	}

	$name = bad_tag_convert2($_POST["name"]);
	$comment = conv_content($_POST["comment"]);
	$wdate = time();
	$id = $USESSION[0];
	$pwd = $_POST["pwd"];
	$puid = $_POST["puid"];

	$sql = "Insert Into $t_comment Set ";
	$sql .= "puid='$puid',";
	$sql .= "id='$id',";
	$sql .= "name='$name',";
	$sql .= "tbl='$tbl',";
	$sql .= "comment='$comment',";
	$sql .= "pwd='$pwd',";
	$sql .= "ip='$REMOTE_ADDR',";
	$sql .= "wdate=$wdate";
	if(mysql_query($sql, $connect)){
	?>
	<script type="text/javascript">
	<!--
	parent.Ajax_Request("<?=$PHP_SELF?>?mode=comment_list_ok&puid=<?=$puid?>","result_frame");
	parent.document.cFrm1.reset();
	//-->
	</script>
	<?
		//redir_proc3("reload","");
	}else{
		redir_proc2("입력실패!");
	}
}elseif($mode == "comment_del_ok"){
	if(auth_lev()==0){
		$result = mysql_query("Select * From $t_comment Where tbl='$tbl' and puid='$puid' And uid=$uid And pwd='$pwd'");
	}else{
		$result = mysql_query("Select * From $t_comment Where tbl='$tbl' and puid='$puid' And uid=$uid And id='$USESSION[0]'");
	}
	if($result&&mysql_num_rows($result)>0){
		@mysql_query("Delete From $t_comment Where tbl='$tbl' and puid='$puid' And uid=$uid");

		?>
		<script type="text/javascript">
		<!--
		parent.Ajax_Request("<?=$PHP_SELF?>?mode=comment_list_ok&puid=<?=$puid?>","result_frame");
		//-->
		</script>
		<?
		//redir_proc3("reload","");
	}else{
		redir_proc2("비밀번호가 일치하지 않거나 삭제할 권한이 없습니다.");
	}
}elseif($mode=="comment_list_ok"){
	$tbl = $table;
	$comment_cnt = 0;

	$result = mysql_query("Select * From $t_comment Where tbl='$tbl' And puid='" . $puid . "' Order By wdate Asc, uid desc");
	$comment_cnt = mysql_num_rows($result);
	if($result&&$comment_cnt>0){
		while($row=mysql_fetch_array($result)){
?>
	<div class="cm_item">
		<div class="cm_info">
			<b><?=stripslashes($row["name"])?></b><span><?=date("Y.m.d H:i",$row["wdate"])?></span>
		</div>
		<div class="cm_body">
			<?=nl2br(stripslashes($row["comment"]))?>
		</div>
		<div class="cm_btn_wrap">
			<?
			if($comment_write){
				if(auth_lev()>0){
					if($row["id"]==$USESSION[0]){
					?>
						<a href="javascript:comment_del_check('<?=$row["uid"]?>');" class="cm_btn_del">삭제</a>
					<?
					}
				}else{
				?>
				<a href="javascript:comment_del_check('<?=$row["uid"]?>');" class="cm_btn_del">삭제</a>
				<?
				}
			}
			?>
		</div>
			<?if($comment_write&&auth_lev()==0){?>
			<div id="pwd_layer_<?=$row["uid"]?>" class="pwd_layer_wrap">
				<form name="cFrm3_<?=$row["uid"]?>" method="POST" action="<?=$PHP_SELF?>" target="tempFrame" onSubmit="return ValidChk(this);">
					<input type="hidden" name="mode" value="comment_del_ok">
					<input type="hidden" name="tbl" value="<?=$tbl?>">
					<input type="hidden" name="puid" value="<?=$puid?>">
					<input type="hidden" name="uid" value="<?=$row["uid"]?>">
					<div class="pwd_wrap">
						<div class="pwd_top">
							<div class="pwd_label">비밀번호</div>
							<div class="pwd_input_wrap">
							<input type="password" name="pwd" maxlength="20" must="Y" mval="비밀번호는" class="pwd_input">
							</div>
							<button class="pwd_btn_ok" type="submit">비밀번호 확인</button>
						</div>
					</div>
				</form>
			</div>
			<?}?>
	</div>
<?
		}
	}else{
?>
	<div class="cm_item">
		<div class="cm_body">
		등록된 댓글이 없습니다.
		</div>
	</div>
<?
	}
	@mysql_free_result($result);

	echo "<script>document.getElementById('comment_cnt').innerHTML = '".number_format($comment_cnt)."';</script>";
}elseif($mode=="list_ok"){

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
	<script type="text/javascript">
	<!--
	var skey = "<?=$skey?>";
	var search = "<?=$search?>";
	var skind = "<?=$skind?>";
	//-->
	</script>
	<form name="form0" method="get" action="<?=$_SERVER[PHP_SELF]?>" onSubmit="return check_search();">
	<input type="hidden" name="mode" value="list_ok">
	<input type="hidden" name="uid">
	<input type="hidden" name="page" value="<?=$page?>">

	<?if($board_type=="gallery"){?>
	<div id="board-ocean-gallery-list">
		<!-- 리스트 시작 -->
		<div class="board-list">
		<?
		$result = mysql_query("Select * From $table $tmp_where Order By uid desc Limit $start, $num_per_page");
		if(!$result){
			redir_proc($PHP_SELF,"오류가 발생하였습니다.");
			exit;
		}
		if($total_record>0){
			$i = 1;
			while($row=mysql_fetch_array($result)){
				$uid = $row["uid"];
				$subject = strcut_utf8(stripslashes($row["subject"]),44);
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
				if($resultc){
					$comment_cnt = mysql_result($resultc,0,0);
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
			echo "<div>
				등록된 데이터가 없습니다.
			</div>";

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
			redir_proc($PHP_SELF,"오류가 발생하였습니다.");
			exit;
		}
		while($row = mysql_fetch_array($result)){
			$uid = $row["uid"];
			$subject = stripslashes(trim($row["subject"]));
			$comment = stripslashes(trim($row["comment"]));
			$name = stripslashes(trim($row["name"]));
			$subject = strcut_utf8($subject,46);
			$comment = strcut_utf8(strip_tags($comment),100);
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
					<div class="board-webzine-info"> <span class="board-info-name">작성일 :</span> <span class="board-info-value"><?=$wdate?></span> <span class="board-info-separator">|</span> <span class="board-info-name">작성자 :</span> <span class="board-info-value"><?=$name?></span> <span class="board-info-separator">|</span> <span class="board-info-name">조회 :</span> <span class="board-info-value"><?=$readno?></span> </div>
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
						<td class="board-list-uid">번호</td>
						<td class="board-list-title">제목</td>
						<td class="board-list-user">작성자</td>
						<td class="board-list-date">작성일</td>
						<td class="board-list-view">조회</td>
					</tr>
				</thead>
				<tbody>
					<?
					// Top 글 ///////////////////////////////////////////////////////////////////////////////
					$result = mysql_query("Select * From $table Where top=1 Order By wdate desc, uid desc limit 0,10");
					if(!$result){
						redir_proc($PHP_SELF,"오류가 발생하였습니다.");
						exit;
					}
					while($row = mysql_fetch_array($result)){
						$uid = $row["uid"];
						$name = $row["name"];
						$subject = strcut_utf8(stripslashes($row["subject"]),68);
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
						if($resultc){
							$comment_cnt = mysql_result($resultc,0,0);
						}
						@mysql_free_result($resultc);


						$subject = "<a href=# onClick=\"view('$uid');return false;\">" . $subject . "</a> " . $new_img;
						?>
					<tr>
						<td class="board-list-uid"><img src="/s_source/images/bbs/icon_notice.jpg" alt="공지"></td>
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
							redir_proc($PHP_SELF,"오류가 발생하였습니다.");
							exit;
						}
						while($row = mysql_fetch_array($result)){
							$uid = $row["uid"];
							$name = $row["name"];
							$subject = strcut_utf8(stripslashes($row["subject"]),68);
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
							if($resultc){
								$comment_cnt = mysql_result($resultc,0,0);
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
						echo "<tr><td colspan=5 >등록된 데이터가 없습니다.</td></tr>";
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
				// 페이징
				$link = $_SERVER[PHP_SELF] . "?mode=list_ok&skey=$skey&search=$search&skind=$skind";
				Ajax_paging($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir);
			?>
			</ul>
		</div>
		<!-- 페이징 끝 -->
		<?}?>


			<?if($searchform){?>
			<div class="board-search">
				<?if($kind_chk){?>
				<select name="skind" class="inputbox_single">
					<option value="">:: 구분 ::</option>
					<?
					for($i=1;$i<=count($kind_arr);$i++){
						if($kind_arr[$i]){
							if($skind==$i)			$sel = "selected";
							else						$sel = "";
					?>
					<option value="<?=$i?>" <?=$sel?>><?=$kind_arr[$i]?></option>
					<?
						}
					}
					?>
				</select>
				<?}?>
				<select name="skey">
					<option value="subject" <?if($skey=="subject")	echo "selected";?>>제목</option>
					<option value="comment" <?if($skey=="comment")	echo "selected";?>>내용</option>
					<option value="name" <?if($skey=="name")	echo "selected";?>>작성자</option>
				</select>
				<input type="text" name="search" value="<?=$search?>" must="Y" mval="검색값은" onkeypress="onlyAlphaNumer();">
				<button type="submit" class="board-ocean-gallery-button-small">검색</button>
			</div>
			<?}?>

		<?if($writable){?>
		<!-- 버튼 시작 -->
		<div class="board-control"> <a href="<?=$PHP_SELF?>?mode=write&skind=<?=$skind?>" class="board-ocean-gallery-button-small">글쓰기</a> </div>
		<!-- 버튼 끝 -->
		<?}?>
	</div>
	</form>


<?
}
?>