<?
function errorc_msg ($msg) {
	echo("<script language=\"javascript\">
   <!--   alert('$msg');   history.back();
   //--> </script>");
}


// 데이타 베이스 오류시에 에러 메시지 출력 함수
function db_error(){
	global $adminmail;
	echo("
	<html>
	<body>
	<br><br>
	<table align=center style=font-size:9pt;>
	<tr>
	<td align=center>
	<font size='10'><b>Warning</b></font><br>
	<font color=blue><b>대단히 죄송합니다.</b></font><br><br>
	현재 DATABSE SEVER의 <font color=red>
	<b>과부하</font>로 일시 서비스를 사용하실수가 없습니다.</b>
	<br><br>
	계속적인 사용 일시 중지시에는 <a href='mailto:$adminmail'>$adminmail</a>로 연락 주시기 바랍니다.<br>
	</td>
	</tr>
	</table>
	</body>
	</html>
	");
	exit;
}



##############################################################################################
## v20051012-1321
## 이미지 사이즈 체크
##--------------------------------------------------------------------------------------------
## parameter : 3
## $img(이미지경로), $width(제한넓이), $height(제한높이)
## -------------------------------------------------------------------------------------------
function find_imgsize($img, $width, $height){
	$img_size = @getimagesize($_SERVER[DOCUMENT_ROOT] . $img);
	$img_size_str = "";
	if($img_size[0]>$img_size[1]){
		if($img_size[0] > $width){
			$img_size_str = "width=$width";
		}
		$hh = $img_size[1] * ($width/$img_size[0]);
		if($hh>$height){
			$img_size_str = "height=$height";
		}
	}else{
		if($img_size[1] > $height){
			$img_size_str = "height=$height";
		}
		$ww = $img_size[0] * ($height/$img_size[1]);
		if($ww>$width){
			$img_size_str = "width=$width";
		}
	}
	return $img_size_str;
}
##---------------------------------------
## 데이터 베이스 연결 ###############################################################################
function dbcon(){
	GLOBAL $CONF_SERVERNAME;
	GLOBAL $CONF_DBUSERID;
	GLOBAL $CONF_DBPASSWD;
	GLOBAL $CONF_DBNAME;

	$connect=mysql_connect($CONF_SERVERNAME, $CONF_DBUSERID, $CONF_DBPASSWD) or errorc_msg("잠시후 다시 접속해 주십시요");
	mysql_select_db($CONF_DBNAME, $connect) or die(db_error());
	mysql_query("set names utf8");
	return $connect;
}
function dbcon2(){
	GLOBAL $CONF_SERVERNAME2;
	GLOBAL $CONF_DBUSERID2;
	GLOBAL $CONF_DBPASSWD2;
	GLOBAL $CONF_DBNAME2;

	$connect2=mysql_connect($CONF_SERVERNAME2, $CONF_DBUSERID2, $CONF_DBPASSWD2) or errorc_msg("잠시후 다시 접속해 주십시요");
	mysql_select_db($CONF_DBNAME2, $connect2) or die(db_error());
	return $connect2;
}

function sms_dbcon(){
	GLOBAL $CONF_SMS_SERVERNAME;
	GLOBAL $CONF_SMS_DBUSERID;
	GLOBAL $CONF_SMS_DBPASSWD;
	GLOBAL $CONF_SMS_DBNAME;

//	$sms_connect=mysql_connect($CONF_SMS_SERVERNAME, $CONF_SMS_DBUSERID, $CONF_SMS_DBPASSWD) or errorc_msg("잠시후 다시 접속해 주십시요3");
	//mysql_select_db($CONF_SMS_DBNAME, $sms_connect) or die(db_error());
//	return $sms_connect;
}


## 인증 함수 ###########################################################################
## 쿠키 변수 이용
function auth_lev(){
	// val : 사이트 구분값
	global $USESSION;
	switch($USESSION[2]){
		case("m1")			:	$lev = 1;		break;		// 지원본부
		case("m2")			:	$lev = 2;		break;		// 지점장(본점)
		case("m3")			:	$lev = 3;		break;		// 지점장(지사)
		case("m4")			:	$lev = 4;		break;		// 내근
		case("m5")			:	$lev = 5;		break;		// FC
		case("m6")			:	$lev = 6;		break;		// 대표
		case("m7")			:	$lev = 7;		break;
		case("intra")			:	$lev = 8;		break;
		case("admin")		:	$lev = 9;		break;
		default				:	$lev = 0;		break;
	}

	//level 리턴
	return $lev;
}

function admin_auth_lev(){
	// val : 사이트 구분값
	global $ADMIN_USESSION;
	switch($ADMIN_USESSION[2]){
		case("admin") 	:	$lev = 9;		break;
		case("intra")		:	$lev = 8;		break;
		default				:	$lev = 0;		break;
	}

	//level 리턴
	return $lev;
}


## 리다이렉션 #####################################################################################
function redir_proc($redir, $msg=""){
	flush2();
	if($connect)		@mysql_close($connect);
	if($result)			@mysql_free_result($result);
	echo "<script language='javascript'>";
	if($msg)							echo "alert('$msg');";
	if($redir=="back")			echo "history.back();";
	elseif($redir=="close")	echo "self.close();";
	elseif($redir=="reload")	echo "location.reload();";
	elseif($redir=="oreload")	echo "opener.location.reload();self.close();";
	elseif($redir)					echo "location.href='$redir';";
	echo "</script>";
	//exit;
}

## 리다이렉션2 #####################################################################################
function redir_proc2($msg=""){
	if($connect)		@mysql_close($connect);
	if($result)			@mysql_free_result($result);
	echo("<script>alert('$msg');</script>");
	exit;
}

## 리다이렉션3 #####################################################################################
function redir_proc3($redir,$msg=""){
	if($connect)		@mysql_close($connect);
	if($result)			@mysql_free_result($result);
	echo "<script>";
	if($msg)								echo "alert('$msg');";
	if($redir=="close")				echo "parent.window.close();";
	elseif($redir=="reload")		echo "parent.location.reload();";
	elseif($redir)						echo "parent.location.href='$redir';";
	echo "</script>";
	exit;
}


## 텍스트 박스에 문자열 Replace 함수 #############################################################
function check_box($str){
	if($str){
		$str = stripslashes($str);
		//$str = str_replace("&", "&amp;", $str);
		$str = str_replace("\"", "&#34;", $str);
		$str = str_replace("'", "&#39;", $str);
		return $str;
	}
}

## 문자 제한 ####################################################################
function han_cut($val,$cut_len){
        $tot_len = strlen($val);
        $cut_str = substr($val,0,$cut_len);
        $len = strlen($cut_str);

        for($i=0;$i < $len;$i++){
                if(ord($val[$i]) > 127) $hanlen++;
                else $englen++;
		}

        $cut_gap = $hanlen % 2;
        if($cut_gap == 1) $hanlen--;

        $length=$hanlen + $englen;
        if($tot_len > $length) return substr($val,0,$length)."...";
        else return substr($val,0,$length);
}


## 파일 저장(파일이름 그대로 사용) ###################################################################
function file_save($val, $val_name, $dir){
	// 디렉토리 생성
	mk_dir($dir);

	// 파일이름 변환
	$val_name = str_replace(" ", "_", $val_name);

	// 파일 확장자
	$ext = strtolower(substr($val_name, strrpos($val_name, ".")+1));
	if($ext=="php"||$ext=="php3"||$ext=="cgi"||$ext=="htm"||$ext=="html"||$ext=="js"){
		echo "<script>alert('등록이 불가능한 파일입니다.');history.back();</script>";
		exit;
	}

	// 같은 이름의 파일이 있으면 Rename
	$loop = true;
	$i = 1;
	while($loop){
		$attech_path = $dir . $new_name . $val_name;
		if(file_exists($attech_path)){
			$new_name = "[$i]";
		}else{
			$loop = false;
			$filename = $new_name . $val_name;
		}
		$i += 1;
	}


	copy($val, $attech_path);
	unlink($val);
	return $filename;
}

## 파일 저장(파일 이름 임의지정) ###################################################################
function file_save2($file, $file_name, $dir){
	// 디렉토리 생성
	mk_dir($dir);

	// 파일 확장자
	$f_name = time();
	$ext = strtolower(substr($file_name, strrpos($file_name, ".")+1));

	// 파일 확장자
	if($ext=="php"||$ext=="php3"||$ext=="cgi"||$ext=="htm"||$ext=="html"||$ext=="js"){
		echo "<script>alert('등록이 불가능한 파일입니다.');history.back();</script>";
		exit;
	}

	// 같은 이름의 파일이 있으면 Rename
	$loop = true;
	$i = 1;
	while($loop){
		$attech_path = $dir . $f_name . $new_name . "." . $ext;
		if(file_exists($attech_path)){
			$new_name = "_$i";
		}else{
			$loop = false;
			$filename = $f_name . $new_name . "." . $ext;
		}
		$i += 1;
	}


	copy($file, $attech_path);
	unlink($file);
	return $filename;
}


## 파일 저장(파일이름 강제 지정(uniqid) ###################################################################
function file_save3($file, $file_name, $dir){
	// 디렉토리 체크 생성
	mk_dir($dir);

	// 파일 확장자
	$ext = strtolower(substr($file_name, strrpos($file_name, ".")+1));
	// 파일 확장자
	if($ext=="php"||$ext=="php3"||$ext=="cgi"||$ext=="htm"||$ext=="html"||$ext=="js"){
		echo "<script>alert('등록이 불가능한 파일입니다.');history.back();</script>";
		exit;
	}

	$filename = uniqid("f_") . "." . $ext;
	$attech_path = $dir . $filename;

	copy($file, $attech_path);
	unlink($file);
	return $filename;
}

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


## 파일 저장(파일이름 그대로 사용하며 이미지파일만 등록가능하게) ###################################################################
function file_save4($val, $val_name, $dir){
	// 디렉토리 생성
	mk_dir($dir);

	// 파일이름 변환
	$val_name = str_replace(" ", "_", $val_name);

	// 파일 확장자
	$ext = strtolower(substr($val_name, strrpos($val_name, ".")+1));

	if($ext=="jpg"||$ext=="jpeg"||$ext=="gif"||$ext=="png"){
		// 같은 이름의 파일이 있으면 Rename
		$loop = true;
		$i = 1;
		while($loop){
			$attech_path = $dir . $new_name . $val_name;
			if(file_exists($attech_path)){
				$new_name = "[$i]";
			}else{
				$loop = false;
				$filename = $new_name . $val_name;
			}
			$i += 1;
		}


		copy($val, $attech_path);
		unlink($val);
		return $filename;
	}else{
		echo "<script>alert('등록이 불가능한 파일입니다.');history.back();</script>";
		exit;
	}
}

// swf,jpg만 가능하게
function file_save5($val, $val_name, $dir){
	$val_name = str_replace(" ", "_", $val_name);
	$ext = strtolower(substr($val_name, strrpos($val_name, ".")+1));

	if($ext=="swf"||$ext=="jpg"){
		// 같은 이름의 파일이 있으면 Rename
		$loop = true;
		$i = 1;
		while($loop){
			$attech_path = $dir . $new_name . $val_name;
			if(file_exists($attech_path)){
				$new_name = "[$i]";
			}else{
				$loop = false;
				$filename = $new_name . $val_name;
			}
			$i += 1;
		}

		copy($val, $attech_path);
		unlink($val);
		return $filename;
	}else{
		echo "<script>alert('등록이 불가능한 파일입니다.');history.back();</script>";
		exit;
	}

}



function file_save6($val, $val_name, $dir){
	$val_name = str_replace(" ", "_", $val_name);
	$ext = strtolower(substr($val_name, strrpos($val_name, ".")+1));

	if($ext=="csv"){
		// 같은 이름의 파일이 있으면 Rename
		$loop = true;
		$i = 1;
		while($loop){
			$attech_path = $dir . $new_name . $val_name;
			if(file_exists($attech_path)){
				$new_name = "[$i]";
			}else{
				$loop = false;
				$filename = $new_name . $val_name;
			}
			$i += 1;
		}

		copy($val, $attech_path);
		unlink($val);
		return $filename;
	}else{
		echo "<script>alert('등록이 불가능한 파일입니다.');</script>";
		exit;
	}
}

## 파일 삭제 #################################################################
function file_delete($file){
	if(file_exists($file)){
		unlink($file);
	}
}

## 디렉토리 생성 ##########################################
function mk_dir($dir){
	$dir_arr = explode("/", $dir);
	for($i=0; $i<sizeof($dir_arr); $i++){
		if(!eregi("^$", $dir_arr[$i]) || $i==0){
			$path .= $dir_arr[$i] . "/";
			//echo($path . "<br>");
			if(!is_dir($path)){
				mkdir($path, 0777);
			}
		}
	}
}

## 입력값이 숫자인지 아닌지를 판별하는 함수 : 숫자이면 1을 아니면 0을 리턴
function number_check($num){
$num = trim($num);
$aaa = strlen($num);
if($aaa == 0){
return 0;
break;
}
    for($i=0; $i<$aaa; $i++){
    $num_ex = substr($num,$i,1);
          if(!ereg("[0-9]",$num_ex)){
          //echo("$num_ex : 0<br>");
          return 0;
          break;
          }
    }
    return 1;

}


#######	 파일 확장자 추출하기		########################
function selectExtension($file) {
	if(!strCmp($file, "none")){
		$extension = "txt";
	}else{
		$file = explode(".", $file);
		$extension = strtolower($file[sizeof($file) -1]);
		$sample = array ("bmp", "cgi", "dir", "doc", "exe", "gif", "htm", "html", "hwp", "jpg", "jpeg", "js", "mid", "mp3", "mpeg", "php3", "php", "ppt", "ra", "rar", "swf", "txt", "wav", "xls", "zip","pdf");
		for($i=0;$i<sizeof($sample);$i++) {
			if(!strCmp($sample[$i], $extension))		break;
			else								$no++;
		}

		$extension = ($no==sizeof($sample)) ? "unknown" : $extension;
	}

	return $extension;
}


#######	 파일 사이즈	###################################
function selectFilesize($size) {
	$filesize = number_format($size / 1024, 1);
	return $filesize;
}


## GD를 이용한 이미지 저장
function make_img_set1($source, $filename, $size){
	$ext = strtolower(substr($source, strrpos($source,".")+1));
	if($ext == "jpg" || $ext == "jpeg"){
		$src = ImageCreateFromJPEG($source);
	}elseif($ext == "gif"){
		$src = ImageCreateFromGIF($source);
	}elseif($ext == "png"){
		$src = ImageCreateFromPNG($source);
	}

	//$src = ImageCreateFromJPEG($source);
	$sw = imagesx($src);
	$sh = imagesy($src);

	if(($sw > $size) || ($sh > $size)){
		if($sw >= $sh){
			$dw = $size;
			$dh = ceil($sh * ($size / $sw));
		}else{
			$dw = ceil($sw * ($size / $sh));
			$dh = $size;
		}
	}else{
		$dw = $sw;
		$dh = $sh;
	}

	$s_name=$filename;  // 저장될 경로 및 화일명
	$thumb = imagecreatetruecolor($dw, $dh);



	imagecopyresized($thumb, $src, 0, 0, 0, 0, $dw, $dh, $sw, $sh);
	//ImageJPEG($thumb,$s_name); // 저장될 경로및 화일명

	if($ext == "jpg" || $ext == "jpeg"){
		ImageJPEG($thumb,$s_name);
	}elseif($ext == "gif"){
		ImageGIF($thumb,$s_name);
	}elseif($ext == "png"){
		ImagePNG($thumb,$s_name);
	}

}


// 섬네일 이미지 이름 찾기
function find_thumb_name($name, $thumb){
	$fname = substr($name, 0, strrpos($name,"."));
	$ext = substr($name, strrpos($name,".")+1);
	$source = $save_path . $return_file;
	if($name){
		return $fname . $thumb . "." . $ext;
	}
}


## 확장자 체크
function check_ext($file){
	$arr_ext = array("php", "php4", "php3", "phtml", "phps", "phtml", "htm", "html");
	$ext = strtolower(substr($file,strrpos($file,".")+1));
	for($i=0; $i<sizeof($arr_ext); $i++){
		if($ext == $arr_ext[$i]){
			return false;
		}
	}
	return true;
}

function paging0($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir){
		$total_page = ceil($total_record/$num_per_page);
		if($total_page==0){
			$total_page = 1;
		}

		$page_i = ( ( (int)( ($page - 1 ) / $page_per_block ) ) * $page_per_block ) + 1;
		$end_page = $page_i + $page_per_block - 1;

		// 10 페이지
		if($page > $page_per_block){
			echo("<a href='" . $link . "&page=" . ($page-$page_per_block) . "'>" . (($img_dir)?"<img src='${img_dir}prev10.gif' border=0 align=absmiddle>":"◀◀") . "</a>&nbsp;");
		}else{
			echo((($img_dir)?"<img src='${img_dir}prev10.gif' style=filter:alpha(opacity:30); border=0 align=absmiddle>":"<font color=#eeeeee>◀◀</font>"));
		}
		echo("&nbsp;&nbsp;&nbsp;");


		if($page > 1){
			echo("<a href='" . $link . "&page=" . ($page-1) . "'>" . (($img_dir)?"<img src='${img_dir}prev.gif' border=0 align=absmiddle>":"◀") . "</a>&nbsp;");
		}else{
			echo((($img_dir)?"<img src='${img_dir}prev.gif' style=filter:alpha(opacity:30); border=0 align=absmiddle>":"<font color=#eeeeee>◀</font>"));
		}
		echo("&nbsp;&nbsp;");


		for($i=$page_i; $i<=$end_page; $i++){
			if($i <= $total_page){
				if($i == $page){
					echo("&nbsp;&nbsp;<b style=color:red;>$i</b>&nbsp;&nbsp;");
				}else{
					echo("&nbsp;&nbsp;<a href='" . $link . "&page=" . $i . "'>$i</a>&nbsp;&nbsp;");
				}
			}else{
				//echo("&nbsp;&nbsp;<font color=#cccccc>$i</font>&nbsp;&nbsp;");
			}
		}
		echo("&nbsp;&nbsp;");
		if($page >= $total_page){
			echo((($img_dir)?"<img src='${img_dir}next.gif' style=filter:alpha(opacity:30); border=0 align=absmiddle>":"<font color=#eeeeee>▶</font>"));
		}else{
			echo("<a href='" . $link . "&page=" . ($page+1) . "'>" . (($img_dir)?"<img src='${img_dir}next.gif' border=0 align=absmiddle>":"▶") . "</a>&nbsp;");
		}


		echo("&nbsp;&nbsp;&nbsp;");
		// 10 페이지
		if($total_page > ($page + $page_per_block)){
			echo("<a href='" . $link . "&page=" . ($page+$page_per_block) . "'>" . (($img_dir)?"<img src='${img_dir}next10.gif' border=0 align=absmiddle>":"▶▶") . "</a>&nbsp;");
		}else{
			echo((($img_dir)?"<img src='${img_dir}next10.gif' style=filter:alpha(opacity:30); border=0 align=absmiddle>":"<font color=#eeeeee>▶▶</font>"));
		}
}


function paging1($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir){
	$total_page = ceil($total_record/$num_per_page);
	if($total_page==0){
		$total_page = 1;
	}

	$page_i = ( ( (int)( ($page - 1 ) / $page_per_block ) ) * $page_per_block ) + 1;
	$end_page = $page_i + $page_per_block - 1;

	if($page > $page_per_block){
		echo "<span class=\"p_btn_first\"><a href=\"" . $link . "&page=" . ($page-$page_per_block)."\">&lt;&nbsp;이전</a></span>";
	}else{
		if($page > 1){
			echo "<span class=\"p_btn_first\"><a href=\"" . $link . "&page=" . ($page-1)."\">&lt;&nbsp;이전</a></span>";
		}else{
			echo "<span class=\"p_btn_first\"><a href=\"#\">&lt;&nbsp;이전</a></span>";
		}

	}

	echo "<span class=\"page_num\">";

	for($i=$page_i; $i<=$end_page; $i++){
		if($i <= $total_page){
			if($i == $page){
				echo "<strong>".$i."</strong>";
			}else{
				echo "<a href=\"" . $link . "&page=" . $i."\">$i</a>";
			}
		}
	}

	echo "</span>";

	if($total_page > ($page + $page_per_block)){
		echo "<span class=\"p_btn_last\"><a href=\"" . $link . "&page=" . ($page+$page_per_block)."\">다음&nbsp;&gt;</a></span>";
	}else{
		if($page >= $total_page){
			echo "<span class=\"p_btn_last\"><a href=\"#\">다음&nbsp;&gt;</a></span>";
		}else{
			echo "<span class=\"p_btn_last\"><a href=\"" . $link . "&page=" . ($page+1)."\">다음&nbsp;&gt;</a></span>";
		}
	}
}


function Ajax_paging($link, $total_record, $num_per_page, $page_per_block, $page, $img_dir){
	$total_page = ceil($total_record/$num_per_page);
	if($total_page==0){
		$total_page = 1;
	}

	$page_i = ( ( (int)( ($page - 1 ) / $page_per_block ) ) * $page_per_block ) + 1;
	$end_page = $page_i + $page_per_block - 1;

	if($page > $page_per_block){
		echo "<span class=\"p_btn_first\"><a href=\"javascript:;\" onclick=\"Page_Go('".$link."&page=',".($page-$page_per_block).");\">&lt;&nbsp;이전</a></span>";
	}else{
		if($page > 1){
			echo "<span class=\"p_btn_first\"><a href=\"javascript:;\" onclick=\"Page_Go('".$link."&page='," . ($page-1).");\">&lt;&nbsp;이전</a></span>";
		}else{
			echo "<span class=\"p_btn_first\"><a href=\"#\">&lt;&nbsp;이전</a></span>";
		}

	}

	echo "<span class=\"page_num\">";

	for($i=$page_i; $i<=$end_page; $i++){
		if($i <= $total_page){
			if($i == $page){
				echo "<strong>".$i."</strong>";
			}else{
				echo "<a href=\"javascript:;\" onclick=\"Page_Go('".$link."&page=',".$i.");\">$i</a>";
			}
		}
	}

	echo "</span>";

	if($total_page > ($page + $page_per_block)){
		echo "<span class=\"p_btn_last\"><a href=\"javascript:;\" onclick=\"Page_Go('".$link."&page='," . ($page+$page_per_block).");\">다음&nbsp;&gt;</a></span>";
	}else{
		if($page >= $total_page){
			echo "<span class=\"p_btn_last\"><a href=\"#\">다음&nbsp;&gt;</a></span>";
		}else{
			echo "<span class=\"p_btn_last\"><a href=\"javascript:;\" onclick=\"Page_Go('".$link."&page='," . ($page+1).");\">다음&nbsp;&gt;</a></span>";
		}
	}
}

## 입력값에 한글이 존재하는지 체크 #################
function is_hangul2($char){
	if(preg_match("/[\xA1-\xFE][\xA1-\xFE]/", $char)){
		 return true;
	}else{
		 return false;
	}
}

function is_hangul($char) {
	$char = ord($char);

	if($char >= 0xa1 && $char <= 0xfe)
	return 1;
}

// 기본 메일 보내기
function basic_sendmail($to_email,$from_email,$subject,$content) {

  $header .= "From: $from_email \n";
  //$header .= "X-Sender: <$from_email>\n";
  //$header .= "X-Mailer: PHP ".phpversion()."\n";
  $header .= "X-Priority: 1\n";
  //$header .= "Return-Path: <$from_email>\n";
  $header .= "Content-Type: text/html;";
  $header .= "charset=utf-8\n";
  $content = stripslashes($content);

  @mail($to_email,$subject,$content,$header);
}

// 메일 보내기 직접
function nmail($to_email, $from_email, $subject, $content) {
  $header .= "From: $from_email \n";
   //$header .= "X-Sender: <$from_email>\n";
   //$header .= "X-Mailer: PHP ".phpversion()."\n";
   $header .= "X-Priority: 1\n";
   //$header .= "Return-Path: <$from_email>\n";
   $header .= "Content-Type: text/html; charset=utf-8\n";
   $header .= "\n\n";

   $content = stripslashes($content);

   @$fp = popen('/usr/sbin/sendmail -t -f '.$from_email.' '.$to_email,"w");
   if(!$fp) return 0;
   fputs($fp,"From:${from_email}\n");
   //fputs($fp, "To: $to_email\n");
   fputs($fp, "Subject: ".$subject."\n");
   fputs($fp, $header."\n");
   fputs($fp, $content);
   fputs($fp, "\n\n\n");
   pclose($fp);
   return 1;
}


// gd 이미지 생성
// $img_name = 생성에 사용될 원본 파일명, $width = 생성이미지 가로크기, $height = 생성이미지 세로크기, $save_name = 저장될 파일명
function put_gdimage($img_name, $width, $height, $save_name,$table,$category=""){
	global $DOCUMENT_ROOT;
	// GD 버젼체크
	$gd = gd_info();
	$gdver = substr(preg_replace("/[^0-9]/", "", $gd['GD Version']), 0, 1);
	if(!$gdver) return "GD 버젼체크 실패거나 GD 버젼이 1 미만입니다.";

	if($category)			$savedir = $DOCUMENT_ROOT."/DATAS/$table/$category/";
	else						$savedir = $DOCUMENT_ROOT."/DATAS/$table/";

	$srcname = $savedir.$img_name;

	$timg = getimagesize($srcname);
	if($timg[2] != 1 && $timg[2] != 2 && $timg[2] != 3) return "확장자가 jp(e)g/png/gif 가 아닙니다.";

	// jpg, jpeg
	if($timg[2] == 2){

	$cfile = imagecreatefromjpeg($srcname);
	// gd 버전별로
	if($gdver == 2){
		$dest = imagecreatetruecolor($width, $height);
		imagecopyresampled($dest, $cfile, 0, 0, 0, 0, $width, $height, $timg[0], $timg[1]);
	}else{
		$dest = imagecreate($width, $height);
		imagecopyresized($dest, $cfile, 0, 0, 0, 0, $width, $height, $timg[0], $timg[1]);
	}
	imagejpeg($dest, $savedir.$save_name, 90);

	// png
	}else if($timg[2] == 3){

	$cfile = imagecreatefrompng($srcname);
	if($gdver == 2){
		$dest = imagecreatetruecolor($width, $height);
		imagecopyresampled($dest, $cfile, 0, 0, 0, 0, $width, $height, $timg[0], $timg[1]);
	}else{
		$dest = imagecreate($width, $height);
		imagecopyresized($dest, $cfile, 0, 0, 0, 0, $width, $height, $timg[0], $timg[1]);
	}
	imagepng($dest, $savedir.$save_name, 90);

	// gif
	}else if($timg[2] == 1){

	$cfile = imagecreatefromgif($srcname);
	if($gdver == 2){
		$dest = imagecreatetruecolor($width, $height);
		imagecopyresampled($dest, $cfile, 0, 0, 0, 0, $width, $height, $timg[0], $timg[1]);
	}else{
		$dest = imagecreate($width, $height);
		imagecopyresized($dest, $cfile, 0, 0, 0, 0, $width, $height, $timg[0], $timg[1]);
	}
	imagegif($dest, $savedir.$save_name, 90);
	}

	// 메모리에 있는 그림 삭제
	imagedestroy($dest);
	return 1;
}



// 워터마크 ///////////////////////////////////////////////////////////////
function LoadImage($fName, $string) {
	$file_ext = strtolower(substr(strrchr($fName,"."), 1)); //확장자
	switch ($file_ext) {
	case "jpg": case "jpeg":
	$im = ImageCreateFromJPEG($fName);
	break;
	case "gif":
	$im = ImageCreateFromGIF($fName);
	break;
	case "png":
	$im = ImageCreateFromPNG($fName);
	break;
	}

	if (!$im) {
		$px = 7.5 * strlen($string);
		$im = ImageCreatetruecolor($px, 12);
		$bgc = ImageColorAllocate($im, 255, 255, 255);
		$tc = ImageColorAllocate($im, 0, 0, 0);

		ImageColorTransparent($im, $bgc);
		ImageString($im,3,0,0,$string,$tc);
	}
	return $im;
}


function addLogo($file, $fileTo){
	Global $itemImgLogo;

	$src_im = ImageCreateFromJPEG($file);
	$im = LoadImage($itemImgLogo["img"], $itemImgLogo["string"]);

	//$offsetX = ImageSX($src_im) - ImageSX($im) - 3;
	$offsetX = 0;
	$offsetY = ImageSY($src_im) - ImageSY($im) - 3;

	ImageCopyMerge($src_im,$im,$offsetX,$offsetY,0,0,ImageSX($im),ImageSY($im), $itemImgLogo["opacity"]);
	// ImageCopyResized($dst_im,$im,$offsetX,$offsetY,0,0,ImageSX($im),ImageSY($im),ImageSX($im),ImageSY($im)); //만들기

	return ImageJPEG($src_im, $fileTo, $itemImgLogo["quality"]);
}
/////////////////////////////////////////////////////////////////


// 악성태그 변환
function bad_tag_convert($code){
	$code = mysql_real_escape_string(trim($code));
    return preg_replace("/\<([\/]?)(script|iframe)([^\>]*)\>/i", "&lt;$1$2$3&gt;", $code);
}

function bad_tag_convert2($code){
	$code = mysql_real_escape_string(htmlspecialchars(trim($code)));
    return preg_replace("/\<([\/]?)(script|iframe)([^\>]*)\>/i", "&lt;$1$2$3&gt;", $code);
}


function select_query($boards,$felds,$where){
//		echo("SELECT $felds FROM $boards $where"."<br>");
		$result = mysql_query("SELECT $felds FROM $boards $where");
	if(!$result){
		echo "쿼리에러<br>SELECT $felds FROM $boards $where";
		exit;
	}
	return $result;
}

function insert_query($boards,$felds,$values){

	$result =  mysql_query("insert into $boards($felds) values($values)")  or die("insert into $boards($felds) values($values)");
	if(!$result){
		echo "쿼리에러<br>insert into $boards($felds) values($values)";
		exit;
	}
	return $result;
}

function update_query($boards,$values,$where){
	$result = mysql_query("update $boards set $values $where");
	if(!$result){
		echo "쿼리에러<br>update $boards set $values $where";
		exit;
	}
	return $result;
}

function delete_query($boards,$where){
	$result =  mysql_query("delete from $boards $where");
	if(!$result){
		echo "쿼리에러<br>delete from $boards $where";
		exit;
	}
	return $result;
}




function uploads($upload1_name,$upload1,$num,$save_path,$delfile="",$thumb=""){
	if($delfile!=""){
		$file = $save_path."/".$delfile;
		if(file_exists($file)) unlink($file);

		//이미지파일의 경우 생성된 썸네일삭제
		if(eregi("gif",strtolower($delfile))||eregi("jpg",strtolower($delfile))||eregi("png",strtolower($delfile))){
			$file = $save_path."/t_".$delfile;
			@unlink($file);
		}
	}

	if($upload1_name !="") {

		$filename = explode(".",$upload1_name);
		$extension = $filename[sizeof($filename)-1];

		if($upload1_size>4194304){
			echo("<script>alert('4Mb이상의 파일은 업로드가 불가능합니다.');history.back;</script>");
			exit;
		}

		if(eregi("^(php|js|php|bmp|php3|php4|html|htm|cgi)$",strtolower($extension))){
			echo "<script>alert('업로드가 불가능한 파일입니다.');history.back();</script>";
			exit;
		}

		//중복되는파일처리
		$upload1_name = $filename[0];
		$dup_file = $save_path."/".$upload1_name.".".$extension;
		$file = $save_path."/".$upload1_name;
		$exist = file_exists($dup_file);    //파일있는지 검사
		$unq_name = $upload1_name;

		$i = 0;
		while ($exist)         //파일이 있는동안 루프,파일이 존재하지 않으면 빠져나온다
		{
			$dup_file = $file."(".$i.").".$extension;
			$unq_name = $upload1_name."(".$i.")";
			$exist = file_exists($dup_file);    //이름변경후 같은이름 파일있는지 다시 검사 있으면 없을때까지ㅎ_ㅎ
			$i++;
		}

		//중복되는파일처리끝
		$upload1_name = $unq_name.".".$extension;
		$dest = $save_path . "/" . $upload1_name;

		if(!copy($upload1,$dest)){
			echo("<script>alert('파일을 지정한디렉토리에 복사하는데 실패했습니다.');history.back;</script>");
			exit;
		}

		//이미지파일의 경우썸네일 생성
		if(!empty($thumb)){
			if(eregi("^(gif|jpg|jpeg|png)$",strtolower($extension))){
				thumbNeil($save_path."/".$upload1_name,$save_path,$thumb);
			}
		}


		if(!unlink($upload1)){
			echo("임시파일을 삭제하는데 실패했습니다.");
			exit;
		}
	}
	return $upload1_name;
}

########################## 썸네일 처리 함수 ################################
function thumbNeil($file_name,$save_path,$size) {
	$gd = gd_info();
	$gdver = substr(preg_replace("/[^0-9]/", "", $gd['GD Version']), 0, 1);
	if(!$gdver) return "GD 버젼체크 실패거나 GD 버젼이 1 미만입니다.";

	$picsize=getimagesize($file_name);
    $t_name  = explode('/',$file_name);
    $Thump_name = "t_".$t_name[sizeof($t_name)-1];
	$standard = ($picsize[0] > $picsize[1]) ?   $picsize[0] : $picsize[1];
    $rate = (100 * $size) / $standard;
    $width = floor($picsize[0] * ($rate / 100));
    $height = floor($picsize[1] * ($rate / 100));
    // 썸네일 생성
    if($picsize[2] == '1') {
	    $image = ImageCreateFromGIF($file_name);
		if($gdver == 2){
			$thumb_image = ImageCreateTrueColor($width,$height);
			imagecopyresampled($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image));
		}else{
			$thumb_image = imagecreate($width,$height);
			ImageCopyResized($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image));
		}
        $thumbneil = $save_path."/".$Thump_name;
        ImageJPEG($thumb_image,$thumbneil,90);
    }else if($picsize[2] =='2') {
        $image = ImageCreateFromJPEG($file_name);
		if($gdver == 2){
			$thumb_image = ImageCreateTrueColor($width,$height);
			imagecopyresampled($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image));
		}else{
			$thumb_image = imagecreate($width,$height);
			ImageCopyResized($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image));
		}
        $thumbneil = $save_path."/".$Thump_name;
        ImageJPEG($thumb_image,$thumbneil,90);
    }else if($picsize[2] =='3') {
        $image = ImageCreateFromPNG($file_name);
		if($gdver == 2){
			$thumb_image = ImageCreateTrueColor($width,$height);
			imagecopyresampled($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image));
		}else{
			$thumb_image = imagecreate($width,$height);
			ImageCopyResized($thumb_image,$image,0,0,0,0,$width+1,$height+1,ImageSX($image),ImageSY($image));
		}
        $thumbneil = $save_path."/".$Thump_name;
        ImageJPEG($thumb_image,$thumbneil,90);
    }
}


