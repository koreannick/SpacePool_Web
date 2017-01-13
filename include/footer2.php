<script type="text/javascript">
	$(".header_bottom_right > div").mouseenter(function(){
		$(".header_wrap").addClass("open").removeClass("closed");
		$('.header_bottom_right .sub_nav_wrap').stop();
		$('.header_bottom_right .sub_nav_wrap').show("fast");
		$('.all_bg_wrap').stop();
		$('.all_bg_wrap').fadeIn("fast");
		return false;
	})
	$(".header_bottom_right").mouseleave(function(){
		$(".header_wrap").addClass("closed").removeClass("open");
		$('.header_bottom_right .sub_nav_wrap').stop();
		$('.header_bottom_right .sub_nav_wrap').hide("fast");
		$('.all_bg_wrap').stop();
		$('.all_bg_wrap').fadeOut("fast");
		return false;
	})
	$(".header_bottom_right * ").focus(function(){
		$(".header_wrap").addClass("open").removeClass("closed");
		$('.header_bottom_right .sub_nav_wrap').stop();
		$('.header_bottom_right .sub_nav_wrap').show("fast");
		$('.all_bg_wrap').stop();
		$('.all_bg_wrap').fadeIn("fast");
		return false;
	})
	$(".header_bottom_right .m_nav_05 div a:last-child").focusout(function(){
		$(".header_wrap").addClass("closed").removeClass("open");
		$('.header_bottom_right .sub_nav_wrap').stop();
		$('.header_bottom_right .sub_nav_wrap').hide("fast");
		$('.all_bg_wrap').stop();
		$('.all_bg_wrap').fadeOut("fast");
		return false;
	})
</script>