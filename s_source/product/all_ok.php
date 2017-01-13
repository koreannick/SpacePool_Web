<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

if(!$connect){	$connect = dbcon();	}

foreach($_POST as $key => $val){
	$$key = bad_tag_convert($val);
}

if($mode == "edit_ok"){


	redir_proc3($_SERVER[PHP_SELF] . "?mode=list&page=$page", "");

}elseif($mode == "del_ok"){
	$result = mysql_query("Select bimg,img1,img2,img3 From $table Where uid='$uid'",$connect);
	if($result&&mysql_num_rows($result)>0){
		$bimg = mysql_result($result,0,0);
		$img1 = mysql_result($result,0,1);
		$img2 = mysql_result($result,0,2);
		$img3 = mysql_result($result,0,3);

		if($bimg){
			file_delete($save_path.$bimg);
			file_delete($save_path."thum/".$bimg);
		}
		for($i=1;$i<=3;$i++){
			if(${"img".$i}){
				file_delete($save_path.${"img".$i});
				file_delete($save_path."thum/".${"img".$i});
			}
		}
	}
	@mysql_free_result($result);

	$result = mysql_query("Delete From $table Where uid='$uid'");
	if($result){
		@mysql_query("delete from es_product_c where puid=$uid");
		@mysql_query("delete from es_product_g2 where puid=$uid");

		redir_proc3("reload", "");
	}else{
		redir_proc2("오류가 발생하였습니다.");
		exit;
	}


}elseif($mode=="nsave_ok"){
	if($uid){
		@mysql_query("update $table set num='$num' where uid='$uid'");
	}

}elseif($mode=="main_chg_ok"){
	$uid = $_POST["uid"];

	for($i=0;$i<count($uid);$i++){
		@mysql_query("update $table set main='$main' where uid=$uid[$i]");
	}

	redir_proc3("reload","");
}elseif($mode=="host_chg_ok"){
	$uid = $_POST["uid"];

	for($i=0;$i<count($uid);$i++){
		@mysql_query("update $table set id='$main2' where uid=$uid[$i]");
		@mysql_query("update es_product_c set id='$main2' where puid=$uid[$i]");
		@mysql_query("update es_product_c set id='$main2' where puid=$uid[$i]");
	}

	redir_proc3("reload","");
}elseif($mode == "del2_ok"){
	$result = mysql_query("Delete From es_booking Where uid='$uid'");
	if($result){
		redir_proc3("reload","");
	}else{
		redir_proc2("오류가 발생하였습니다.");
		exit;
	}
}elseif($mode == "b_update_ok"){
	$uid = $_POST["uid"];

	for($i=0;$i<count($uid);$i++){
		if($SCHG==1){
			@mysql_query("update es_booking pay_status='N', pay_date='' Where uid='$uid[$i]'");
		}elseif($SCHG==2){
			@mysql_query("update es_booking pay_status='Y', pay_date='".date("Y-m-d")."' Where uid='$uid[$i]'");
		}elseif($SCHG==3){
			@mysql_query("update es_booking status='cancel', cancel_date='".time()."' Where uid='$uid[$i]'");
		}elseif($SCHG==4){
			@mysql_query("Delete From es_booking Where uid='$uid[$i]'");
		}
	}

	redir_proc3("reload","");
}

?>