############################파일삭제##############################
function delfile($delfile,$save_path){
if ($delfile!=""){
	$file = $save_path."/".$delfile;
	if(file_exists($file)) unlink($file);

	//이미지파일의 경우 생성된 썸네일삭제
		if(eregi("gif",strtolower($delfile))||eregi("jpg",strtolower($delfile))||eregi("png",strtolower($delfile))){
			$file = $save_path."/t_".$delfile;
			if(file_exists($file)) unlink($file);
		}

}
return "";
}


########################## 문자열자르기 ################################
function getLeft($str, $len, $tail="")
{
if(strlen($str)<=$len) return $str;
$len-=strlen($tail);
$tmp=substr($str, 0, $len);
if(countHangulByte($tmp)%2==1)
{
$tmp=substr($tmp, 0, -1);
$tmp.=" ";
}
$tmp.=$tail;
return $tmp;
}

function countHangulByte($str)
{
$count=0;
for($i=0; $i<strlen($str); $i++)
{
if(ord(substr($str, $i, 1))>=0x80)
$count++;
}
return $count;
}


function save_point($point_set,$price,$p_percent,$p_point){
	switch($point_set){
		case "0":
			$point = 0;
		break;
		case "1":
			$point = (int)($price*$p_percent/100);
		break;
		case "2":
			$point = $p_point;
		break;
		default:
			$point = "error";
		break;
	}
	return $point;
}

