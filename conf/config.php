<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/common.php";

## DB 연결 변수 ###############

$CONF_SERVERNAME = "localhost";
$CONF_DBUSERID = "lucaspark90";
$CONF_DBPASSWD = "wecon03290";
$CONF_DBNAME = "lucaspark90";

//SMS연결
/*
$CONF_SMS_SERVERNAME = "211.234.116.147:3307";
$CONF_SMS_DBUSERID = "sms";
$CONF_SMS_DBPASSWD = "sms@1212";
$CONF_SMS_DBNAME = "smsgau";
*/

## 설정 변수 ###############
$CONF_PAGE_LEV = 10;				// 권한 변수
$CONF_VIEWABLE = 10;				// 권한 변수
$CONF_WRITEABLE = 10;				// 권한 변수
$CONF_LOGIN_AUTH = 10;
$CONF_MEMBER_FILE = "/member/member.php";

$CONF_TITLE_TAG = "SpacePool";	// 타이틀 테그
$CONF_TITLE_TAG2 = "SpacePool";	// 타이틀 테그
$CONF_SKIN = 1;
$CONF_LEFT = "";
$CONF_LANG = "";
$CONF_START = "/";
$CONF_ADMIN_START = "/s_admin/";
$MAKE_DATE = "2016년 10월 18일";
$CONF_TEL = "";
$CONF_OWNER = "";

## 에러메시지 #################
$CONF_ERR_MSG_1 = "일시적인 서버오류 입니다. 잠시후 다시 한번 시도해주세요";

$CONF_noid = "admin,administrator,관리자,운영자,어드민,관인장,주인,webmaster,웹마스터,sysop,시삽,시샵,manager,매니저,메니저,root,루트,su,guest,방문객,".$CONF_TITLE_TAG;

$adminmail = "help@".$CONF_SITE_DOMAIN;

$m_level_arr = array("m1"=>"GUEST","m2"=>"HOST","admin"=>"관리자");

$gubun_arr = array(1=>"쉐어오피스","서비스드오피스","","세미나/미팅룸");

$t_member = "es_member";

$mobile = false;
if(preg_match('/iphone|ipod|ipad|ios|blackberry|android|windows ce|lg|mot|samsung|sonyericsson|nokia/i', strtolower($_SERVER['HTTP_USER_AGENT']))){
	$mobile = true;
}

$n_client_id = "muRBz7X28onuWx7xcQXY";
$n_client_secret = "CClFInfoar";

$faq_kind_arr = array(1=>"회원","예약/결제","취소/환불","기타");

$callback = "050851923708";
$sms_cid = "spacepool";
$sms_cpass = "spacepool@1212";


$p_opt_arr = array(1=>"인터넷","와이파이","전화선","냉장고","정수기","프린터/복합기","회의실","접대실","주차장","음향시설","프로젝터","화장실","파티션","자판기","출입시스템","사업자등록","CCTV");

$day_str = array("일","월","화","수","목","금","토");

include $_SERVER["DOCUMENT_ROOT"]."/conf/Naver_Login.php";



//SMS메세지 설정
$s_m_1 = "카드결제로 예약신청되었습니다.";
$s_m_2 = "무통장입금으로 예약신청되었습니다.";
$s_m_3 = "현장결제로 예약신청되었습니다.";
$s_m_4 = "예약이 취소되었습니다.";
$s_m_5 = "결제가 승인되었습니다.";
$s_m_6 = "결제가 취소되었습니다.";


$db_host				= "localhost";		// Database 호스트명
	$db_connect_id			= "lucaspark90";		// Db 계정 id
	$db_connect_passwd 		= "wecon03290";	 		// Db 계정 암호
	$db_name				= "lucaspark90";	// Db Name

	$tb_name				= "";				// 테이블 이름
	$adminmail				= "";// 관리자 이메일
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
