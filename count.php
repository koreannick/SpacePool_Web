<?
 

if($_COOKIE["mycount"]!="counter"){
	$my_ip = getenv("REMOTE_ADDR");
	$my_brz = getenv("HTTP_USER_AGENT");
	$my_ref = strtolower(getenv("HTTP_REFERER"));
	$my_ref = str_replace("http://","",$my_ref);
	$my_ref = str_replace("https://","",$my_ref);
	$my_ref = str_replace("http:","",$my_ref);
	$my_ref = str_replace("https:","",$my_ref);
	$my_ref = str_replace("www.","",$my_ref);
	$con_hour = date("H");
	$search_word = explode("?",$my_ref);
	$site = explode("/",$search_word[0]);
	$search_word[1] = urldecode($search_word[1]);
	$key_word = explode("&",$search_word[1]);

	for($i=0; $i < count($key_word); $i++){
		if(preg_match("/^p=/",$key_word[$i])){
			$key = explode("=",$key_word[$i]);
		}
		if(preg_match("/^q=/",$key_word[$i])){
			$key = explode("=",$key_word[$i]);
		}
		if(preg_match("/^query=/",$key_word[$i])){
			$key = explode("=",$key_word[$i]);
		}
		if(preg_match("/^keyword=/",$key_word[$i])){
			$key = explode("=",$key_word[$i]);
		}
	}

	if(strpos($my_ref,"nate.com")>0){
		$skeyword = iconv("UTF-8","utf-8",$key[1]);
	}elseif(strpos($my_ref,"naver.com")>0){
		$skeyword = iconv("UTF-8","utf-8",$key[1]);
	}elseif(strpos($my_ref,"daum.net")>0){
		$skeyword = iconv("UTF-8","utf-8",$key[1]);
	}else{
		if(preg_match("/=utf8/",strtolower($search_word[1]))){
			$skeyword = iconv("UTF-8","utf-8",$key[1]);
		}else{
			$skeyword = $key[1];
		}
	}

	if($mweb)		$mweb_str = "Y";
	else				$mweb_str = "N";

	if($mobile)		$mobile_str = "Y";
	else				$mobile_str = "N";

	$result = mysql_query("select * from con_info where ip = '$my_ip' and agent = '$my_brz' and con_date = '".date("Y-m-d")."' and con_hour = '$con_hour'");
	if(mysql_num_rows($result)==0){
		@mysql_query("insert into con_info (ip, agent, referer, site, search_word, con_date, con_hour,mweb,mobile) values('$my_ip','$my_brz','$my_ref','$site[0]','$skeyword',now(),$con_hour,'$mweb_str','$mobile_str')");
	}

	setcookie("mycount","counter", time()+3600,".".$CONF_SITE_DOMAIN,1,true); //쿠키 유지시간..

	flush2();
}
?>