function print_select_field($field_name){
	global $$field_name, $select_text, $select_value;

	$select_text_count = count($select_text);
	$select_value_count = count($select_value);
	if($select_text_count <> $select_value_count){
		$msg = "select 의 text 와 value 값의 count 가 맞지 않습니다.\\n\\n필드 : $field_name\\n
		text => $select_text_count\\n
		value => $select_value_count";
		alert_popup_msg($msg,1);
		exit;
	}

echo"
<SELECT name=$field_name >\n
  <OPTION value=\"\">선택</OPTION>
";

	for($i=0; $i < $select_value_count; $i++){

		if($$field_name == $select_value[$i]){
			$sel_check = "selected";
		}
		else{
			$sel_check = "";
		}

echo"
  <OPTION value=\"$select_value[$i]\" $sel_check>$select_text[$i]</OPTION>\r\n
";

	}//for

echo"
</select>
";


}


// 마지막 일 구하기
function end_day($year,$month){
	for($i=28;$i<=32;$i++){
		if(!checkdate($month,$i,$year)){
			return $i-1;
			break;
		}
	}
}

// 년도 구하기
function conv_year($switch) {
	global $nyear, $nmonth;
	$c_year = $nyear;
	if($switch=="prev") $c_year--;
	else if($switch=="next") $c_year++;
	echo '?nyear='.$c_year.'&nmonth='.sprintf("%02d",$nmonth);
}

