<?
include $_SERVER["DOCUMENT_ROOT"]."/conf/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/conf/function.php";

if(!$mode){	$mode="input";	}

$table = "es_online";

$connect = dbcon();

if(substr($mode,strrpos($mode,"_")) == "_ok"){	// ok 일경우 ////////////////////
	$page_source = "/s_source/online/_all_ok.php";
	include_once($_SERVER["DOCUMENT_ROOT"] . $page_source);
	exit();
}else{
	$page_source = "/s_source/online/_" . $mode.".php";
}


?>
<!doctype html>
<html>
<head>
	<?php virtual('/include/headinfo.php'); ?>
</head>
<body>
	<!-- 올랩 -->
	<div id="wrap" class="sub sub_partner sp_apply sub_member">
		<?php virtual('/include/header.php'); ?>
		<div class="con_all_wrap">
			<div class="con_wrap">
				<div class="con_in">
					<?include_once($_SERVER[DOCUMENT_ROOT] . $page_source);?>

					<div class="f_pop_wrap">
						<a href="#" class="f_pop_bg"></a>
						<div class="f_pop">
							<div class="f_pop_label3">제휴신청 완료</div>
							<div class="f_pop_desc">
								<div class="f_pop_desc_name2">
									신청이 완료되었습니다.
								</div>
							</div>
							<div class="f_pop_comment">
								담당자가 확인후<br> 연락드리겠습니다.
							</div>
							<div class="f_pop_close">
								<a href="/" class="f_pop_close_btn">확인</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php virtual('/include/footer.php'); ?>
	</div>
	<!-- 올랩끝 -->
	<!-- 위로가기 -->
	<!-- <a href="#" id="toTop"></a> -->
</body>
</html>