<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}


$name = $USESSION[1];

if($uid){
	$result = mysql_query("select * from $table WHERE uid='$uid'");
	if($result&&mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		foreach($row as $key => $val){
			$val = check_box($val);
			$$key = stripslashes(trim($val));
		}
		$original_comment = $comment;
	}else{
		redir_proc("back","No Data.");
		exit;
	}

	if($mode=="reply"){
		$original_subject = $subject;
		$original_comment = "<br /><br /><br /><br /><br />>>>>>>>>>>>>> Original >>>>>>>>>>>>><br />";
		$original_comment .= "Title : " . $original_subject . "<br />";
		$original_comment .= $comment . "<br />";
		$original_comment .= ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
		$name = $USESSION[1];
		$subject = "";
		$pwd = "";
	}

	@mysql_free_result($result);
}else{
	$mode = "write";

	if($skind)		$kind = $skind;
}


if($mode!="edit"){
	include $_SERVER["DOCUMENT_ROOT"]."/s_source/_norobot.php";
}
?>
<link rel="stylesheet" href="/s_source/esboard/board.css">
<script language='javascript' src="/s_inc/total_script.js"></script>
<script type="text/javascript" src="/s_source/SmartEditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
<link href="/s_source/basic01.css" rel="stylesheet" type="text/css">
<script language="javascript">
<!--
// 쓰기 체크 ////////////////////////////////////////////////////
function check_write(){

	var form = document.form_write;

	if(CheckStr(form.subject.value," ","")==0){
		return err_proc(form.subject, "Enter the Title");
	}else if(CheckStr(form.name.value," ","")==0){
		return err_proc(form.name, "Enter the Author");
	}else if(CheckStr(form.pwd.value," ","")==0){
		return err_proc(form.pwd, "Enter the Password");
	<?if($mode!="edit"){?>
	}else	 if(CheckStr(form.wr_key.value," ","")==0){
		alert("It did not prevent automated registrations, enter values. Please type the correct information.");
		form.wr_key.style.backgroundColor = "#C1C7F1";
		form.wr_key.focus();
		return false;
	}else	 if (hex_md5(form.wr_key.value) != md5_norobot_key) {
		alert("Automatic registration prevention red letters was not entered in the order.");
		form.wr_key.focus();
		return false;
	<?}?>
	}else{
		oEditors.getById["comment"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
		form.submit();
	}

}
-->
</script>
<form name="form_write" method="post" enctype="multipart/form-data" action="<?=$_SERVER["PHP_SELF"]?>" target="tempFrame">
<input type=hidden name="mode" value="<?=$mode?>_ok">
<input type=hidden name="uid" value="<?=$uid?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="gid" value="<?=$gid?>">
<input type=hidden name="thread" value="<?=$thread?>">
<input type=hidden name="skind" value="<?=$skind?>">
<div id="board-thumbnail-editor">
        <div class="board-attr-row board-attr-title">
            <label class="attr-name">Title</label>
            <div class="attr-value">
                <input name="subject" type="text" maxlength="80" value="<?=$subject?>" size="50">
            </div>
        </div>
        <div class="board-attr-row">
            <label class="attr-name">Author</label>
            <div class="attr-value">
                <input name="name" type="text" value="<?=$name?>" maxlength="15" size="20">
            </div>
        </div>
        <div class="board-attr-row">
            <label class="attr-name">Password</label>
            <div class="attr-value">
				<input maxlength=15 name="pwd" type="password" size="20" <?if(auth_lev()==9){?>value="<?=$pwd?>"<?}?>>
				<?if($oneone_chk==1){?>
					<input type="hidden" name="secret" value="1">&nbsp;It is registered as a private.
				<?}else{?>
					<?	if($w_secret){	?>
					&nbsp;Secret Yes<input type="radio" name="secret" value="1" style="border-style:none" <?=($secret=="1")?"checked":""?>>&nbsp;
					No<input type="radio" name="secret" value="0" style="border-style:none" <?=($secret=="0"||empty($secret))?"checked":""?>>
					<?	}	?>
				<?}?>
            </div>
        </div>
        <div class="board-content">
            <div id="wp-board_content-wrap" class="wp-core-ui wp-editor-wrap tmce-active">
                <div id="wp-board_content-editor-container" class="wp-editor-container">
					<textarea name="comment" id="comment" rows="10" cols="100" style="width:99%; height:412px; min-width:90%; display:none;" autocomplete="off" id="board_content"><?=$original_comment?></textarea>
					<?
					if($mobile)		$sSkinURI = "/s_source/SmartEditor2/SmartEditor2Skin_m.html";
					else				$sSkinURI = "/s_source/SmartEditor2/SmartEditor2Skin.html";
					?>
					<script type="text/javascript">
					var oEditors = [];
					nhn.husky.EZCreator.createInIFrame({
						oAppRef: oEditors,
						elPlaceHolder: "comment",
						sSkinURI: "<?=$sSkinURI?>",
						fCreator: "createSEditor2"
					});
					</script>
				</div>
            </div>
        </div>

		<?
		if($mode == "edit"){
			$sql = "Select * From $t_files Where tbl='$table' And puid='$uid' Order By sort Asc";
			$result = mysql_query($sql);
		}
		for($i=1; $i<=$file_num; $i++){
			$img = "";
			if($mode == "edit"){
				@mysql_data_seek($result, 0);
				while($row=mysql_fetch_array($result)){
					if($i == $row["sort"]){
						break;
					}
				}
			}
		?>
        <div class="board-attr-row">
            <label class="attr-name">Attachments <?=$i?></label>
            <div class="attr-value">
                <input name="file<?=$i?>" type="file" size="40">
				<?
				if(($board_type=="gallery"||$board_type=="webzine")&&$i==1){
					echo "&nbsp;<font color=red>※ File 1 is the image that appears on the list.</font>";
				}

				if($mode == "edit"){
					if($row["file"]){
						echo "<br />".$row["file"]." Del.<input type=checkbox name=del_btn" . $i . " value=Y><input type=hidden name=old_file" . $i . " value='" . $row["file"] . "'><br />";
					}
				}
				?>
            </div>
        </div>
		<?
		}
		?>
		<?if($mode!="edit"){?>
        <div class="board-attr-row">
            <label class="attr-name"><?=$norobot_str?></label>
            <div class="attr-value">
                <input name="wr_key" type="text" size="20" maxlength="20" style="ime-mode:disabled">&nbsp;<img src="/s_source/images/bbs/red_ment_e.jpg" alt="Please enter the text to the left of the red text only" height="16" align="absmiddle">
            </div>
        </div>
		<?}?>
        <div class="board-control">
            <div class="left"> <a href=# onClick="history.back();return false;" class="board-thumbnail-button-small">Cancel</a> </div>
            <div class="right">
                <a href=# onClick="check_write();return false;" class="board-thumbnail-button-small">Save</a>
            </div>
        </div>
</div>
</form>
<iframe name="tempFrame" width="0" height="0" style="display:none;"></iframe>