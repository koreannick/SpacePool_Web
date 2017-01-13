<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

if($mode=="wish_ok"){
	include $_SERVER["DOCUMENT_ROOT"]."/_login_chk.php";
	}else{
				include $_SERVER["DOCUMENT_ROOT"]."/_login_chk2.php";
}
$connect = dbcon();

	foreach($_POST as $key => $val){
		if($key=="subject"){
			$$key = bad_tag_convert2(rawurldecode($val));
		}else{
				$$key = bad_tag_convert2($val);
		}
}

$save_path_tmp = $_SERVER["DOCUMENT_ROOT"]."/DATAS/es_product_tmp/";

$save_path = $_SERVER["DOCUMENT_ROOT"]."/DATAS/es_product/";



	   if($mode=="insert_ok"){
		   $status = "wait";
			if(!$e1)		$e1_price = "";
		   if(!$e2)		$e2_price = "";

	   $result = mysql_query("select * from es_img_tmp where id='$USESSION[0]' and sid='$_SESSION[SN_GUEST_ID]' order by uid asc");


	if($result&&mysql_num_rows($result)>0){
			   $i = 1;
			   while($r=mysql_fetch_array($result)){
					   if($r["gubun"]=="b"){
						 $bimg = $r["file1"];
					   }else{
							${"img".$i} = $r["file1"];
					   $i++;
					   }
		}
		}else{

			   redir_proc2("이미지를 등록해주세요");
				exit;
		}
		@mysql_free_result($result);

		if(!$bimg){
			redir_proc2("대표이미지를 등록해주세요");
			exit;
	}
	$p_opt = $_POST["p_opt"];

	if(count($p_opt)==0){
		redir_proc2("보유시설을 하나이상 등록해주세요");
		exit;
	}
	$p_opt_str = "";
			for($i=0;$i<count($p_opt);$i++){
					$p_opt_str .= ":".$p_opt[$i].":";
			}

	$result = mysql_query("select count(uid) from es_product_c_tmp where id='$USESSION[0]' and kind='1' and sid='$_SESSION[SN_GUEST_ID]'");

			if($result){
				$c_cnt = mysql_result($result,0,0);
	}
	@mysql_free_result($result);

		if($c_cnt==0){
			redir_proc2("상세설명을 한줄이상은 입력하세요. ");
			exit;
			}

	$result = mysql_query("select count(uid) from es_product_c_tmp where id='$USESSION[0]' and kind='2' and sid='$_SESSION[SN_GUEST_ID]'");
			if($result){
				$c_cnt = mysql_result($result,0,0);
			}
	@mysql_free_result($result);
			if($c_cnt==0){		redir_proc2("유의사항을 한줄이상은 입력하세요. ");		exit;	}

			if(!$pay_card)		$pay_card = "N";
			if(!$pay_bank)		$pay_bank = "N";
			if(!$pay_offline)	$pay_offline = "N";
			if(!$g1_d)	$g1_d = "N";
			if(!$g1_s)		$g1_s = "N";
			if(!$e1)		$e1 = "N";
			if(!$e2)		$e2 = "N";
				//해당 상품의 최저가 구하기	$price = 0;	if($gubun==1){		if($g1_d=="Y"&&$g1_s=="Y")	{			if($g1_d_price>=$g1_s_price)		$price = $g1_s_price;			else										$price = $g1_d_price;		}elseif($g1_d=="Y"&&$g1_s=="N"){			$price = $g1_d_price;		}elseif($g1_d=="N"&&$g1_s=="Y"){			$price = $g1_s_price;		}	}elseif($gubun==2){		$price = $g2_price;	}elseif($gubun==3){		$price = $g3_price;	}elseif($gubun==4){		$price = $g4_price;	}	$result = mysql_query("insert into es_product (uid,id,subject,gubun,g1_d,g1_d_price,g1_s,g1_s_price,g2,g2_p,g2_price,g3_t,g3_price,g4_person,g4_price,g4_hour1,g4_hour2,e1,e1_price,e2,e2_price,p_limit,size1,size2,bimg,img1,img2,img3,p_opt,status,ip,wdate,n_talk,address,lat,lng,etc1,etc2,pay_auth,pay_card,pay_bank,pay_bank_1,pay_bank_2,pay_bank_3,pay_offline,price,minHour,maxHour,e3_price,e4_price,OpenHour,CloseHour,OpenTime,CloseTime,holiday,e4,s_1,s_2,s_3,s_1_price,s_2_price,s_3_price,post,addr1,addr2,img4,img5,img6) values ('$uid','$USESSION[0]','$subject','$gubun','$g1_d','$g1_d_price','$g1_s','$g1_s_price','$g2','$g2_p','$g2_price','$g3_t','$g3_price','$g4_person','$g4_price','$g4_hour1','$g4_hour2','$e1','$e1_price','$e2','$e2_price','$p_limit','$size1','$size2','$bimg','$img1','$img2','$img3','$p_opt_str','$status','$REMOTE_ADDR','".time()."','$n_talk','$address','$lat','$lng','$etc1','$etc2','$pay_auth','$pay_card','$pay_bank','$pay_bank_1','$pay_bank_2','$pay_bank_3','$pay_offline','$price','$minHour','$maxHour','$e3_price','$e4_price','$OpenHour','$CloseHour','$OpenTime','$CloseTime','$holiday','$e4','$s_1','$s_2','$s_3','$s_1_price','$s_2_price','$s_3_price','$post','$addr1','$addr2','$img1','$img2','$img3')");	if($result){		$puid = mysql_insert_id();		@mysql_free_result($result);		//임시파일 이동		if(file_exists($save_path_tmp.$bimg))					copy($save_path_tmp.$bimg,$save_path.$bimg);		if(file_exists($save_path_tmp."thum/".$bimg))		copy($save_path_tmp."thum/".$bimg,$save_path."thum/".$bimg);		for($i=1;$i<=6;$i++){			if(file_exists($save_path_tmp.${"img".$i}))					copy($save_path_tmp.${"img".$i},$save_path.${"img".$i});			if(file_exists($save_path_tmp."thum/".${"img".$i}))		copy($save_path_tmp."thum/".${"img".$i},$save_path."thum/".${"img".$i});		}		$result = mysql_query("select kind,comment from es_product_c_tmp where id='$USESSION[0]' and sid='$_SESSION[SN_GUEST_ID]'");		if($result&&mysql_num_rows($result)>0){			while($r=mysql_fetch_array($result)){				foreach($r as $key=>$val){					$$key = $val;				}				@mysql_query("insert into es_product_c (puid,id,sid,kind,comment) values ('$puid','$USESSION[0]','$_SESSION[SN_GUEST_ID]','$kind','$comment')");			}			@mysql_query("delete from es_product_c_tmp where id='$USESSION[0]' and sid='$_SESSION[SN_GUEST_ID]'");		}		@mysql_free_result($result);		/*		if($gubun==2){			$gName = $_POST["gName"];			$gPeriod = $_POST["gPeriod"];			$gPrice = $_POST["gPrice"];			for($i=0;$i<count($gName);$i++){				if($gPrice[$i]){					@mysql_query("insert into es_product_g2 (puid,id,gName,gPeriod,gPrice) values ('$puid','$USESSION[0]','$gName[$i]','$gPeriod[$i]','$gPrice[$i]')");				}			}			$result = mysql_query("select min(gPrice) from es_product_g2 where puid=$puid and id='$USESSION[0]' order by gPrice asc");			if($result){				$price = mysql_result($result,0,0);				if($price>0){					@mysql_query("update es_product set price='$price' where uid='$puid' and id='$USESSION[0]'");				}			}			@mysql_free_result($result);		}		*/		redir_proc3("/member/space_host.php","등록완료되었습니다.");		exit;	}else{		redir_proc2("오류가 발생하였습니다.");		exit;	}}elseif($mode=="edit_ok"){	if(!$uid){		redir_proc3("/member/space_host.php","잘못된 접근입니다.");		exit;	}	if(!$e1)		$e1_price = "";	if(!$e2)		$e2_price = "";	$lmdate = time();	//원본 이미지	$result = mysql_query("select bimg,img1,img2,img3,id,img4,img5,img6 from es_product where uid=$uid");	if($result&&mysql_num_rows($result)>0){		$org_bimg = mysql_result($result,0,0);		$org_img1 = mysql_result($result,0,1);		$org_img2 = mysql_result($result,0,2);		$org_img3 = mysql_result($result,0,3);		$org_id = mysql_result($result,0,4);		$org_img4 = mysql_result($result,0,5);		$org_img5 = mysql_result($result,0,6);		$org_img6 = mysql_result($result,0,7);		if($org_id!=$USESSION[0]&&auth_lev()!=9){			redir_proc3("/member/space_host.php","본인데이터가 아니므로 수정하실 수 없습니다.");			exit;		}	}else{		redir_proc3("/member/space_host.php","잘못된 접근입니다.");		exit;	}	$result = mysql_query("select * from es_img_tmp where id='$org_id' and sid='$_SESSION[SN_GUEST_ID]' order by uid asc");	if($result&&mysql_num_rows($result)>0){		$i = 1;		while($r=mysql_fetch_array($result)){			if($r["gubun"]=="b"){				$bimg = $r["file1"];			}else{				${"img".$i} = $r["file1"];				$i++;			}		}	}else{		redir_proc2("이미지를 등록해주세요");		exit;	}	@mysql_free_result($result);	if(!$bimg){		redir_proc2("대표이미지를 등록해주세요");		exit;	}	$p_opt = $_POST["p_opt"];	if(count($p_opt)==0){		redir_proc2("보유시설을 하나이상 등록해주세요");		exit;	}	$p_opt_str = "";	for($i=0;$i<count($p_opt);$i++){		$p_opt_str .= ":".$p_opt[$i].":";	}	$result = mysql_query("select count(uid) from es_product_c_tmp where id='$org_id' and kind='1' and sid='$_SESSION[SN_GUEST_ID]'");	if($result){		$c_cnt = mysql_result($result,0,0);	}	@mysql_free_result($result);	if($c_cnt==0){		redir_proc2("상세설명을 한줄이상은 입력하세요. ");		exit;	}	$result = mysql_query("select count(uid) from es_product_c_tmp where id='$org_id' and kind='2' and sid='$_SESSION[SN_GUEST_ID]'");	if($result){		$c_cnt = mysql_result($result,0,0);	}	@mysql_free_result($result);	if($c_cnt==0){		redir_proc2("유의사항을 한줄이상은 입력하세요. ");		exit;	}	if($org_bimg==$bimg)		$bimg = $org_bimg;	if($org_img1==$img1)		$img1 = $org_img1;	if($org_img2==$img2)		$img2 = $org_img2;	if($org_img3==$img3)		$img3 = $org_img3;	if($org_img4==$img4)		$img4 = $org_img4;	if($org_img5==$img5)		$img5 = $org_img5;	if($org_img6==$img6)		$img6 = $org_img6;	if(!$pay_card)		$pay_card = "N";	if(!$pay_bank)		$pay_bank = "N";	if(!$pay_offline)	$pay_offline = "N";	if(!$g1_d)	$g1_d = "N";	if(!$g1_s)		$g1_s = "N";	if(!$e1)		$e1 = "N";	if(!$e2)		$e2 = "N";	//해당 상품의 최저가 구하기	$price = 0;	if($gubun==1){		if($g1_d=="Y"&&$g1_s=="Y")	{			if($g1_d_price>=$g1_s_price)		$price = $g1_s_price;			else										$price = $g1_d_price;		}elseif($g1_d=="Y"&&$g1_s=="N"){			$price = $g1_d_price;		}elseif($g1_d=="N"&&$g1_s=="Y"){			$price = $g1_s_price;		}	}elseif($gubun==2){		$price = $g2_price;	}elseif($gubun==3){		$price = $g3_price;	}elseif($gubun==4){		$price = $g4_price;	}	$result = mysql_query("update es_product set subject='$subject', gubun='$gubun', g1_d='$g1_d', g1_d_price='$g1_d_price', g1_s='$g1_s', g1_s_price='$g1_s_price', g2='$g2', g2_p='$g2_p', g2_price='$g2_price', g3_t='$g3_t', g3_price='$g3_price', g4_person='$g4_person', g4_price='$g4_price', g4_hour1='$g4_hour1', g4_hour2='$g4_hour2', e1='$e1', e1_price='$e1_price', e2='$e2', e2_price='$e2_price', p_limit='$p_limit', size1='$size1', size2='$size2', bimg='$bimg', img1='$img1', img2='$img2', img3='$img3', p_opt='$p_opt_str', lmdate='$lmdate', address='$address', lat='$lat', lng='$lng', etc1='$etc1', etc2='$etc2', pay_auth='$pay_auth', pay_card='$pay_card', pay_bank='$pay_bank', pay_bank_1='$pay_bank_1', pay_bank_2='$pay_bank_2', pay_bank_3='$pay_bank_3', pay_offline='$pay_offline', price='$price', minHour='$minHour', maxHour='$maxHour', e3_price='$e3_price', e4_price='$e4_price',OpenHour='$OpenHour',CloseHour='$CloseHour',OpenTime='$OpenTime',CloseTime='$CloseTime',holiday='$holiday',e4='$e4',s_1='$s_1',s_2='$s_2',s_3='$s_3',s_1_price='$s_1_price',s_2_price='$s_2_price',s_3_price='$s_3_price',post='$post',addr1='$addr1',addr2='$addr2', img4='$img4', img5='$img5', img6='$img6' where uid=$uid");	if($result){		//파일이 다를경우 기존에 파일은 삭제하고 새로운 파일 이동		if($org_bimg!=$bimg){			if(file_exists($save_path.$org_bimg))					file_delete($save_path.$org_bimg);			if(file_exists($save_path."thum/".$org_bimg))		file_delete($save_path."thum/".$org_bimg);			if(file_exists($save_path_tmp.$bimg))					copy($save_path_tmp.$bimg,$save_path.$bimg);			if(file_exists($save_path_tmp."thum/".$bimg))		copy($save_path_tmp."thum/".$bimg,$save_path."thum/".$bimg);		}		for($i=1;$i<=6;$i++){			if(${"org_img".$i}!=${"img".$i}){				if(file_exists($save_path.${"org_img".$i}))				file_delete($save_path.${"org_img".$i});				if(file_exists($save_path."thum/".${"org_img".$i}))		file_delete($save_path."thum/".${"org_img".$i});				if(file_exists($save_path_tmp.${"img".$i}))					copy($save_path_tmp.${"img".$i},$save_path.${"img".$i});				if(file_exists($save_path_tmp."thum/".${"img".$i}))		copy($save_path_tmp."thum/".${"img".$i},$save_path."thum/".${"img".$i});			}		}		$puid = $uid;		$result = mysql_query("select kind,comment from es_product_c_tmp where id='$org_id' and sid='$_SESSION[SN_GUEST_ID]'");		if($result&&mysql_num_rows($result)>0){			@mysql_query("delete from es_product_c where id='$org_id' and puid='$puid'");			while($r=mysql_fetch_array($result)){				foreach($r as $key=>$val){					$$key = $val;				}				@mysql_query("insert into es_product_c (puid,id,sid,kind,comment) values ('$puid','$org_id','$_SESSION[SN_GUEST_ID]','$kind','$comment')");			}			@mysql_query("delete from es_product_c_tmp where id='$org_id' and sid='$_SESSION[SN_GUEST_ID]'");		}		@mysql_free_result($result);		/*		if($gubun==2){			$gName = $_POST["gName"];			$gPeriod = $_POST["gPeriod"];			$gPrice = $_POST["gPrice"];			@mysql_query("delete from es_product_g2 where id='$org_id' and puid='$puid'");			for($i=0;$i<count($gName);$i++){				if($gPrice[$i]){					@mysql_query("insert into es_product_g2 (puid,id,gName,gPeriod,gPrice) values ('$puid','$org_id','$gName[$i]','$gPeriod[$i]','$gPrice[$i]')");				}			}			$result = mysql_query("select min(gPrice) from es_product_g2 where puid=$puid and id='$org_id' order by gPrice asc");			if($result){				$price = mysql_result($result,0,0);				if($price>0){					@mysql_query("update es_product set price='$price' where uid='$puid' and id='$org_id'");				}			}			@mysql_free_result($result);		}		*/		redir_proc3("/member/space_host.php","수정되었습니다.");		exit;	}else{		redir_proc2("오류가 발생하였습니다.");		exit;	}}elseif($mode=="del_ok"){	if(!$uid){		redir_proc3("/member/space_host.php","잘못된 접근입니다.");		exit;	}	$result = mysql_query("select id from es_product where uid=$uid");	if($result&&mysql_num_rows($result)>0){		$org_id = mysql_result($result,0,0);		@mysql_free_result($result);		if($org_id!=$USESSION[0]&&auth_lev()!=9){			redir_proc3("/member/space_host.php","본인데이터가 아니므로 삭제하실 수 없습니다.");			exit;		}	}else{		redir_proc3("/member/space_host.php","잘못된 접근입니다.");		exit;	}	@mysql_query("delete from es_product where uid=$uid");	@mysql_query("delete from es_product_c where puid=$uid");	@mysql_query("delete from es_product_wish where puid=$uid");	redir_proc3("reload","");}elseif($mode=="file_upload1_ok"){	$outlinecolor = array(255,255,255);	$img_size1 = array(2000,1197,2000,1197);	$img_size2 = array(371,222,371,222);	if($uid){		$result = mysql_query("select id from es_product where uid=$uid");		if($result&&mysql_num_rows($result)>0){			$org_id = mysql_result($result,0,0);		}		@mysql_free_result($result);	}else{		$org_id = $USESSION[0];	}	if($file1_name){		$return_file = file_save_I($file1,$file1_name, $save_path_tmp);		thumbnail2($save_path_tmp.$return_file, $save_path_tmp.$return_file, $img_size1, $outlinecolor);		thumbnail2($save_path_tmp.$return_file, $save_path_tmp."thum/".$return_file, $img_size2, $outlinecolor);		if($return_file){			@mysql_query("insert into es_img_tmp (id,file1,ip,wdate,gubun,sid) values ('$org_id','$return_file','$REMOTE_ADDR',".time().",'b','$_SESSION[SN_GUEST_ID]')");		?>

				<script type="text/javascript">
				parent.document.form0.file1.value = "";
				parent.document.getElementById('bimg').innerHTML = "<img src=\"/DATAS/es_product_tmp/thum/<?=$return_file?>\" />";
			  </script>

			 <?
		}
	}
}elseif($mode=="file_upload2_ok"){
				 $outlinecolor = array(255,255,255);
				 $img_size1 = array(2000,1197,2000,1197);
				 //$img_size2 = array(150,90,150,90);	$img_size2 = array(371,222,371,222);	if($uid){		$result = mysql_query("select id from es_product where uid=$uid");		if($result&&mysql_num_rows($result)>0){			$org_id = mysql_result($result,0,0);		}		@mysql_free_result($result);	}else{		$org_id = $USESSION[0];	}	$num = 0;	$result = mysql_query("select max(num) from es_img_tmp where id='$org_id' and gubun='s' and sid='$_SESSION[SN_GUEST_ID]' ");	if($result&&mysql_num_rows($result)>0){		$num = mysql_result($result,0,0) + 1;	}	@mysql_free_result($result);	if($num>3){
			 ?>
			 <script type="text/javascript">
				parent.document.form0.file2.value = "";
			</script>

			<?
			redir_proc2("공간이미지는 최대3개까지만 등록가능합니다.");
				exit;
	}

	if($file2_name){
				$return_file = file_save_I($file2,$file2_name, $save_path_tmp);

				thumbnail2($save_path_tmp.$return_file, $save_path_tmp.$return_file, $img_size1, $outlinecolor);
				thumbnail2($save_path_tmp.$return_file, $save_path_tmp."thum/".$return_file, $img_size2, $outlinecolor);
				if($return_file){
					@mysql_query("insert into es_img_tmp (id,file1,ip,wdate,gubun,num,sid) values ('$org_id','$return_file','$REMOTE_ADDR',".time().",'s',$num,'$_SESSION[SN_GUEST_ID]')");
					$result = mysql_query("select * from es_img_tmp where id='$org_id' and gubun='s' and sid='$_SESSION[SN_GUEST_ID]' order by uid asc");
					if($result&&mysql_num_rows($result)>0){

					$i = 1;
					while($r=mysql_fetch_array($result)){
				?>
				<script type="text/javascript">
				parent.document.form0.file2.value = "";
								parent.document.getElementById('img<?=$i?>').innerHTML = "<img src=\"/DATAS/es_product_tmp/thum/<?=$r[file1]?>\" />";
				</script>
				<?
					$i++;
					}
				}

					@mysql_free_result($result);
					}
				 }
}elseif($mode=="file_upload2_del_ok"){
					if($uid){
						$result = mysql_query("select id from es_product where uid=$uid");
						if($result&&mysql_num_rows($result)>0){
								$org_id = mysql_result($result,0,0);
						}
			@mysql_free_result($result);
					}else{
		$org_id = $USESSION[0];
					}

	for($i=1;$i<=6;$i++){
						if(${"del_".$i}=="Y"){
							$result = mysql_query("select file1 from es_img_tmp where id='$org_id' and gubun='s' and sid='$_SESSION[SN_GUEST_ID]' and num=$i");
						if($result&&mysql_num_rows($result)>0){
							$file1 = mysql_result($result,0,0);
							if($file1){
								file_delete($save_path_tmp.$file1);
								file_delete($save_path_tmp."thum/".$file1);
								@mysql_query("delete from es_img_tmp where id='$org_id' and gubun='s' and sid='$_SESSION[SN_GUEST_ID]' and num=$i");
							}
				 		}
						@mysql_free_result($result);
							unset($file1);
							}
	}?>
<!doctype html>
						<html>
<head>
								<meta charset="utf-8">
								<script src="/js/jquery-1.11.2.min.js"></script>
								<script type="text/javascript">
$(window).load(function () {<?	//삭제하고나면 다시 재정렬(중간에 삭제하는것때문)	$result = mysql_query("select * from es_img_tmp where id='$org_id' and gubun='s' and sid='$_SESSION[SN_GUEST_ID]' order by uid asc");	if($result&&mysql_num_rows($result)>0){		for($i=1;$i<=6;$i++){			if(@mysql_data_seek($result,($i-1))){				$r = mysql_fetch_array($result);				?>				@mysql_query("update es_img_tmp set num=$i where uid=$r[uid]");					parent.document.form0.file2.value = "";					parent.document.getElementById('image_0<?=$i?>').checked = false;					$('#image_0<?=$i?>',parent.document).next("label").removeClass('checkbox_on');					parent.document.getElementById('img<?=$i?>').innerHTML = "<img src=\"/DATAS/es_product_tmp/thum/<?=$r[file1]?>\" />";				<?			}else{				?>					parent.document.form0.file2.value = "";					parent.document.getElementById('image_0<?=$i?>').checked = false;					$('#image_0<?=$i?>',parent.document).next("label").removeClass('checkbox_on');					parent.document.getElementById('img<?=$i?>').innerHTML = "";				<?			}		}	}else{		for($i=1;$i<=6;$i++){	?>		parent.document.form0.file2.value = "";		parent.document.getElementById('image_0<?=$i?>').checked = false;		$('#image_0<?=$i?>',parent.document).next("label").removeClass('checkbox_on');		parent.document.getElementById('img<?=$i?>').innerHTML = "";	<?		}	}	@mysql_free_result($result);?>});
								</script>
</head>
<body></body></html>
<?
}elseif($mode=="c_tmp_ok"){
							if($comment1){
									$kind = 1;
									$comment = $comment1;
							}elseif($comment2){
									$kind = 2;
									$comment = $comment2;
							}else{
									redir_proc2("잘못된 접근입니다.");
									exit;
	}

	if($uid){
									$result = mysql_query("select id from es_product where uid=$uid");

									if($result&&mysql_num_rows($result)>0){
											$org_id = mysql_result($result,0,0);
									}
									@mysql_free_result($result);
							}else{
										$org_id = $USESSION[0];
							}
											$result = mysql_query("select count(uid) from es_product_c_tmp where id='$org_id' and kind='$kind' and sid='$_SESSION[SN_GUEST_ID]'");

						if($result){
							$c_cnt = mysql_result($result,0,0);
						}
	@mysql_free_result($result);

						if($c_cnt>=10){
								redir_proc2("최대 10줄 까지만 추가 가능합니다. ");
								exit;
	}

						$result = mysql_query("insert into es_product_c_tmp (puid,id,sid,kind,comment) values ('$uid','$org_id','$_SESSION[SN_GUEST_ID]','$kind','$comment')");

						if($result){
							@mysql_free_result($result);
						?>

						<script type="text/javascript">
						parent.document.form0.comment<?=$kind?>.value = "";
						parent.Ajax_Request('/member/_product_proc.php?mode=c_tmp_list&kind=<?=$kind?>&uid=<?=$uid?>','c_list<?=$kind?>','post');
						</script>
						<?
	}else{
		redir_proc2("오류가 발생하였습니다.");
								exit;
	}
}elseif($mode=="c_tmp_list"){
								if($uid){
									$result = mysql_query("select id from es_product where uid=$uid");
								if($result&&mysql_num_rows($result)>0){
									$org_id = mysql_result($result,0,0);		}
								@mysql_free_result($result);

									$where2 = " and puid=$uid";
								}else{
										$org_id = $USESSION[0];
								}

								$result = mysql_query("select * from es_product_c_tmp where id='$org_id' and kind='$kind' and sid='$_SESSION[SN_GUEST_ID]' $where2");

								if($result&&mysql_num_rows($result)>0){
		$i = 1;
										while($r=mysql_fetch_array($result)){
			foreach($r as $key=>$val){
														$$key = stripslashes($val);
													}
?>
										<div class="txt_input_desc"><?=$i?>. <?=$comment?> <a href="javascript:C_Del(<?=$uid?>,<?=$kind?>);">X</a>		</div>
								<?
		$i++;
											}
	}else{
										echo "&nbsp;";
	}
									@mysql_free_result($result);
}elseif($mode=="c_tmp_del_ok"){
									if($uid){
											$result = mysql_query("select id from es_product where uid=$uid");
									if($result&&mysql_num_rows($result)>0){
											$org_id = mysql_result($result,0,0);
									}
									@mysql_free_result($result);
							   }else{
										$org_id = $USESSION[0];
								}

	if($c_t_uid){
								@mysql_query("delete from es_product_c_tmp where id='$org_id' and kind='$c_t_kind' and sid='$_SESSION[SN_GUEST_ID]' and uid='$c_t_uid'");
								}
	?>
	<script type="text/javascript">		parent.Ajax_Request('/member/_product_proc.php?mode=c_tmp_list&kind=<?=$c_t_kind?>&uid=<?=$uid?>','c_list<?=$c_t_kind?>','post');	</script>	<?}elseif($mode=="s_update_ok"){	//현재 상태값	$result = mysql_query("select status,id from es_product where uid=$uid");	if($result&&mysql_num_rows($result)>0){		$status = mysql_result($result,0,0);		$id = mysql_result($result,0,1);	}	@mysql_free_result($result);	if($id!=$USESSION[0]&&auth_lev()!=9){		redir_proc3("reload","본인데이터가 아니므로 수정하실 수 없습니다.");		exit;	}	if($status=="wait")	$status_n = "ok";	else						$status_n = "wait";	$result = mysql_query("update es_product set status='$status_n' where uid=$uid");	if($result){		//redir_proc3("reload","");		//exit;	}else{		redir_proc2("오류가 발생하였습니다.");		exit;	}}elseif($mode=="wish_ok"){	$result = mysql_query("select * from es_product_wish where puid=$uid and id='$USESSION[0]'");	if($result&&mysql_num_rows($result)>0){		@mysql_free_result($result);		@mysql_query("delete from es_product_wish where puid=$uid and id='$USESSION[0]'");	}else{		@mysql_free_result($result);		@mysql_query("insert into es_product_wish (puid,id,ip,wdate) values ('$uid','$USESSION[0]','$REMOTE_ADDR','".time()."')");	}}?>