// 월 구하기
function conv_month($switch) {
	global $nyear, $nmonth;
	$c_year = $nyear;
	$c_month = $nmonth;
	if($switch=="prev"){
		if($nmonth <= 1){
			$c_year--;
			$c_month=12;
		}else{
			$c_month--;
		}
	}else if($switch=="next"){
		if($nmonth >= 12){
			$c_year++; $c_month=1;
		}else{
			$c_month++;
		}
	}else{
		$c_year=date('Y',time());
		$c_month=date('m',time());
	}
	echo '?nyear='.$c_year.'&nmonth='.sprintf("%02d",$c_month);
}

// 일 구하기
function conv_day($switch) {
	global $nyear, $nmonth, $nday;
	$c_year = $nyear;
	$c_month = $nmonth;
	$c_day = $nday;

	if($switch=="prev") {
		if($c_day <= 1 ) {
			if($nmonth <= 1){
				$c_year--; $c_month=12;
			}else{
				$c_month--;
			}
			$c_day = end_day($c_year,$c_month);
		}else{
			$c_day--;
		}
	}else if($switch=="next") {
		if($c_day >= end_day($nyear,$c_month)){
			if($nmonth >= 12){
				$c_year++; $c_month=1;
			}else{
				$c_month++;
			}
			$c_day=1;
		}else{
			$c_day++;
		}
	}else{
		$c_year=date('Y',time());
		$c_month=date('m',time());
		$c_day=date('d',time());
	}
	echo '?nyear='.$c_year.'&nmonth='.sprintf("%02d",$c_month).'&nday='.sprintf("%02d",$c_day);
}




