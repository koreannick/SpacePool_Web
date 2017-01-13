<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if($mode=="input"){
	$status = "on";
}elseif($mode=="edit"){
	if(!$connect){	$connect = dbcon();	}
	$sql = "Select * from $table Where uid='$uid'";
	$result = mysql_query($sql);
	if($row=mysql_fetch_array($result)){
		foreach($row as $key => $val){
			$val = check_box($val);
			$$key = stripslashes($val);
		}
		$size = explode("|", $size);
		$pos = explode("|", $pos);
	}
	@mysql_free_result($result);
}
?>
<script type="text/javascript" src="/s_source/SmartEditor2/js/HuskyEZCreator.js"></script>
<script language="javascript">
<!--
// 쓰기 체크 ////////////////////////////////////////////////////
function check_input(){
	var form = document.form0;
	if(form.title.value.length < 1){
		err_proc(form.title, "제목을 입력하세요");
	}else{
		oEditors.getById["contents"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

		// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

		try {
			form.submit();
		} catch(e) {}

	}
}
// list
function go_list(){
	var form = document.form0;
	form.mode.value = "list";
	form.method="POST";
	form.submit();
}
-->
</script>
<form name=form0 method=post action="<?=$_SERVER[PHP_SELF]?>">
<input type=hidden name=mode value='<?=$mode?>_ok'>
<input type=hidden name=uid value='<?=$uid?>'>
<input type=hidden name=page value='<?=$page?>'>

<table width=800 cellpadding=0 cellspacing=0 border=0>
<tr>
	<td bgcolor="#E7E7E7">
		<table width="100%" cellpadding="0" cellspacing="1" border="0">
			<tr height="30">
				<th bgcolor="#F6F6F6" width=100>제목</th>
				<td bgcolor="#FFFFFF">&nbsp;<input name="title" size=70 maxLength=50 value="<?=$title?>" class="inputbox_single"></td>
			</tr>
			<tr height="30">
				<td bgcolor="#FFFFFF" colspan="2" style="padding:5px;"><textarea name="contents" id="contents" rows="10" cols="100" style="width:100%; height:412px; min-width:610px; display:none;"><?=$contents?></textarea>
				<script type="text/javascript">
				var oEditors = [];
				nhn.husky.EZCreator.createInIFrame({
					oAppRef: oEditors,
					elPlaceHolder: "contents",
					sSkinURI: "/s_source/SmartEditor2/SmartEditor2Skin.html",
					htParams : {bUseToolbar : true}, //boolean
					fCreator: "createSEditor2"
				});
				</script></td>
			</tr>
			<tr height="30">
				<th bgcolor="#F6F6F6" >크기</th>
				<td bgcolor="#FFFFFF">&nbsp;가로 : <input name=ww size=5 maxLength=4 value='<?=$size[0]?>' style="text-align:right;ime-mode:disabled" onkeypress="onlyNumber();" class="inputbox_single"> px
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					세로 : <input name=hh size=5 maxLength=4 value='<?=$size[1]?>' style="text-align:right;ime-mode:disabled" onkeypress="onlyNumber();" class="inputbox_single"> px
				</td>
			</tr>
			<tr height="30">
				<th bgcolor="#F6F6F6" >위치</th>
				<td bgcolor="#FFFFFF">&nbsp;X : <input name="pos1" size=5 maxLength=4 value='<?=$pos[0]?>' style="text-align:right;ime-mode:disabled" onkeypress="onlyNumber();" class="inputbox_single"> px
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Y : <input name="pos2" size=5 maxLength=4 value='<?=$pos[1]?>' style="text-align:right;ime-mode:disabled" onkeypress="onlyNumber();" class="inputbox_single"> px
				</td>
			</tr>
			<tr height="30">
				<th bgcolor="#F6F6F6" >상태</th>
				<td bgcolor="#FFFFFF">&nbsp;<input type=checkbox name=status value='on' <?=($status=="on")?"checked":""?>>팝업띄우기</td>
			</tr>
			<tr height="30">
				<th bgcolor="#F6F6F6" >레이어형식</th>
				<td bgcolor="#FFFFFF">&nbsp;<input type=checkbox name=layer value="Y" <?=($layer=="Y")?"checked":""?>>체크하시면 레이어 형식으로 나타납니다.&nbsp;(자동닫힘 시간 : <input type="text" name="ctime" value="<?=$ctime?>" size="3" maxlength="3" onkeypress="onlyNumber();" style="ime-mode:disabled" class="inputbox_single">초)</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td align=center style="padding:10px;">
			<input type=button value=" 저 장 " style="width:100px;" onclick="check_input();">
			<input type=button value=" 취 소 " style="width:100px;" onClick="go_list();">
		</td>
	</tr>
</table>
</form>