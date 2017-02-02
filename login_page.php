<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";



$connect = dbcon();

require "count.php";
?>
<!DOCTYPE html>
<html>
  <head>
  	<?php virtual('/include/headinfo.php'); ?>
  <?
  require "popup_proc.php";
  require "popup_layer.php";
  ?>
<!-- 카카오 로그인 sdk -->
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
  </head>
  <body>
    	<div id="wrap" class="main">

            <?php virtual('/include/header.php'); ?>
    <a href="javascript:loginNaver();">
      <img src="/images/naver_login.png" alt="네이버 아이디로 로그인" width="200">
    </a>

    <a id="kakao-login-btn"></a>

    <a href="http://alpha-developers.kakao.com/logout"></a>
    <script type='text/javascript'>
      //<![CDATA[
        // 사용할 앱의 JavaScript 키를 설정해 주세요.
        Kakao.init('e0b8811c749e15068d153bf5229f25a6');
        // 카카오 로그인 버튼을 생성합니다.
        Kakao.Auth.createLoginButton({
          container: '#kakao-login-btn',
          success: function(authObj) {
            alert(JSON.stringify(authObj));
          },
          fail: function(err) {
             alert(JSON.stringify(err));
          }
        });
      //]]>
    </script>

      </div>
  		<?php virtual('/include/footer.php'); ?>
  </body>

</html>
