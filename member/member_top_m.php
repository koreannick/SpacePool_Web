<?if($USESSION[2]=="m1"){?>
<div class="m_top_nav_wrap">
	<a href="/member/member_info.php" class="<?if(preg_match("/member_info/",$PHP_SELF))		echo "active";?>">게스트 정보</a>
	<a href="/member/favorite.php" class="<?if(preg_match("/favorite/",$PHP_SELF))		echo "active";?>">내가 찜한 공간</a>
	<a href="/member/leave.php" class="<?if(preg_match("/leave/",$PHP_SELF))		echo "active";?>">서비스 탈퇴</a>
</div>
<?}else{?>
<div class="m_top_nav_wrap">
	<a href="/member/space_host.php" class="<?if(preg_match("/space_host/",$PHP_SELF))		echo "active";?>">공간 정보</a>
	<a href="/member/member_info.php" class="<?if(preg_match("/member_info/",$PHP_SELF))		echo "active";?>">호스트 정보</a>
	<a href="/member/favorite.php" class="<?if(preg_match("/favorite/",$PHP_SELF))		echo "active";?>">내가 찜한 공간</a>
	<a href="/member/payment.php" class="<?if(preg_match("/payment/",$PHP_SELF))		echo "active";?>">지불정보</a>
	<a href="/member/leave.php" class="<?if(preg_match("/leave/",$PHP_SELF))		echo "active";?>">서비스 탈퇴</a>
</div>
<?}?>