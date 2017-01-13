<?
if(auth_lev()<8){
	redir_proc3("/s_admin","접근권한이 없습니다.");
}

$connect = dbcon();

//각메뉴별 new 아이콘
//오늘 날짜 범위
$prev_date = mktime(date("H"),date("i"),date("s"),date("m"),date("d")-1,date("Y"));


//회원관리
$result = mysql_query("select count(uid) from $t_member where wdate >= $prev_date");
$cnt = mysql_result($result,0,0);
@mysql_free_result($result);
if($cnt>0)		$new1 = "<img src=/s_source/images/icon_n.jpg align=absmiddle>";
unset($cnt);



$result = mysql_query("select count(uid) from es_free2 where wdate >= $prev_date ");
$cnt = mysql_result($result,0,0);
@mysql_free_result($result);
if($cnt>0)		$new3 = "<img src=/s_source/images/icon_n.jpg align=absmiddle>";
unset($cnt);

$result = mysql_query("select count(uid) from es_product where wdate >= $prev_date");
$cnt = mysql_result($result,0,0);
@mysql_free_result($result);
if($cnt>0)		$new4 = "<img src=/s_source/images/icon_n.jpg align=absmiddle>";
unset($cnt);

$result = mysql_query("select count(uid) from es_online where wdate >= $prev_date");
$cnt = mysql_result($result,0,0);
@mysql_free_result($result);
if($cnt>0)		$new5 = "<img src=/s_source/images/icon_n.jpg align=absmiddle>";
unset($cnt);


?>
<html>
<head>
<title><?=$CONF_TITLE_TAG?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet href=/s_inc/total_style.css type=text/css>
<script language=javascript src='/s_inc/total_script.js'></script>
<script language=javascript>
<!--
function menu_view(val){
	if(document.all.menu.length){
		var obj_menu=document.all.menu[val];
		if(obj_menu.style.display=="none"){
			obj_menu.style.display='inline';
			setCookie2(val, "1", 30);
		}else{
			obj_menu.style.display='none';
			clearCookie(val);
		}
	}else{
		var obj_menu=document.all.menu;
		if(obj_menu.style.display=="none"){
			obj_menu.style.display='inline';
			setCookie2(val, "1", 30);
		}else{
			obj_menu.style.display='none';
			clearCookie(val);
		}
	}
}

// 메뉴초기화
function init_menu(val){
	if(document.all.menu.length){
		for(m=0; m<document.all.menu.length; m++){
			if(getCookie2(m)){
				var obj_menu=document.all.menu[m];
				obj_menu.style.display='inline';
			}
		}
	}else{
		if(getCookie2(1)){
			var obj_menu=document.all.menu;
			obj_menu.style.display='inline';
		}
	}
}
-->
</script>
</head>
<body onLoad="init_menu();">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="23" height="145"><img src="/s_source/images/top_bg_left.gif" width="23" height="145" /></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="180"><img src="/s_source/images/top_bg_left_title.gif" width="180" height="145" /></td>
        <td valign="top" background="/s_source/images/top_bg_center.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="23"></td>
          </tr>
          <tr>
            <td height="45" style="padding-left:10px;"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="21" bgcolor="#4D7F97" class="admin_name" style="padding:0 5px 0 5px;"><?=$USESSION[1]?></td>
                <td width="378"><img src="/s_source/images/top_ment.gif" width="378" height="21" /></td>
                <td width="83"><a href="/s_admin/?mode=logout_ok"><img src="/s_source/images/top_but.gif" width="83" height="21" border="0" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="77" style="padding-left:10px; padding-right:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="43" height="49"><img src="/s_source/images/title_left.gif" width="43" height="49" /></td>
                <td background="/s_source/images/title_center_bg.gif" class="admin_title"><?=$page_title?></td>
                <td width="10" height="49"><img src="/s_source/images/title_right.gif" width="10" height="49" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="22" height="145"><img src="/s_source/images/top_bg_right.gif" width="22" height="145" /></td>
  </tr>
  <tr>
    <td valign="top" background="/s_source/images/center_bg_left.gif"></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="179" valign="top"><table width="179" border="0" cellspacing="0" cellpadding="0">
		  <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/" target="_blank"><b>홈페이지</b></a></td>
          </tr>
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_main.php"><b>관리자메인</b></a></td>
          </tr>
		  <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
		  <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_member.php"><b>회원관리</b></a>&nbsp;<?=$new1?></td>
          </tr>
          <!-- <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_host.php"><b>HOST</b></a>&nbsp;<?=$new2?></td>
          </tr> -->
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_esboard.php?table=es_free1"><b>공지사항</b></a></td>
          </tr>
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_faq.php"><b>도움말</b></a></td>
          </tr>
					<tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
					<tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_faq2.php"><b>공간별설명</b></a></td>
          </tr>
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_esboard.php?table=es_free2"><b>질문하기</b></a>&nbsp;<?=$new3?></td>
          </tr>
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_esboard.php?table=es_free3"><b>POOL 스토리</b></a></td>
          </tr>
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
		  <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_product.php"><b>공간관리</b></a>&nbsp;<?=$new4?></td>
          </tr>
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_online.php"><b>제휴문의</b></a>&nbsp;<?=$new5?></td>
          </tr>
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_popup.php"><b>팝업관리</b></a></td>
          </tr>
          <!-- <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="javascript:" onclick="window.open('/s_source/a2_sms.php','sms_win','width=750,height=630');"><b>SMS발송</b></a></td>
          </tr>
		  <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_sms.php?mode=result"><b>SMS발송내역</b></a></td>
          </tr> -->
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu01" style="padding-left:5px;"><img src="/s_source/images/icon_01.gif" width="16" height="16" align="absmiddle" /> <a href=# onClick="menu_view(0);return false;"><b>접속로그</b></a></td>
          </tr>
		  <tbody id='menu' style='display:<?=($HTTP_COOKIE_VARS["0"])?"block":"none"?>;'>
          <tr>
            <td height="23" class="admin_menu02" style="padding-left:25px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_counter.php?mode=day">일별접속 분석</a></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu02" style="padding-left:25px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_counter.php?mode=month">월별접속 분석</a></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu02" style="padding-left:25px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_counter.php?mode=time">시간별접속 분석</a></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu02" style="padding-left:25px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_counter.php?mode=site">경로별접속 분석</a></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu02" style="padding-left:25px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_counter.php?mode=search">검색어별접속 분석</a></td>
          </tr>
          <tr>
            <td height="23" class="admin_menu02" style="padding-left:25px;"><img src="/s_source/images/icon_02.gif" width="16" height="16" align="absmiddle" /> <a href="/s_source/a2_counter.php?mode=ip">IP별접속 분석</a></td>
          </tr>
		  </tbody>
          <tr>
            <td height="1" background="/s_source/images/line_xbg.gif"></td>
          </tr>
        </table></td>
        <td width="1" valign="top" background="/s_source/images/line_ybg.gif"><img src="/s_source/images/line_ybg.gif"></td>
        <td valign="top" class="admin_menu02" style="padding-left:20px;">