function user_point($mem_id){
	$result = mysql_query("select point,state from es_point where mem_id='$mem_id'");
	while($data2=mysql_fetch_array($result)){
		if($data2[1]=="+"){
			$mem_point += $data2[0];
		}else if($data2[1]=="-"){
			$mem_point -= $data2[0];
		}
	}
	if(!$mem_point) $mem_point = 0;
	mysql_free_result($result);
	return $mem_point;
}


function flush2 (){
    echo(str_repeat(' ',256));
    // check that buffer is actually set before flushing
    if (ob_get_length()){
        @ob_flush();
        @flush();
        @ob_end_flush();
    }
    @ob_start();
}

function sql_password($value){
    // mysql 4.0x 이하 버전에서는 password() 함수의 결과가 16bytes
    // mysql 4.1x 이상 버전에서는 password() 함수의 결과가 41bytes
    $result = mysql_query(" select password('$value') as pass ");
	$row = mysql_fetch_array($result);
    return $row[pass];
}


/*
$file 원본파일
$save_file 저장될 파일
$img_size 는 배열로 받아온다.
$img_size[0],$img_size[1] 은 가로가 큰 이미지일때의 고정 시킬 width, height
$img_size[2],$img_size[3] 은 세로가 큰 이미지일때의 고정 시킬 width, height
$outlinecolor 는 배열로 받아온다.
$outlinecolor[0] = Red
$outlinecolor[1] = Green
$outlinecolor[2] = Blue
*/
function thumbnail2($file, $save_file, $img_size, $outlinecolor){
$img_info = getImageSize($file);
if($img_info[2] == 1){ $src_img = ImageCreateFromGif($file);
}elseif($img_info[2] == 2){ $src_img = ImageCreateFromJPEG($file);
}elseif($img_info[2] == 3){ $src_img = ImageCreateFromPNG($file);
}else{ return 0; }
$img_width = $img_info[0];
$img_height = $img_info[1];

if($img_width > $img_height){ #가로가 큰 이미지
$max_width=$img_size[0]; $max_height=$img_size[1];
$dst_width = $max_width;
$dst_height = ceil(($max_width / $img_width) * $img_height);
if($dst_height > $max_height) $dst_height = $max_height;

} elseif($img_width < $img_height) { # 세로가 큰 이미지
$max_width=$img_size[2]; $max_height=$img_size[3];

$dst_height = $max_height;
$dst_width = ceil(($max_height / $img_height) * $img_width);
if($dst_width > $max_width) $dst_width = $max_width;

} else { # 정사각형 이미지
$max_width=$img_size[0]; $max_height=$img_size[1];
$dst_width = $max_height;
$dst_height = $max_height;
}

# 여백과 라인을 위해 상하좌우 각각 4픽셀씩 줄인다.
$dst_width-=0;
$dst_height-=0;

if($img_info[2] == 1){ $dst_img = imagecreate($max_width, $max_height);
}else{ $dst_img = imagecreatetruecolor($max_width, $max_height); }

# 입력한 색상으로 전체 이미지를 칠한다.
$bgc = ImageColorAllocate($dst_img, $outlinecolor[0], $outlinecolor[1], $outlinecolor[2]);
ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc);
# 백색으로 외관 1픽셀을 제외하고 칠한다.
$bgc = ImageColorAllocate($dst_img, 255, 255, 255);
ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc);

