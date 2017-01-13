<div class="s_view_info_box">
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">이름<span>*</span></div>
		<div class="s_view_desc_txt_desc">
		 <? if($MemInfo[kcp_code] == "0000") { ?>
			<?=$MemInfo[name]?>
			<input type="hidden" name="name" value="<?=$MemInfo[name]?>">
			<input type="hidden" name="mb_sex" value="<?=$MemInfo[mb_sex]?>" />
		<? } else { ?>
		       <?=$name?>
				<span id="ins1">
				<input type="hidden" name="name" value="<?=$name?>" class="sign_input_02">&nbsp;&nbsp;&nbsp;
				 <label style="padding:0 10px 0 0"><input type="radio" name="mb_sex" value="M" <?=($MemInfo[mb_sex]=="M" || !$MemInfo[mb_sex]?"checked":"")?> />&nbsp;남자</label>
				<label><input type="radio" name="mb_sex" value="F" <?=($MemInfo[mb_sex]=="F"?"checked":"")?> />&nbsp;여자</label>
				</span>
				<span id="ins2" style="display:none"><span>
					<span id="ins2_txt" style="display:none"></span>
				<span id="ins1_txt" style="display:none"></span>
				<span id="ins1_btn" style="display:none"><!--input type=button value="다시입력" onclick="is_rebtn()"--></span>
				<input type=hidden name="kcp_code" >

				<script type="text/javascript">
		<!--
		function is_rebtn() {
			if(document.form0.kcp_code.value == "0000") {
				alert("본인인증이 끝난 이름/생년월일은 수정할수 없습니다.");
			} else {
				document.getElementById("ins1_txt").style.display = "none";
				document.getElementById("ins1_btn").style.display = "none";
				document.getElementById("ins2_txt").style.display = "none";

				document.getElementById("ins1").style.display = "";
				document.getElementById("ins2").style.display = "";
			}
		}
		//-->
		</script>

		<? } ?>

		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">아이디<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<?=$email?>
		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">닉네임<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<?=$nickname?>
		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">전화번호</div>
		<div class="s_view_desc_txt_desc">
			<select class="sign_input_02" name="tel1">
				<option value="02" <?if($tel1=="02")		echo "selected";?>>02</option>
				<option value="031" <?if($tel1=="031")		echo "selected";?>>031</option>
				<option value="032" <?if($tel1=="032")		echo "selected";?>>032</option>
				<option value="033" <?if($tel1=="033")		echo "selected";?>>033</option>
				<option value="041" <?if($tel1=="041")		echo "selected";?>>041</option>
				<option value="042" <?if($tel1=="042")		echo "selected";?>>042</option>
				<option value="043" <?if($tel1=="043")		echo "selected";?>>043</option>
				<option value="051" <?if($tel1=="051")		echo "selected";?>>051</option>
				<option value="052" <?if($tel1=="052")		echo "selected";?>>052</option>
				<option value="053" <?if($tel1=="053")		echo "selected";?>>053</option>
				<option value="054" <?if($tel1=="054")		echo "selected";?>>054</option>
				<option value="055" <?if($tel1=="055")		echo "selected";?>>055</option>
				<option value="061" <?if($tel1=="061")		echo "selected";?>>061</option>
				<option value="062" <?if($tel1=="062")		echo "selected";?>>062</option>
				<option value="063" <?if($tel1=="063")		echo "selected";?>>063</option>
				<option value="064" <?if($tel1=="064")		echo "selected";?>>064</option>
				<option value="070" <?if($tel1=="070")		echo "selected";?>>070</option>
			</select>
			<span class="span_col"> - </span>
			<input type="text" name="tel2" class="sign_input_02"  id='tel2' placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" value="<?=$tel2?>">
			<span class="span_col"> - </span>
			<input type="text" name="tel3" class="sign_input_02" id='tel3' placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" value="<?=$tel3?>">
		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">휴대폰번호<span>*</span></div>
		<div class="s_view_desc_txt_desc">


			<select class="sign_input_02" name="mobile1">
				<option value="010" <?if($mobile1=="010")		echo "selected";?>>010</option>
				<option value="011" <?if($mobile1=="011")		echo "selected";?>>011</option>
				<option value="016" <?if($mobile1=="016")		echo "selected";?>>016</option>
				<option value="017" <?if($mobile1=="017")		echo "selected";?>>017</option>
				<option value="018" <?if($mobile1=="018")		echo "selected";?>>018</option>
				<option value="019" <?if($mobile1=="019")		echo "selected";?>>019</option>
			</select>
			<span class="span_col"> - </span>
			<input type="text" name="mobile2" class="sign_input_02"  placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" must="Y" mval="휴대폰번호는" value="<?=$mobile2?>">
			<span class="span_col"> - </span>
			<input type="text" name="mobile3" class="sign_input_02"  placeholder="" maxlength="4" onkeypress="onlyNumber();" style="ime-mode:disabled;" must="Y" mval="휴대폰번호는" value="<?=$mobile3?>">
		<?

		if($PHP_SELF =='/member/host_signup.php'){
		?>
		<?}else{?>

			<span class="span_desc">
				<a href="javascript:auth_type_check();" class="sing_btn_01" id="win_hp_cert">인증번호 발송</a>
			</span>
			<?}?>
		</div>
		<!--
		<div class="s_view_desc_txt_desc">
			<input type="text" name="authnum" class="sign_input_01" onkeypress="onlyNumber();" style="ime-mode:disabled;"  placeholder="인증번호를 입력하세요" maxlength="6" must="Y" mval="인증번호는">
			<span class="span_desc">
				<a href="#" class="sing_btn_01">인증확인</a>
			</span>
		</div>
		 -->
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">주소<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<input type="text" name="post" id="post" class="sign_input_01" value="<?=$post?>" placeholder="주소검색" must="Y" mval="우편번호" readonly onClick="execDaumPostcode(1);">
			<span class="span_desc">
				<a href="#" class="sing_btn_01" onClick="execDaumPostcode(1);">우편번호 찾기</a>
			</span>
			<div id="Post_Layer" style="display:none;position:top;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
				<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
			</div>
			<script type="text/javascript" src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
			<script type="text/javascript" src="/s_inc/Daum_Post.js"></script>
		</div>
		<div class="s_view_desc_txt_desc">
			<span class="span_desc">
				<input type="text" name="addr1" id="addr1" class="sign_input_03" value="<?=$addr1?>" placeholder="주소" onClick="execDaumPostcode(1);" readonly must="Y" mval="주소">
			</span>
			<span class="span_desc">
				<input type="text" name="addr2" id="addr2"  class="sign_input_03" value="<?=$addr2?>" maxlength="50" placeholder="나머지주소" must="Y" mval="상세주소">
			</span>
		</div>
	</div>
	<?if($USESSION[2]=="m2"||preg_match("/host/",$PHP_SELF)){?>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">업체명<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<input type="text" name="company" class="sign_input_01" value="<?=$company?>" placeholder="업체명을 입력하세요" maxlength="20" must="Y" mval="업체명은">
		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">업종<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<input type="text" name="cetc" class="sign_input_01" value="<?=$cetc?>" placeholder="업종을 입력하세요" maxlength="20" must="Y" mval="업종은">
		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">직원 수<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<input type="text" name="cperson" class="sign_input_02" value="<?=$cperson?>" maxlength="3" onkeypress="onlyNumber();" style="ime-mode:disabled;" placeholder="" must="Y" mval="직원 수는">
			<span class="span_desc">
				<b class="alert_ok">직원수를 입력하세요</b>
			</span>
		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">사업기간<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<input type="text" name="cdate1" class="sign_input_02" value="<?=$cdate1?>" maxlength="2" onkeypress="onlyNumber();" style="ime-mode:disabled;" placeholder="" must="Y" mval="사업기간은">
			<span class="span_col"> 년 </span>
			<input type="text" name="cdate2" class="sign_input_02" value="<?=$cdate2?>" maxlength="2" onkeypress="onlyNumber();" style="ime-mode:disabled;" placeholder="" must="Y" mval="사업기간은">
			<span class="span_col"> 개월 </span>

		</div>
	</div>
	<div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">사업내용<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<textarea class="book_area_01" placeholder="사업내용을 적어주세요." must="Y" mval="사업내용은" name="comment"><?=$comment?></textarea>
		</div>
	</div>
	<div class="s_view_desc_txt2 h_30">
		<div class="s_view_desc_txt_num">사업자<br>등록번호<span>*</span></div>
		<div class="s_view_desc_txt_desc">
			<input type="text" name="creg1" class="sign_input_02"  placeholder="" maxlength="3" onkeypress="onlyNumber();" style="ime-mode:disabled;" value="<?=$creg1?>" must="Y" mval="사업자등록번호는">
			<span class="span_col"> - </span>
			<input type="text" name="creg2" class="sign_input_02"  placeholder="" maxlength="2" onkeypress="onlyNumber();" style="ime-mode:disabled;" value="<?=$creg2?>" must="Y" mval="사업자등록번호는">
			<span class="span_col"> - </span>
			<input type="text" name="creg3" class="sign_input_02"  placeholder="" maxlength="5" onkeypress="onlyNumber();" style="ime-mode:disabled;" value="<?=$creg3?>" onblur="check_BizRegNo();" must="Y" mval="사업자등록번호는">
			<!-- <span class="span_desc">
				<a href="javascript:check_BizRegNo();" class="sing_btn_01">인증하기</a>
			</span> -->
		</div>
	</div>

	<!-- <div class="s_view_desc_txt2">
		<div class="s_view_desc_txt_num">네이버 톡톡</div>
		<div class="s_view_desc_txt_desc">
			<input type="text" name="n_talk" id="n_talk" value="<?=$n_talk?>" maxlength="100" class="sign_input_03"  style="ime-mode:disabled;">
			<span class="span_desc">
				<a href="https://partner.talk.naver.com" class="sing_btn_01 color_naver" target="_blank">네이버톡톡 계정설정</a>
				<br />※ 쉽고 간편하게 고객과 이야기하는 방법
			</span>
			<span class="span_desc">

			</span>
		</div>
	</div> -->
	<?}?>
</div>
