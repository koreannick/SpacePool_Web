//Produced by. Jae-Ho http://www.heartbreak.co.kr/
//(C) Yoon Jae Ho. All rights reserved.

$(function(){
  $('.open_btn').click(function(){
    $('#side_wrap').animate({
      left: "+=250px"
    }, 300);
    $('#bg').fadeIn(function(){
      $(this).css('display','block')
      $('html').css({"overflow-y":"hidden"})
    });
  });

  $('.close_btn, #bg').click(function(){
    $('.sub_menu').slideUp(100);
    $('#side_wrap').animate({
      left: "-=250px"
    }, 300);
    $('#bg').fadeOut(function(){
      $(this).css('display','none')
      $('html').css({"overflow-y":"visible"});
    });
  });

  $('.menu').click(function(){
    var sub = $(this).attr('rel');
    if ($('#'+sub).css("display")=="none")
    {
      $('.sub_menu').slideUp(100);
      $('#'+sub).slideDown(100);
    } else {
        $('#'+sub).slideUp(100);
        }
  });

  $('#sub_sub').click(function(){
    var sub_sub = $(this).attr('rel');
    if ($('.'+sub_sub).css("display")=="none")
    {
      $('#sub_sub li').slideUp(100);
      $('.'+sub_sub).slideDown(100);
    } else {
        $('.'+sub_sub).slideUp(100);
        }
  });

  $('#sub_sub_01').click(function(){
    var sub_sub = $(this).attr('rel');
    if ($('.'+sub_sub).css("display")=="none")
    {
      $('#sub_sub_01 li').slideUp(100);
      $('.'+sub_sub).slideDown(100);
    } else {
        $('.'+sub_sub).slideUp(100);
        }
  });

  $('#sub_sub_02').click(function(){
    var sub_sub = $(this).attr('rel');
    if ($('.'+sub_sub).css("display")=="none")
    {
      $('#sub_sub_02 li').slideUp(100);
      $('.'+sub_sub).slideDown(100);
    } else {
        $('.'+sub_sub).slideUp(100);
        }
  });
});