if($dst_width < $max_width) $srcx = ceil(($max_width - $dst_width)/2); else $srcx = 0;
    if($dst_height < $max_height) $srcy = ceil(($max_height - $dst_height)/2); else $srcy = 0;

ImageCopyResampled($dst_img, $src_img, $srcx, $srcy, 0, 0, $dst_width, $dst_height, ImageSX($src_img),ImageSY($src_img));

if($img_info[2] == 1)
{
ImageInterlace($dst_img);
ImageGIF($dst_img, $save_file);
}elseif($img_info[2] == 2){
ImageInterlace($dst_img);
ImageJPEG($dst_img, $save_file,90);
}elseif($img_info[2] == 3){
ImagePNG($dst_img, $save_file);
}
ImageDestroy($dst_img);
ImageDestroy($src_img);
}



// way.co.kr 의 wayboard 참고
function url_auto_link($str){
    // 속도 향상 031011
    $str = preg_replace("/&lt;/", "\t_lt_\t", $str);
    $str = preg_replace("/&gt;/", "\t_gt_\t", $str);
    $str = preg_replace("/&amp;/", "&", $str);
    $str = preg_replace("/&quot;/", "\"", $str);
    $str = preg_replace("/&nbsp;/", "\t_nbsp_\t", $str);
    $str = preg_replace("/([^(http:\/\/)]|\(|^)(www\.[^[:space:]]+)/i", "\\1<A HREF=\"http://\\2\" TARGET='_blank'>\\2</A>", $str);
    //$str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'>\\2</A>", $str);
    // 100825 : () 추가
    // 120315 : CHARSET 에 따라 링크시 글자 잘림 현상이 있어 수정
    if (strtoupper($g4['charset']) == 'UTF-8') {
        $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[가-힣\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'>\\2</A>", $str);
    } else {
        $str = preg_replace("/([^(HREF=\"?'?)|(SRC=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i", "\\1<A HREF=\"\\2\" TARGET='_blank'>\\2</A>", $str);
    }
    // 이메일 정규표현식 수정 061004
    //$str = preg_replace("/(([a-z0-9_]|\-|\.)+@([^[:space:]]*)([[:alnum:]-]))/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/([0-9a-z]([-_\.]?[0-9a-z])*@[0-9a-z]([-_\.]?[0-9a-z])*\.[a-z]{2,4})/i", "<a href='mailto:\\1'>\\1</a>", $str);
    $str = preg_replace("/\t_nbsp_\t/", "&nbsp;" , $str);
    $str = preg_replace("/\t_lt_\t/", "&lt;", $str);
    $str = preg_replace("/\t_gt_\t/", "&gt;", $str);

    return $str;
}



// OBJECT 태그의 XSS 막기
function bad120422($matches)
{
    $tag  = $matches[1];
    $code = $matches[2];
    if (preg_match("#\bscript\b#i", $code)) {
        return "$tag 태그에 스크립트는 사용 불가합니다.";
    } else if (preg_match("#\bbase64\b#i", $code)) {
        return "$tag 태그에 BASE64는 사용 불가합니다.";
    }
    return $matches[0];
}

function bad130128($matches)
{
    $str = $matches[2];
    return '<'.$matches[1].preg_replace('#(\/\*|\*\/)#', '', $str).'>';
}

// 내용을 변환(그누보드)
function conv_content($content){
        $source = array();
        $target = array();

        $source[] = "//";
        $target[] = "";

        // 테이블 태그의 갯수를 세어 테이블이 깨지지 않도록 한다.
        $table_begin_count = substr_count(strtolower($content), "<table");
        $table_end_count = substr_count(strtolower($content), "</table");
        for ($i=$table_end_count; $i<$table_begin_count; $i++)
        {
            $content .= "</table>";
        }

        $content = preg_replace_callback("/<([^>]+)>/s", 'bad130128', $content);

        $content = preg_replace($source, $target, $content);

        // XSS (Cross Site Script) 막기
        // 완벽한 XSS 방지는 없다.

        // 이런 경우를 방지함 <IMG STYLE="xss:expr/*XSS*/ession(alert('XSS'))">
        //$content = preg_replace("#\/\*.*\*\/#iU", "", $content);
        // 위의 정규식이 아래와 같은 내용을 통과시키므로 not greedy(비탐욕수량자?) 옵션을 제거함. ignore case 옵션도 필요 없으므로 제거
        // <IMG STYLE="xss:ex//*XSS*/**/pression(alert('XSS'))"></IMG>
        $content = preg_replace("#\/\*.*\*\/#", "", $content);

        // object, embed 태그에서 javascript 코드 막기
        $content = preg_replace_callback("#<(object|embed)([^>]+)>#i", "bad120422", $content);

        $content = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $content);
        $content = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $content);
        $content = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $content);
        //$content = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $content);
        $content = preg_replace_callback("#<([^>]+)#", create_function('$m', 'return "<".str_replace("<", "&lt;", $m[1]);'), $content);
        //$content = preg_replace("/\<(\w|\s|\?)*(xml)/i", "", $content);
        $content = preg_replace("/\<(\w|\s|\?)*(xml)/i", "_$1$2_", $content);

        // 플래시의 액션스크립트와 자바스크립트의 연동을 차단하여 악의적인 사이트로의 이동을 막는다.
        // value="always" 를 value="never" 로, allowScriptaccess="always" 를 allowScriptaccess="never" 로 변환하는데 목적이 있다.
        //$content = preg_replace("/((?<=\<param|\<embed)[^>]+)(\s*=\s*[\'\"]?)always([\'\"]?)([^>]+(?=\>))/i", "$1$2never$3$4", $content);
        // allowscript 속성의 param 태그를 삭제한다.
        //$content = preg_replace("#(<param.*?allowscript[^>]+>)(<\/param>)?#i", "", $content);
        // embed 태그의 allowscript 속성을 삭제한다.
        $content = preg_replace("#(<embed.*?)(allowscriptaccess[^\s\>]+)#i", "$1", $content);
        // object 태그에 allowscript 의 값을 never 로 하여 태그를 추가한다.
        $content = preg_replace("#(<object[^>]+>)#i", "$1<param name=\"allowscriptaccess\" value=\"never\">", $content);
        // embed 태그에 allowscrpt 값을 never 로 하여 속성을 추가한다.
        $content = preg_replace("#(<embed[^>]+)#i", "$1 allowscriptaccess=\"never\"", $content);

        // 이미지 태그의 src 속성에 삭제등의 링크가 있는 경우 게시물을 확인하는 것만으로도 데이터의 위변조가 가능하므로 이것을 막음
        $content = preg_replace("/<(img[^>]+download\.php[^>]+bo_table[^>]+)/i", "*** CSRF 감지 : &lt;$1", $content);

        $content = preg_replace_callback("#style\s*=\s*[\"\']?[^\"\']+[\"\']?#i",
                    create_function('$matches', 'return str_replace("\\\\", "", stripslashes($matches[0]));'), $content);

        $pattern = "";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(x|&#(x78|120);?)";
        $pattern .= "(p|&#(x70|112);?)";
        $pattern .= "(r|&#(x72|114);?)";
        $pattern .= "(e|&#(x65|101);?)";
        $pattern .= "(s|&#(x73|115);?)";
        $pattern .= "(s|&#(x73|115);?)";
        //$pattern .= "(i|&#(x6a|105);?)";
        $pattern .= "(i|&#(x69|105);?)";
        $pattern .= "(o|&#(x6f|111);?)";
        $pattern .= "(n|&#(x6e|110);?)";
        //$content = preg_replace("/".$pattern."/i", "__EXPRESSION__", $content);
        $content = preg_replace("/<[^>]*".$pattern."/i", "__EXPRESSION__", $content);
        // <IMG STYLE="xss:e\xpression(alert('XSS'))"></IMG> 와 같은 코드에 취약점이 있어 수정함. 121213
        $content = preg_replace("/(?<=style)(\s*=\s*[\"\']?xss\:)/i", '="__XSS__', $content);
        $content = bad_tag_convert($content);


    return $content;
}

