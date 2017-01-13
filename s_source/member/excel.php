<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="100%" border="1" cellpadding="1" cellspacing="1">
<tr>
	<th width="100">회원등급</th>
	<th width="100">아이디</th>
	<th width="100">이름</th>
	<th width="200">이메일</th>
	<th width="600">주소</th>
	<th width="130">전화번호</th>
	<th width="130">휴대폰</th>
	<th width="100">상태</th>
	<th width="200">가입일</th>
	<th width="200">최근접속일</th>
</tr>
<?
$tmp_where = " where 1=1 ";

if($m_kinds)		$tmp_where .= " and m_kind='$m_kinds' ";
if($search)			$tmp_where .= " and $skey Like '%$search%' ";
if($statuss)			$tmp_where .= " and status = '$statuss' ";

if($login_non_chk=="Y"){
	$prev_date = mktime(0,0,0,date("m"),date("d"),(date("Y")-1));
	$tmp_where .= " and (last_log_date < '$prev_date' and wdate < '$prev_date') ";
}

if($h_chk=="Y")	$tmp_where .= " and m_kind='m1' and host='Y'";

$resulto = mysql_query("select * from $t_member $tmp_where order by wdate asc");
if(mysql_num_rows($resulto)>0){
	while($r=mysql_fetch_array($resulto)){
		foreach ($r as $key => $val) {
			$$key = stripslashes(trim($val));
		}

		switch($status){
			case"wait":			$status_str = "대기";	break;
			case"ok":			$status_str = "허가";	break;
			case"leave":		$status_str = "탈퇴";	break;
		}
?>
<tr>
	<td align="center"><?=$m_level_arr[$m_kind]?></td>
	<td align="center"><?=$id?></td>
	<td align="center"><?=$name?></td>
	<td align="center"><?=$email?></td>
	<td align="center"><?="[".$post."] ".$addr1." ".$addr2?></td>
	<td align="center"><?=$tel?></td>
	<td align="center"><?=$mobile?></td>
	<td align="center"><?=$status_str?></td>
	<td align="center"><?=date("Y.m.d H:i:s",$wdate)?></td>
	<td align="center"><?=date("Y.m.d H:i:s",$last_log_date)?></td>
</tr>
<?
	}
}

@mysql_free_result($resulto);
@mysql_close($connect);
?>
</table>