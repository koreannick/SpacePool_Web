<?
if(!defined("__GAUTECH__"))	 exit;

?>
<div class="s_view_nav_point">
	<div id="s_view_nav_review"></div>
</div>
<div class="s_view_info_label_wrap">
	<div class="s_view_info_label">이용후기</div>
	<span class="s_view_info_label_line"></span>
</div>
<div class="s_view_info_box">
	<div class="view_board_wrap">
		<div class="view_board">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<th align="center" valign="middle" scope="col">이용후기</th>
					<th width="100" align="center" valign="middle" scope="col">만족도</th>
					<th width="100" align="center" valign="middle" scope="col">닉네임</th>
					<th width="100" align="center" valign="middle" scope="col">등록일</th>
				</tr>
				<?
				$result2 = mysql_query("select * from es_product_review where puid=$uid order by uid desc");
				if($result2&&mysql_num_rows($result2)>0){
					while($r2=mysql_fetch_array($result2)){
				?>
				<tr>
					<td align="left" valign="middle"><?=stripslashes($r2["comment"])?></td>
					<td width="100" align="center" valign="middle">
						<img src="/images/common/star_<?=$r2["score"]?>.png">
					</td>
					<td width="100" align="center" valign="middle"><?=$r2["nickname"]?></td>
					<td width="100" align="center" valign="middle"><?=date("Y.m.d",$r2["wdate"])?></td>
				</tr>
				<?
					}
				}else{
					echo "<tr>
						<td colspan=4 align=center>등록된 후기가 없습니다.</td>
					</tr>";
				}
				@mysql_free_result($result2);
				?>
			</table>
		</div>
	</div>
</div>