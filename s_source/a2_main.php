<?
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/conf/function.php");

// 인증 처리 --------------------------------------------
if(auth_lev()!=9){
	redir_proc("/", "");
}
//------------------------------------------------------

if(!$connect)		$connect = dbcon();

$page_title = "관리자메인";

// TOP
if($CONF_SKIN == 1){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/top_admin.php");
}elseif($CONF_SKIN == 2){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/top_blank.php");
}

//오늘날짜 time값
$nowdate1 = mktime(0,0,0,date("m"),date("d"),date("Y"));
$nowdate2 = mktime(23,59,59,date("m"),date("d"),date("Y"));

$nowdate11 = mktime(0,0,0,date("m"),1,date("Y"));
$nowdate22 = mktime(23,59,59,date("m"),31,date("Y"));
//////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
	<table width="800">
		<tr>
			<td><b>현재 접속IP</b> : <?=$REMOTE_ADDR?></td>
		</tr>
		<tr>
			<td><b>통계분석</b> / 오늘은 <?=date("Y년 m월 d일")?> 입니다</td>
		</tr>
		<tr>
			<td bgcolor="00B4CE" height="2"></td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellpadding="4">
					<tr>
						<td width="33%"><b>TODAY REPORT</b></td>
						<td width="33%"><b>MONTH REPORT</b></td>
						<td width="34%"><b>TOTAL REPORT</b></td>
					</tr>
					<?
					$today_write = 0;
					$result = mysql_query("show tables like 'es_free%'");
					if($result && mysql_num_rows($result)!=0){
							while($table = mysql_fetch_array($result)){
								if($table[0]!="board_control_info"){
									$query = "SELECT '$table[0]' as Tname,$table[0].* FROM $table[0] WHERE wdate >= $nowdate1 and wdate <= $nowdate2";
									$result2 = mysql_query($query);
									$today_write += mysql_num_rows($result2);
									while($data = mysql_fetch_array($result2)) $board_data[] = $data;
									mysql_free_result($result2);
								}
								flush();
							}
					@mysql_free_result($result);
					}

					$result = mysql_query("select count(id) from es_member where wdate >= $nowdate1 and wdate <= $nowdate2");
					$today_join = mysql_result($result,0,0);
					@mysql_free_result($result);

					$result = mysql_query("select sum(wdate >= $nowdate1 and wdate <= $nowdate2),sum(wdate >= $nowdate11 and wdate <= $nowdate22),count(id) from es_member");
					$today_join = mysql_result($result,0,0);
					$month_join = mysql_result($result,0,1);
					$total_join = mysql_result($result,0,2);
					@mysql_free_result($result);

					$result = mysql_query("SELECT count(uid) FROM con_info where con_date = '".date("Y-m-d")."'");
					$today_count = mysql_result($result,0,0);
					@mysql_free_result($result);

					$result = mysql_query("SELECT count(uid) FROM con_info where con_date like '".date("Y-m-")."%'");
					$month_count = mysql_result($result,0,0);
					@mysql_free_result($result);

					$result = mysql_query("SELECT count(uid) FROM con_info");
					$total_count = mysql_result($result,0,0);
					@mysql_free_result($result);

					$result = mysql_query("SELECT uid FROM con_info group by con_date");
					if(mysql_num_rows($result)>0)			$day_avcount = $total_count / mysql_num_rows($result);
					@mysql_free_result($result);

					$result = mysql_query("SELECT uid FROM con_info group by substring(con_date,1,8)");
					if(mysql_num_rows($result)>0)			$month_avcount = $total_count / mysql_num_rows($result);
					@mysql_free_result($result);
					?>
					<tr>
						<td><table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#D4D4D4">
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="30%" align="center">가입회원수</td>
								<td bgcolor="FFFFFF" width="70%"><?=number_format($today_join)?> 명</td>
							</tr>
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="30%" align="center">게시판글</td>
								<td bgcolor="FFFFFF" width="70%"><?=number_format($today_write)?> 건</td>
							</tr>
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="30%" align="center">접속통계</td>
								<td bgcolor="FFFFFF" width="70%"><?=number_format($today_count)?> 건</td>
							</tr>
						</table></td>
						<td><table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#D4D4D4">
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="30%" align="center">총회원수</td>
								<td bgcolor="FFFFFF" width="70%"><?=number_format($total_join)?> 명</td>
							</tr>
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="30%" align="center">이달회원수</td>
								<td bgcolor="FFFFFF" width="70%"><?=number_format($month_join)?> 명</td>
							</tr>
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="30%" align="center">접속통계</td>
								<td bgcolor="FFFFFF" width="70%"><?=number_format($month_count)?> 건</td>
							</tr>
						</table></td>
						<td><table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#D4D4D4">
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="40%" align="center">전체 접속수</td>
								<td bgcolor="FFFFFF" width="60%"><?=number_format($total_count)?> 건</td>
							</tr>
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="40%" align="center">일 평균 접속수</td>
								<td bgcolor="FFFFFF" width="60%"><?=number_format($day_avcount)?> 건</td>
							</tr>
							<tr style="padding:5 5 5 5">
								<td bgcolor="#F2F2F2" width="40%" align="center">월 평균 접속수</td>
								<td bgcolor="FFFFFF" width="60%"><?=number_format($month_avcount)?> 건</td>
							</tr>
						</table></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height=10></td>
		</tr>
		<tr>
			<td><table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td><b>오늘의 회원가입현황</b> (상위10건)</td>
					<td align="right"><a href="/s_source/a2_member.php">more</a></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td bgcolor="00B4CE" height="2"></td>
		</tr>
		<tr>
			<td><table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#D4D4D4">
				<tr style="padding:5 5 5 5" align="center" bgcolor="#F2F2F2">
					<td>No</b></td>
					<td>회원ID</b></td>
					<td>이름</b></td>
					<td>이메일</b></td>
					<td>연락처</b></td>
					<td>최근로그인일자</b></td>
				</tr>
				<?
					$query = "SELECT * from es_member where wdate >= $nowdate1 and wdate <= $nowdate2 order by uid desc limit 0,10";
					$result = mysql_query($query);
					if(!$result || mysql_num_rows($result) == 0){
				?>
				<tr style="padding:10 10 10 10" bgcolor="#FFFFFF">
					<td colspan="6" align="center">※ 금일 가입한 회원이 없습니다.</td>
				</tr>
				<?
					}else{
						$i=1;
						while($data = mysql_fetch_array($result)){

							if($data[last_log_date]>0){
								$last_log_date = date("Y.m.d H:i",$data[last_log_date]);
							}else{
								$last_log_date = "";
							}
				?>
							<tr style="padding:5 5 5 5" align="center" bgcolor="#FFFFFF">
								<td><?=$i?></td>
								<td><?=$data[id]?></td>
								<td><?=$data[name]?></td>
								<td><?=$data[email]?></td>
								<td><?=$data[mobile]?></td>
								<td><?=$last_log_date?></td>
							</tr>
				<?
							$i++;
							flush();
						}
				mysql_free_result($result);
					}
				?>
			</table></td>
		</tr>
		<tr>
			<td height=10></td>
		</tr>
	</table>
<?
// BOTTOM
if($CONF_SKIN == 1){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/bottom_admin.php");
}elseif($CONF_SKIN == 2){
	include_once($_SERVER["DOCUMENT_ROOT"] . "/s_inc/bottom_blank.php");
}
?>
