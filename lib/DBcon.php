<?
 include $_SERVER["DOCUMENT_ROOT"]."/conf/common.php";

	$db_host				= "localhost";		// Database 호스트명
	$db_connect_id			= "lucaspark90";		// Db 계정 id
	$db_connect_passwd 		= "wecon03290";	 		// Db 계정 암호
	$db_name				= "lucaspark90";	// Db Name

	$tb_name				= "";				// 테이블 이름
	$adminmail				= "spacepool@naver.com";// 관리자 이메일
	$admin_passwd			= "";

	$db_con=mysql_connect($db_host,$db_connect_id,$db_connect_passwd) or die(dberror());

	// 디비 연결 함수
	function dbconnect()
	{
		global $db_host;
		global $db_connect_id;
		global $db_connect_passwd;
		global $db_name;
		global $tb_name;
		mysql_connect($db_host,$db_connect_id,$db_connect_passwd) or die(dberror());
		mysql_select_db($db_name) or die(dberror());
	}

	// 디비 연결 함수
	function db_connect($db)
	{
		global $db_host;
		global $db_connect_id;
		global $db_connect_passwd;
		global $tb_name;
		mysql_connect($db_host,$db_connect_id,$db_connect_passwd) or die(dberror());
		mysql_select_db($db) or die(dberror());
	}


	// 디비 에러시 출력 함수
	function dberror()
	{
		echo("
			<Html>
			<Body>
			<P align='center'></P>
			<P align='center'><Font size='7'><B>Warning</B></Font></P>
			<P align='center'>대단히 죄송합니다.</P>
			<P align='center'>현재 DATABSE SEVER의 과부하로 일시 서비스를 사용하실수가 없습니다.<Br>
			계속적인 사용 일시 중지시에는 <A href='mailto:$adminmail'>$adminmail</A>로 연락 주시기 바랍니다.<Br>
			</P>
			</Body>
			</Html>
		");exit;
	}

	function dberrormsg()
	{
		echo "MySQL ERROR: " . mysql_errno() . " " . mysql_error()."<BR>";
		mysql_close();
		exit;
	}
  	dbconnect();
?>