function calendar_schedul($nyear,$nmonth,$table="es_schedules"){
	global $result, $nyear, $nmonth ;
	$connect = dbcon();
	$n_day = $nyear."-".$nmonth;
	$whereQuery = "where wdate like '$n_day%'";
	$query = "select wdate, count(*) num, subject from $table $whereQuery group by wdate";
	$result = mysql_query($query);
	return $result;

}

function my_fsockopen($host,$fpost,$fullpath){
 //fsockopen을 이용하여 데이터 가져옴
 $fp = fsockopen($host,$fpost,$errno,$errstr,30);
 if(!$fp){
  $fullline = "$errstr ($errno)<br>\n";
 }else{
  // GET, POST 방식에 따라 헤더를 다르게 구성한다.
  $query = "GET ".$fullpath." HTTP/1.0\r\n";
  $query .= "HOST:".$host.":".$fpost."\r\n";
  $query .= "\r\n";

  $dom = fputs($fp,$query);
  $_header = "";
  while(trim($buffer = fgets($fp,1024)) != "") {   //헤더구하기
   $_header .= $buffer;
  }
  while(!feof($fp)) {            //바디구하기
   $fullline .= fgets($fp,1024);
  }
  fclose($fp);
 }
 return $fullline;
}



function addParamRule($obj,$rule){
	$chk = 1;
	$obj = trim($obj);

	if($obj){
		if(preg_match("/kr/",trim($rule))){
			if(preg_match("/[\xA1-\xFE\xA1-\xFE]/",$obj))		$chk = 0;
		}
		if(preg_match("/en/",trim($rule))){
			if(preg_match("/[a-zA-Z]/",$obj))		$chk = 0;
		}
		if(preg_match("/int/",trim($rule))){
			if(preg_match("/[0-9]/",$obj))		$chk = 0;
		}
		if(preg_match("/special/",trim($rule))){
			if(preg_match("/['\"!#$%^&*()?<>+;\-\=\/]/",$obj))		$chk = 0;
		}

		if($chk!=1){
			$obj = str_replace("<script>","",$obj);
			$obj = str_replace("</script>","",$obj);

			echo "<script>alert('".$obj." 값에 금지된 문자가 포함되어 있습니다');parent.location.href='/';</script>";
			exit;
		}
	}
}

