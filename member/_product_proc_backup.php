<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";




	}else{
				include $_SERVER["DOCUMENT_ROOT"]."/_login_chk2.php";



	foreach($_POST as $key => $val){
		if($key=="subject"){
			$$key = bad_tag_convert2(rawurldecode($val));
		}else{
				$$key = bad_tag_convert2($val);
		}








	   if($mode=="insert_ok"){
		   $status = "wait";
			if(!$e1)		$e1_price = "";
		   if(!$e2)		$e2_price = "";

	   $result = mysql_query("select * from es_img_tmp where id='$USESSION[0]' and sid='$_SESSION[SN_GUEST_ID]' order by uid asc");



			   $i = 1;
			   while($r=mysql_fetch_array($result)){
					   if($r["gubun"]=="b"){
						 $bimg = $r["file1"];
					   }else{
							${"img".$i} = $r["file1"];
					   $i++;
					   }

		}else{

			   redir_proc2("이미지를 등록해주세요");
				exit;
		}
		@mysql_free_result($result);

		if(!$bimg){
			redir_proc2("대표이미지를 등록해주세요");
			exit;



	if(count($p_opt)==0){
		redir_proc2("보유시설을 하나이상 등록해주세요");
		exit;


			for($i=0;$i<count($p_opt);$i++){
					$p_opt_str .= ":".$p_opt[$i].":";
			}



			if($result){
				$c_cnt = mysql_result($result,0,0);



		if($c_cnt==0){
			redir_proc2("상세설명을 한줄이상은 입력하세요. ");
			exit;
			}


			if($result){
				$c_cnt = mysql_result($result,0,0);
			}

			if($c_cnt==0){

			if(!$pay_card)		$pay_card = "N";
			if(!$pay_bank)		$pay_bank = "N";
			if(!$pay_offline)	$pay_offline = "N";
			if(!$g1_d)	$g1_d = "N";
			if(!$g1_s)		$g1_s = "N";
			if(!$e1)		$e1 = "N";
			if(!$e2)		$e2 = "N";
				//해당 상품의 최저가 구하기

				<script type="text/javascript">
				parent.document.form0.file1.value = "";
				parent.document.getElementById('bimg').innerHTML = "<img src=\"/DATAS/es_product_tmp/thum/<?=$return_file?>\" />";
			  </script>

			 <?



				 $outlinecolor = array(255,255,255);
				 $img_size1 = array(2000,1197,2000,1197);
				 //$img_size2 = array(150,90,150,90);
			 ?>
			 <script type="text/javascript">
				parent.document.form0.file2.value = "";
			</script>

			<?
			redir_proc2("공간이미지는 최대3개까지만 등록가능합니다.");
				exit;



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

								parent.document.getElementById('img<?=$i?>').innerHTML = "<img src=\"/DATAS/es_product_tmp/thum/<?=$r[file1]?>\" />";
				</script>
				<?
					$i++;
					}
				}

					@mysql_free_result($result);
					}
				 }

					if($uid){
						$result = mysql_query("select id from es_product where uid=$uid");
						if($result&&mysql_num_rows($result)>0){
								$org_id = mysql_result($result,0,0);
						}

					}else{

					}


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


						<html>

								<meta charset="utf-8">
								<script src="/js/jquery-1.11.2.min.js"></script>
								<script type="text/javascript">

								</script>




							if($comment1){
									$kind = 1;
									$comment = $comment1;
							}elseif($comment2){
									$kind = 2;
									$comment = $comment2;
							}else{
									redir_proc2("잘못된 접근입니다.");
									exit;



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


						if($c_cnt>=10){
								redir_proc2("최대 10줄 까지만 추가 가능합니다. ");
								exit;


						$result = mysql_query("insert into es_product_c_tmp (puid,id,sid,kind,comment) values ('$uid','$org_id','$_SESSION[SN_GUEST_ID]','$kind','$comment')");

						if($result){
							@mysql_free_result($result);
						?>

						<script type="text/javascript">
						parent.document.form0.comment<?=$kind?>.value = "";
						parent.Ajax_Request('/member/_product_proc.php?mode=c_tmp_list&kind=<?=$kind?>&uid=<?=$uid?>','c_list<?=$kind?>','post');
						</script>
						<?


								exit;


								if($uid){
									$result = mysql_query("select id from es_product where uid=$uid");
								if($result&&mysql_num_rows($result)>0){
									$org_id = mysql_result($result,0,0);
								@mysql_free_result($result);

									$where2 = " and puid=$uid";
								}else{
										$org_id = $USESSION[0];
								}

								$result = mysql_query("select * from es_product_c_tmp where id='$org_id' and kind='$kind' and sid='$_SESSION[SN_GUEST_ID]' $where2");

								if($result&&mysql_num_rows($result)>0){

										while($r=mysql_fetch_array($result)){

														$$key = stripslashes($val);
													}

										<div class="txt_input_desc">
								<?

											}

										echo "&nbsp;";

									@mysql_free_result($result);

									if($uid){
											$result = mysql_query("select id from es_product where uid=$uid");
									if($result&&mysql_num_rows($result)>0){
											$org_id = mysql_result($result,0,0);
									}
									@mysql_free_result($result);
							   }else{
										$org_id = $USESSION[0];
								}


								@mysql_query("delete from es_product_c_tmp where id='$org_id' and kind='$c_t_kind' and sid='$_SESSION[SN_GUEST_ID]' and uid='$c_t_uid'");
								}

