<?

include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

$save_path_tmp = $_SERVER["DOCUMENT_ROOT"]."/DATAS/es_product_tmp/";
$save_path = $_SERVER["DOCUMENT_ROOT"]."/DATAS/es_product/";


function file_save_I($file, $file_name, $dir){
	// 디렉토리 체크 생성
	mk_dir($dir);

	// 파일 확장자
	$ext = strtolower(substr($file_name, strrpos($file_name, ".")+1));
	// 파일 확장자
	if($ext=="jpg"||$ext=="jpeg"||$ext=="gif"||$ext=="png"){
		$filename = uniqid("f_") . "." . $ext;
		$attech_path = $dir . $filename;

		copy($file, $attech_path);
		unlink($file);
		return $filename;
	}else{
		echo "<script>alert('등록이 불가능한 파일입니다.');history.back();</script>";
		exit;
	}

}

	$outlinecolor = array(255,255,255);
	$img_size1 = array(2000,1197,2000,1197);
	$img_size2 = array(371,222,371,222);

	if($uid){
		$result = mysql_query("select id from es_product where uid=$uid");
		if($result&&mysql_num_rows($result)>0){
			$org_id = mysql_result($result,0,0);
		}
		@mysql_free_result($result);
	}else{
		$org_id = $USESSION[0];
	}

	if($file1){
		$return_file = file_save_I($file1,$file1, $save_path_tmp);
		thumbnail2($save_path_tmp.$return_file, $save_path_tmp.$return_file, $img_size1, $outlinecolor);
		thumbnail2($save_path_tmp.$return_file, $save_path_tmp."thum/".$return_file, $img_size2, $outlinecolor);

		if($return_file){
			@mysql_query("insert into es_img_tmp (id,file1,ip,wdate,gubun,sid) values ('$org_id','$return_file','$REMOTE_ADDR',".time().",'b','$_SESSION[SN_GUEST_ID]')");
		?>
		<script type="text/javascript">
		parent.document.form0.file1.value = "";
		parent.document.getElementById('bimg').innerHTML = "<img src=\"/DATAS/es_product_tmp/thum/<?=$return_file?>\" />";
		</script>
		<?
		}
	}
}
?>
