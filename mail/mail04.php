<?
$mail_subject = "[] 이용하신 공간은 어떠셨나요? 별점 및 후기를 달아주세요.";
$mail_content = "<!doctype html>
<html>
<head>
<meta charset=\"utf-8\">
<title>스페이스풀</title>
<link href=\"http://".$CONF_SITE_DOMAIN."/css/base.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"http://".$CONF_SITE_DOMAIN."/css/mail.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>
<body>
<div id=\"wrap\" class=\"mail_wrap\">
	<div class=\"mail\">
	<div class=\"mail_tlt\">
		<img src=\"http://".$CONF_SITE_DOMAIN."/images/common/logo.png\">
	</div>




	<div class=\"mail_box\">
		<div class=\"mail_img\">
			<img src=\"http://".$CONF_SITE_DOMAIN."/images/mail/mail_img04.jpg\">
		</div>
		<div class=\"mail_txt\">
			 <b>이용하신 공간은 어떠셨나요? 별점 및 후기를 달아주세요</b><br>
			회원님이 남겨주신 후기는 호스트에게 더 나은 호스팅을 제공하는데 도움을 줍니다.
			<a class=\"mail_btn\" href=\"http://".$CONF_SITE_DOMAIN."/member/book_detail.php?kind=4&uid=".$uid."\" target=\"_blank\">별점달기</a>
		</div>
	</div>





</div>
</body>
</html>";