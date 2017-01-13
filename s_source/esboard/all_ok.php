<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

if($mode == "write_ok"){		//게시판 쓰기 완료/////////////////////////////////////////////////////////////////////////////////////

	$outlinecolor = array(255,255,255);
	$img_size = array($thum_width,$thum_height,$thum_width,$thum_height);

	$id = $USESSION[0];
	$name = bad_tag_convert($_POST[name]);
	$subject = bad_tag_convert($_POST[subject]);
	$comment = conv_content($_POST[comment]);
	$wdate = time();
	$comment = str_replace("_self","_blank",$comment);

	//uid값 가져오기
	$sql = mysql_query("select max(uid) FROM $table");
	$row = mysql_fetch_row($sql);
	if($row[0]){	$uid = $row[0] + 1;	}
	else{				$uid = 1;			}

	if($board_type=="gallery"){
		if(!$file1_name)		redir_proc2("파일1을 첨부해주세요.");
	}

	// 파일 저장
	if($file_num>0){
		for($i=1; $i<=$file_num; $i++){
			if(${"file" . $i . "_name"}){
				$img_uid = uniqid("img_");
				// 원본저장
				$return_file = file_save(${"file" . $i}, ${"file" . $i . "_name"}, $save_path);
				$sql = "Insert Into $t_files Set uid='$img_uid', tbl='$table', puid='$uid', file='$return_file', sort=$i";
				mysql_query($sql, $connect);

				if(file_exists($save_path.$return_file)){
					$ext = selectExtension($return_file);
					if($ext=="jpg"||$ext=="jpeg"||$ext=="gif"||$ext=="png"){
						//put_gdimage($return_file, $thum_width, $thum_height, "t_".$return_file,$table);
						thumbnail2($save_path.$return_file, $save_path."thum/t_".$return_file, $img_size, $outlinecolor);
					}
				}
			}
		}
	}

	// gid 값 가져오기
	$sql = mysql_query("SELECT max(gid) FROM $table",$connect);
	$row = mysql_fetch_row($sql);
	if($row[0]){
		$gid = $row[0] + 1;
	}else{
		$gid = 1;
	}
	if($top)		$secret = 0;

	$sql = "Insert Into $table Set ";
	$sql .= "uid='$uid', ";
	$sql .= "gid='$gid', ";
	$sql .= "id='$id', ";
	$sql .= "name='$name', ";
	$sql .= "thread='a', ";
	$sql .= "subject='$subject', ";
	$sql .= "comment='$comment', ";
	$sql .= "readno='0', ";
	$sql .= "wdate='$wdate', ";
	$sql .= "kind='$kind', ";
	$sql .= "secret='$secret',";
	$sql .= "pwd='$pwd',";
	$sql .= "ip='$REMOTE_ADDR', ";
	$sql .= "top='$top'";
	mysql_query($sql, $connect);

	redir_proc3($_SERVER["PHP_SELF"] . "?mode=list&table=$table&page=$page&skind=$skind", "");


}elseif($mode == "edit_ok"){		//게시판 수정 완료/////////////////////////////////////////////////////////////////////////////////////
	$outlinecolor = array(255,255,255);
	$img_size = array($thum_width,$thum_height,$thum_width,$thum_height);

	$name = bad_tag_convert($_POST[name]);
	$subject = bad_tag_convert($_POST[subject]);
	$comment = conv_content($_POST[comment]);
	$comment = str_replace("_self","_blank",$comment);

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
			mysql_query($sql, $connect);
			if(file_exists($save_path.$return_file)){
				$ext = selectExtension($return_file);
				if($ext=="jpg"||$ext=="jpeg"||$ext=="gif"||$ext=="png"){
					//put_gdimage($return_file, $thum_width, $thum_height, "t_".$return_file,$table);
					thumbnail2($save_path.$return_file, $save_path."thum/t_".$return_file, $img_size, $outlinecolor);
				}
			}
		}else{
			if(${"del_btn" . $i}){	// 파일 삭제
				// 기존 파일 삭제
				file_delete($save_path . ${"old_file" . $i});
				file_delete($save_path . "thum/t_".${"old_file" . $i});
				$sql = "Delete From $t_files Where tbl='$table' And puid='$uid' And sort=$i";
				mysql_query($sql, $connect);
			}
		}
	}

	$result = mysql_query("select wdate from $table where uid = '$uid'");
	$org_wdate = mysql_result($result,0,0);
	@mysql_free_result($result);

	if($wdate!=date("Y-m-d",$org_wdate)){
		$wdate = ($org_wdate - strtotime(date("Y-m-d",$org_wdate))) + strtotime($wdate);
	}else{
		$wdate = $org_wdate;
	}

	if($top)		$secret = 0;

	$sql = "Update $table Set ";
	$sql .= "subject='$subject', ";
	$sql .= "name='$name', ";
	$sql .= "comment='$comment', ";
	$sql .= "kind='$kind', ";
	$sql .= "readno='$readno', ";
	$sql .= "secret='$secret',";
	$sql .= "pwd='$pwd',";
	$sql .= "wdate='$wdate',";
	$sql .= "top='$top' ";
	$sql .= "Where uid=$uid";

	mysql_query($sql, $connect);

	redir_proc3($_SERVER["PHP_SELF"] . "?mode=view&table=$table&uid=$uid&page=$page&skind=$skind", "");

}elseif($mode == "reply_ok"){		//게시판 뎃글 완료/////////////////////////////////////////////////////////////////////////////////////
	$outlinecolor = array(255,255,255);
	$img_size = array($thum_width,$thum_height,$thum_width,$thum_height);

	// 원글 정보 가져오기
	$sql = "Select id, gid, thread, secret, pwd From $table Where uid=$uid";
	$result = mysql_query($sql, $connect);
	if($row=mysql_fetch_array($result)){
		$o_id = $row["id"];
		$gid = $row["gid"];
		$thread = $row["thread"];
		$secret = $row["secret"];
		$pwd = $row["pwd"];
	}

	//uid값 가져오기
	$sql = mysql_query("select max(uid) FROM $table");
	$row = mysql_fetch_row($sql);
	if($row[0]){	$uid = $row[0] + 1;	}
	else{				$uid = 1;			}

	// 파일저장
	$save_path = $_SERVER["DOCUMENT_ROOT"] . $link_path;
	for($i=1; $i<=$file_num; $i++){
		if(${"file" . $i . "_name"}){
			$img_uid = uniqid("img_");
			// 원본저장
			$return_file = file_save(${"file" . $i}, ${"file" . $i . "_name"}, $save_path);
			$sql = "Insert Into $t_files Set uid='$img_uid', tbl='$table', puid='$uid', file='$return_file', sort=$i";
			mysql_query($sql, $connect);
			if(file_exists($save_path.$return_file)){
				$ext = selectExtension($return_file);
				if($ext=="jpg"||$ext=="jpeg"||$ext=="gif"||$ext=="png"){
					//put_gdimage($return_file, $thum_width, $thum_height, "t_".$return_file,$table);
					thumbnail2($save_path.$return_file, $save_path."thum/t_".$return_file, $img_size, $outlinecolor);
				}
			}
		}
	}

	$sql = "Select thread, right(thread,1) From $table Where gid = $gid And length(thread) = length('$thread')+1 And locate('$thread', thread) = 1 Order By thread desc Limit 1";
	$result = mysql_query($sql,$connect);
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
	$name = bad_tag_convert($_POST[name]);
	$subject = bad_tag_convert($_POST[subject]);
	$comment = bad_tag_convert($_POST[comment]);
	$wdate = time();
	$comment = str_replace("_self","_blank",$comment);

	$sql = "Insert Into $table Set ";
	$sql .= "uid='$uid', ";
	$sql .= "gid='$gid', ";
	$sql .= "thread='$new_thread', ";
	$sql .= "id='$id', ";
	$sql .= "name='$name', ";
	$sql .= "subject='$subject', ";
	$sql .= "comment='$comment', ";
	$sql .= "readno=0, ";
	$sql .= "wdate=$wdate, ";
	$sql .= "kind='$kind', ";
	$sql .= "ip='$REMOTE_ADDR', ";
	$sql .= "secret='$secret', ";
	$sql .= "pwd='$pwd', ";
	$sql .= "top='$top'";
	mysql_query($sql, $connect);

	redir_proc3($_SERVER["PHP_SELF"] . "?mode=list&table=$table&page=$page&skind=$skind", "");

}elseif($mode == "del_ok"){

	$result = mysql_query("Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort");
	while($row=mysql_fetch_array($result)){
		$file = $row["file"];
		file_delete($save_path . $file);
		file_delete($save_path ."thum/t_".$file);
	}
	@mysql_query("Delete From $t_files Where tbl='$table' And puid='$uid'");

	@mysql_query("Delete From $table Where uid=$uid");

	@mysql_query("Delete From $t_comment Where puid=$uid and tbl = '$table'");

	redir_proc3($_SERVER["PHP_SELF"] . "?mode=list&table=$table&page=$page&skind=$skind", "");

}elseif($mode=="comment_ok"){
	$name = bad_tag_convert2($_POST["name"]);
	$comment = conv_content($_POST["comment"]);
	$wdate = time();
	$id = $USESSION[0];

	$sql = "Insert Into $t_comment Set ";
	$sql .= "puid='$puid',";
	$sql .= "id='$id',";
	$sql .= "name='$name',";
	$sql .= "tbl='$tbl',";
	$sql .= "comment='$comment',";
	$sql .= "ip='$REMOTE_ADDR',";
	$sql .= "wdate=$wdate";
	if(mysql_query($sql, $connect)){
	?>
	<script type="text/javascript">
	<!--
	parent.Ajax_Request("<?=$PHP_SELF?>?mode=comment_list_ok&table=<?=$table?>&puid=<?=$puid?>&tbl=<?=$tbl?>","result_frame");
	parent.document.cFrm1.reset();
	//-->
	</script>
	<?
		//redir_proc3("reload","");
	}else{
		redir_proc2("입력실패!");
	}
}elseif($mode == "comment_del_ok"){
	@mysql_query("Delete From $t_comment Where tbl='$tbl' and puid='$puid' And uid=$uid");
	?>
	<script type="text/javascript">
	<!--
	parent.Ajax_Request("<?=$PHP_SELF?>?mode=comment_list_ok&table=<?=$table?>&puid=<?=$puid?>&tbl=<?=$tbl?>","result_frame");
	//-->
	</script>
	<?
	//redir_proc3("reload","");

}elseif($mode=="comment_list_ok"){
	$tbl = $table;

	$comment_cnt = 0;
?>
	<table width=100% border=0 cellpadding=0 cellspacing=0>
	<?
		$result = mysql_query("Select * From $t_comment Where tbl='$tbl' And puid='" . $puid . "' Order By wdate Asc, uid desc",$connect);
		if($result&&mysql_num_rows($result)>0){
			$comment_cnt = mysql_num_rows($result);

			while($row=mysql_fetch_array($result)){
				$name = stripslashes($row["name"]);
				$comment = nl2br(stripslashes($row["comment"]));

				echo("<tr>");
				echo "<td width=\"150\" align=left style=\"padding:3px;\">&nbsp; - $name";
				if($row["id"])		echo "&nbsp;(".$row["id"].")";
				echo "</td>";
				echo("<td height=30 class=td_padding10_down style=\"padding:5px;\">$comment</td>");
				echo("<td width=\"100\" align=center style=\"padding:5px;\">".date("Y.m.d H:i",$row["wdate"])."</td>");
				if(auth_lev()==9||$row["id"]==$USESSION[0]){
					echo("<td width=50 align=left><a href=# onClick=\"comment_del_check('" . $row["uid"] . "');return false;\">[ DEL ]</a></td>");
				}else{
					echo "<td></td>";
				}
				echo("</tr>");
				echo("<tr bgcolor=DDDED0><td height=1 colspan=4></td></tr>");
			}
		}else{
			echo "<tr><td align=center style=\"padding:10px;\">등록된 댓글이 없습니다.</td></tr>";
		}
		@mysql_free_result($result);
	?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
<?
	echo "<script>document.getElementById('comment_cnt').innerHTML = '".number_format($comment_cnt)."';</script>";
}


?>