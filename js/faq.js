// JavaScript Document

$(function(){
				//모든 패널이 펼쳐져 있는 상태이기 때문에 dd의 첫번째를 제외한 곳은 안보이게 설정
				$('.faq_btn_wrap dd:not(:first)').css('display','none');
				$('.faq_btn_wrap dl dt').click(function() { //dl의 dt를 클릭했을때
                   			 if($('+dd',this).css('display')=='none'){//만약 클릭한 태그 다음에 있는 dd태그의 속성이 none이면
						$('.faq_btn_wrap dd').slideUp('fast');//dd태그에 대해서는 슬라이드 업
						$('+dd',this).slideDown('fast');//인접한 dd의 슬라이드다운
					}
				});
			});