function str_count($str){
	$length = mb_strwidth($str,"utf-8");

	return $length;
}


function geocode($address) {
	global $address, $n_client_id, $n_client_secret;

	$address = urlencode($address);

	$ch = curl_init();

	$encoding = "utf-8";
	$coord = "latlng"; //출력 좌표 체계 값으로 latlng(위경도), tm128(카텍) 가능
	$output = "json" ;//json,xml

	$qry_str = "?encoding=".$encoding."&coord=".$coord."&output=".$output."&query=".$address;

	$headers = array(
	"X-Naver-Client-Id: $n_client_id",
	"X-Naver-Client-Secret: $n_client_secret"
	);


	$url = "https://openapi.naver.com/v1/map/geocode";
	curl_setopt($ch, CURLOPT_URL, $url.$qry_str);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$res =curl_exec($ch);
	curl_close($ch);

	return $res;
}



function strcut_utf8($str, $len, $checkmb=false, $tail='...') {
    preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);

    $m    = $match[0];
    $slen = strlen($str);  // length of source string
    $tlen = strlen($tail); // length of tail string
    $mlen = count($m); // length of matched characters

    if ($slen <= $len) return $str;
    if (!$checkmb && $mlen <= $len) return $str;

    $ret   = array();
    $count = 0;

    for ($i=0; $i < $len; $i++) {
        $count += ($checkmb && strlen($m[$i]) > 1)?2:1;

        if ($count + $tlen > $len) break;
        $ret[] = $m[$i];
    }

    return join('', $ret).$tail;
}

?>
