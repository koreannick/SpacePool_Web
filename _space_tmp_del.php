<?
 

if(!$connect)		$connect = dbcon();

if($uid)		$where_qry = " and puid=0";

//임시 저장된 이미지들 삭제(접속자 본인것만 우선 처리)
$result = mysql_query("select * from es_img_tmp where id='$USESSION[0]' and sid='$_SESSION[SN_GUEST_ID]' $where_qry");
if($result&&mysql_num_rows($result)>0){
	$save_path_tmp = $_SERVER["DOCUMENT_ROOT"]."/DATAS/es_product_tmp/";

	while($r=mysql_fetch_array($result)){
		if($r["file1"]){
			file_delete($save_path_tmp.$r["file1"]);
			file_delete($save_path_tmp."thum/".$r["file1"]);
		}
	}

	@mysql_query("delete from es_img_tmp where id='$USESSION[0]' and sid='$_SESSION[SN_GUEST_ID]' $where_qry");
	@mysql_query("OPTIMIZE TABLE es_img_tmp");
}
@mysql_free_result($result);

flush2();

//1시간 지난 데이터들도 삭제
$prev_date = mktime(date("H")-1,date("i"),date("s"),date("m"),date("d"),date("Y"));
$result = mysql_query("select * from es_img_tmp where wdate < $prev_date $where_qry");
if($result&&mysql_num_rows($result)>0){
	$save_path_tmp = $_SERVER["DOCUMENT_ROOT"]."/DATAS/es_product_tmp/";

	while($r=mysql_fetch_array($result)){
		if($r["file1"]){
			file_delete($save_path_tmp.$r["file1"]);
			file_delete($save_path_tmp."thum/".$r["file1"]);
		}
	}

	@mysql_query("delete from es_img_tmp where wdate < $prev_date $where_qry");
	@mysql_query("OPTIMIZE TABLE es_img_tmp");
}
@mysql_free_result($result);

flush2();




//임시 저장된 내역들 삭제(접속자 본인것만 우선 처리)
@mysql_query("delete from es_product_c_tmp where id='$USESSION[0]' and sid='$_SESSION[SN_GUEST_ID]' $where_qry");
@mysql_query("OPTIMIZE TABLE es_product_c_tmp");

flush2();

//1시간 지난 데이터들도 삭제
$prev_date = mktime(date("H")-1,date("i"),date("s"),date("m"),date("d"),date("Y"));
@mysql_query("delete from es_product_c_tmp where wdate < $prev_date $where_qry");
@mysql_query("OPTIMIZE TABLE es_product_c_tmp");

flush2();

?>