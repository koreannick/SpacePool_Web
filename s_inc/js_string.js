/*========================================================
js_string
--------------------------------=-------
문자열 제어 함수,프로토타입 모음

사용시 "공대여자는 예쁘다"를 나타내셔야합니다.

만든날 : 2007-06-27
수정일 : 2007-08-12
만든이 : mins01,mins,공대여자
홈페이지 : http://www.mins01.com
NateOn&MSN : mins01(at)lycos.co.kr
========================================================*/

/*======================================================
trim() : 양옆 공백을 제거한다
rtrim() : 문자열의 끝(왼쪽) 공백을 제거한다
ltrim() : 문자열의 시작(오른쪽) 공백을 제거한다

========================================================*/
String.prototype.trim = function(){
	return this.replace(/^\s+|\s+$/g,'');
}
String.prototype.rtrim = function(){
	return this.replace(/\s+$/g,'');
}
String.prototype.ltrim = function(){
	return this.replace(/^\s+/g,'');
}

/*======================================================
number_format()
PHP의 number_format과 똑같은 효과를 낸다.

decimals : 표시할 소수점 자리수(버림으로 처리됨)
dec_point : 소수점 표시단어
thousands_sep : 1000자리 표시단어

ex>
"123456.98765".number_format(4,'.',',');
String("123456.98765").number_format(4);
number_format("123456.98765");
-> 123,456.9876

123456.98765.number_format(4);
-> 123,456.9876
-123456.98765.number_format(4);
-> NaN
Number('-123456.98765').number_format(4);
-> -123,456.9876
========================================================*/
String.prototype.number_format = function(decimals,dec_point,thousands_sep){
	if(decimals==null){decimals=999;}
	if(dec_point==null){dec_point='.';}if(thousands_sep==null){thousands_sep=',';}
	var arr = this.toString().replace(/[^-\.\+\d]/g,'').split(dec_point);
	if(arr[1] && arr[1].length>0){arr[1] = arr[1].substr(0,decimals);}
	arr[0] = arr[0].replace(/(\d)(?=(?:\d{3})+(?!\d))/g,'$1'+thousands_sep);
	if(arr[1] && decimals>0 && arr[1].length>0){return arr[0] + dec_point + arr[1];}
	else {return arr[0];}
}
Number.prototype.number_format = function(decimals,dec_point,thousands_sep){
	return this.toString().number_format(decimals,dec_point,thousands_sep)
}
function number_format(str,decimals,dec_point,thousands_sep){
	return str.toString(decimals,dec_point,thousands_sep);
}

/*======================================================
number_to_hangul()
숫자를 한글표현식으로 보여준다.
st_postion : 정수 부분에서 자를부분(4단위로 끊음)
decimals : 소수 자를부분(버림으로 처리)
type_number : 숫자출력형식(1:한글로,0:숫자로);
type_thousands : 각숫자단위(십백천,소수단위) 출력설정(1:출력함,0:출력안함), 1일경우 소수점은 ' '로 대체됨
========================================================*/
String.prototype.number_to_hangul = function(st_postion,decimals,type_number,type_thousands){
//숫자를 완벽하게 한글로 바꿔준다.
	if(type_number==null){type_number=1;} if(type_thousands==null){type_thousands=1;}
	if(st_postion==null){st_postion=0;}	st_postion = (Math.floor(st_postion/4)-1);
	if(decimals==null){decimals=22;}

	var this_arr = this.toString().replace(/[^-\.\+\d]/g,'').split('.');
	if(type_number==1){
		var k = Array("", "일","이","삼","사","오","육","칠","팔","구"); // 숫자의 한글발음
	}else{
		var k = Array("", "1","2","3","4","5","6","7","8","9");
	}
	if(type_number==1 || type_thousands==1){
		var j1 = Array("","십","백","천"); // 자리수의 한글발음(4자마다 반복)
		var j3 = Array("할","분","리","모","사","홀","미","섬","사","진","애","묘","막","모호","준순","수유","순식","탄지","찰나","육덕","허공","청정"); // 단위의 한글발음(4자마다)
	}else{
		var j1 = Array("","","",""); // 자리수의 한글발음(4자마다 반복)
		var j3 = Array("","","","","","","","","","","","","","","","","","","","","",""); // 단위의 한글발음(4자마다)
	}
	var j2 = Array("","만","억","조","경","해","자","양","구","간","청","재","극","항하사","아승기","나유타","불가사의","무량대수"); // 단위의 한글발음(4자마다)
	//---------기호처리
	if((/[^\d]/).test(this_arr[0].substr(0,1))){var n0 = this_arr[0].substr(0,1);} //기호처리
	else{var n0 = '';}
	if(type_number==1){
		if(n0=='-'){n0='음수 ';}
		else if(n0=='+'){n0='양수 ';}
	}
	//--------- 정수처리
	var n1 = this_arr[0].replace(/[^\d]/,'');
	var arr = Array(Math.ceil(n1.length/4));
	var c_count = 0;
	for(var i = (n1.length-1);i>=0;i--){
		var x = Math.floor(c_count/4);
		if(!arr[x]){arr[x]='';}
		arr[x]=k[n1.substr(i,1)]+j1[c_count%4]+arr[x];
		c_count++;
	}
	for(var i = 0,m=arr.length;i<m;i++){
		if(st_postion<i){
			if(j2[i]!='' && !j2[i]){
				//arr[i]+='_ERROR_'; //단위글자가 없는 너무 큰 수일 경우 여기서 에러
			}else{arr[i]+=j2[i];}
		}else{arr[i]='';}
	}
	arr.reverse();
	n1 = arr.join('');
	//--------여기까지 정수 처리
	//-------- 소수 처리
	var n2 = '';
	if(this_arr[1] && this_arr[1].length>0){
		n2 = this_arr[1].substr(0,decimals);
		var n2_t = String('');
		for(var i=0,m=n2.length;i<m;i++){
			if(j3[i]!=''&&!j3[i]){	break;
				//n2_t+='_ERROR_'; //단위글자가 없는 너무 작은 소수일 경우 여기서 에러
			}else{n2_t+=k[n2.substr(i,1)]+j3[i];}
		}
		if(decimals==0){n2='';}
		else if(type_thousands==1){n2 = " "+n2_t;}
		else{n2 = "."+n2_t;	}
	}
	//------- 리턴
	return n0+n1+n2;
}
Number.prototype.number_to_hangul = function(st_postion,decimals,type_number,type_thousands){
	return this.toString().number_to_hangul();
}
function number_to_hangul(str,st_postion,decimals,type_number,type_thousands){
	return str.toString().number_to_hangul();
}

/*======================================================
limit_string(limit,point);
지정된 아규멘트에 따라서 글자를 제한한다(본 .js문서는 꼭 utf-8로 저장되어야 한글 등의 처리에서 올바르게 동작한다)

limit : 제한 정규식을 생성 인자
point : 구분자(기본값 : , )

limit
/e:알파벳소문자
/E:알파벳대문자
/E:알파벳
/d:숫자
/!d:숫자가 아닌것
/number : 숫자,-,+,.
/s:빈칸인것(일반적으로 같이 사용하면 빈칸이 포함됨)
/!s:빈칸이 아닌것
/ascii:보여질 수 있는 아스키문자
/eng,/kor,/jpn : 각 나라글자
/cjk :한중일 한자
그외 문자열 : 따로 포함되는 한글자(문자열이라도 각각 한글자로 처리된다)

#유니코드는 20000여개 이상의 세계 대부분의 글자가 포함되어있습니다.
그걸 다 제한 처리하는건...힘들죠.
http://www.unicode.org/charts/
이곳에서 원하는 언어를 체크해서 옵션을 만들어서 처리하세요.
limit_string('[시작글자]-[끝글자]') 처럼 해도 됩니다.

ex>
"text TEST 한글 !@#$ ".limit_string('/e')
-> text
"text TEST 한글 !@#$ ".limit_string('/eng,/s')
-> text TEST
"text TEST 한글 !@#$ ".limit_string('/kor')
-> 한글
"text TEST 한글 !@#$ ".limit_string('/ascii,/s')
-> text TEST !@#$
"text TEST 한글 !@#$ ".limit_string('한,st,/s') //st에서 s라는 글자는 없다
-> tt 한
========================================================*/
String.prototype.limit_string = function(limit,point){
	if(point==null){point=',';}
	var inv = limit.split(point);
	var inc = inv.length;
	var regexp=null //new RegExp('pattern',['flags']);
	var reg_str = '';
	for(var i = 0;i<inc;i++){
		switch(inv[i]){
			//----------- 예외처리
			case '':;
			case null:;
			case false:;
			case undefined:break;
			//----------- 알파벳처리
			case '/e':reg_str+='a-z';break; //알파벳 소문자
			case '/E':reg_str+='A-Z';break; //알파벳 대문자
			case '/eE':reg_str+='a-zA-Z';break; //모든 알파벳
			//----------- 숫자처리
			case '/d':reg_str+='\\d';break; //숫자인것
			case '/!d':reg_str+='\\D';break; //숫자가 아닌 것
			//----------- 숫자형 처리(정확하게 구분하는 것이 아닌, 숫자와 -,+,. 만 구분함)
			case '/number':reg_str+='\\-\\+\\.\\d';break; //숫자가 아닌 것
			//----------- 공백처리
			case '/s':reg_str+='\\s';break; //빈칸인것
			case '/!s':reg_str+='\\S';break;	//빈칸이 아닌것
			//----------- 아스키코드(특수문자 허용)
			case '/ascii':reg_str+='!-~';break;
			//-----------기호만처리
			case '/symbol':reg_str+='!-\\/\\:-@\\{-~';break;
			//----------- 영어글자처리
			case '/eng':reg_str+='a-zA-Z';break;
			//----------- 한글글자처리
			case '/kor':reg_str+=
			String.fromCharCode(0x1100)+'-'+String.fromCharCode(0x11FF)
			+String.fromCharCode(0x3130)+'-'+String.fromCharCode(0x318F)
			+String.fromCharCode(0xAC00)+'-'+String.fromCharCode(0xD7AF);break; //모든 한글(반각,전각 자모는 제외)
			case '/kor_jamo':reg_str+=String.fromCharCode(0x1100)+'-'+String.fromCharCode(0x11FF)
			+String.fromCharCode(0x3130)+'-'+String.fromCharCode(0x318F);break; //한글 자모만
			//----------- 얼본어글자처리
			case '/jpn':reg_str+=
			String.fromCharCode(0x3040)+'-'+String.fromCharCode(0x309F)
			+String.fromCharCode(0x30A0)+'-'+String.fromCharCode(0x30FF)
			+String.fromCharCode(0x31F0)+'-'+String.fromCharCode(0x31FF);break; // 모든 일어(반각 일어 제외)
			case '/jpn_hira':reg_str+=String.fromCharCode(0x3040)+'-'+String.fromCharCode(0x309F);break;//히라가나
			case '/jpn_kata':reg_str+=String.fromCharCode(0x30A0)+'-'+String.fromCharCode(0x30FF);break;//카타가나
			case '/jpn_kata_e':reg_str+=String.fromCharCode(0x31F0)+'-'+String.fromCharCode(0x31FF);break;//카타가나확장
			//----------- 한자 글자처리
			//호환,확장 한자의 경우 폰트에따라서 안보일 수 있음.(사용을 추천안함)
			case '/cjk':reg_str+=
			String.fromCharCode(0x4E00)+'-'+String.fromCharCode(0x9FBF)
			+String.fromCharCode(0x3400)+'-'+String.fromCharCode(0x4DBF)
//			+String.fromCharCode(0x020000)+'-'+String.fromCharCode(0x02A6DF)//한중일 공용 한자 확장B 포함안시킴(보통 사용안됨)
			+String.fromCharCode(0xF900)+'-'+String.fromCharCode(0xFAFF)
			+String.fromCharCode(0x3190)+'-'+String.fromCharCode(0x319F)
			+String.fromCharCode(0x2E80)+'-'+String.fromCharCode(0x2EFF) //CJK Radicals (부수?)
			+String.fromCharCode(0x2F00)+'-'+String.fromCharCode(0x2FDF) //KangXi Radicals
			+String.fromCharCode(0x31C0)+'-'+String.fromCharCode(0x31EF); //CJK Strokes
			break;	//모든 한자
			case '/cjk_uni':reg_str+=
			String.fromCharCode(0x4E00)+'-'+String.fromCharCode(0x9FBF);break; //한중일 공용 한자
			case '/cjk_uni_ea':reg_str+=
			String.fromCharCode(0x3400)+'-'+String.fromCharCode(0x4DBF);break; //한중일 공용 한자 확장A
			case '/cjk_uni_eb':reg_str+=
			String.fromCharCode(0x020000)+'-'+String.fromCharCode(0x02A6DF);break; //한중일 공용 한자 확장B
			case '/cjk_com':reg_str+=
			String.fromCharCode(0xF900)+'-'+String.fromCharCode(0xFAFF);break; //한중일 호환 한자
			case '/cjk_com_s':reg_str+=
			String.fromCharCode(0x2F800)+'-'+String.fromCharCode(0x2FA1F);break; //한중일 호환 한자 추가
			case '/cjk_kan':reg_str+=
			String.fromCharCode(0x3190)+'-'+String.fromCharCode(0x319F);break; //Kanbun
			//----------- 그외 글자
			default :
					reg_str+=inv[i];
				break;
		}
	}
	regexp=new RegExp('[^'+reg_str+']','g');
//	alert(regexp);
	return this.toString().replace(regexp,'');
}


/*======================================================
input_limit_string(ta,limit,poin);
지정된 input 객체에 입력값을 제한하도록 한다.
ta : 적용한 input(textarea 등) 대상
limit : 제한 정규식을 생성 인자
point : 구분자(기본값 : , )

추천 limit
'/kor,/symbol,/s':한글+특수기호+빈칸
'/eng,/d' : 영어+숫자 : 아이디용
'/number' : 숫자와 -,+,. 만

ex>
<input type="text" name="textfield" onfocus="input_limit_string(this,'/eng,/n,/s');"/>
========================================================*/
function input_limit_string(ta,limit,point){
	var fn = function(){
		var t = ta.value.limit_string(limit,point);
		if(t != ta.value){
			ta.value=t;
		}
	}
	ta.onclick = fn;
	ta.onblur = fn;
	ta.onkeydown = fn;
	ta.onkeyup = fn;
	ta.onchange = fn;
	ta.onmouseover = fn;
	ta.onmousemove = fn;
	ta.onfocus = null;
	ta.onfocus = fn;
}


/*======================================================
htmlspecialchars([quote_style])
특수 문자를 HTML 엔터티로 변환합니다.
quote_style
 0:" 만 변환
 1:",' 둘다 변환
 2:변환하지 않음
========================================================*/
String.prototype.htmlspecialchars = function(quote_style){
	if(quote_style==null){quote_style = 0;}
	var t = this;
	t = t.replace(/\&/g,'&amp;');
	if(quote_style<=1){t = t.replace(/\"/g,'&quot;');}
	if(quote_style==1){t = t.replace(/\'/g,'&#039;');}
	t = t.replace(/</g,'&lt;');
	t = t.replace(/>/g,'&gt;');
	return t;
}
function htmlspecialchars(str,quote_style){
	return str.htmlspecialchars(quote_style);
}
/*======================================================
nl2br()
문자열의 모든 줄바꿈 앞에 HTML 줄바꿈 태그를 삽입합니다.
========================================================*/
String.prototype.nl2br = function(){
	var t = this.replace(/\r\n/g,'\n');
	t = t.replace(/\r/g,'\n');
	t = t.replace(/\n/g,'<br />\n');
	return t;
}
function nl2br(str){
	return str.nl2br();
}
/*======================================================
nl2nl()
\n를 \\n으로 바꾼다(문자열이 한줄로 만들어진다.)
========================================================*/
String.prototype.nl2nl = function(){
	var t = this.replace(/\r\n/g,'\\n');
	t = t.replace(/\r/g,'\\n');
	t = t.replace(/\n/g,'\\n');
	return t;
}
function nl2nl(str){
	return str.nl2nl();
}
/*======================================================
strip_tags()
문자열에서 HTML 태그를 제거합니다.
<xx yy zz> 처럼 된 것을 제거합니다. 짝을 체크하거나 하지는 않습니다.
<xx
yy
zz> 도 제거합니다.
========================================================*/
String.prototype.strip_tags = function(){
	var t = this.replace(/<[^>]+[^>]*|\n*>/gm,'');
	return t;
}
function strip_tags(str){
	return str.strip_tags();
}

/*======================================================
wordwrap()
정해진 문자를 이용해 주어진 수 만큼의 문자를 래핑한다.
========================================================*/
String.prototype.wordwrap = function(width,break_str,cut){
	if(width==null) width=75;
	if(break_str==null) break_str="\n";
	if(cut==null) cut=1; //0이면 마지막에 단어가 걸리면 자른다. 1이면 단어를 밑으로 내린다.
	var arr = this.split(break_str);
	var arr2 = new Array();
	var arr3 = new Array();
	var temp = ''
	var ol='',ne='',t='';
	if(cut==0){
		var reg = new RegExp('(.{'+width+'})','gm');
		var t = this.replace(reg,'$1\n');
		return t;
	}else{
		for(i=0,m=arr.length;i<m;i++){
			arr3=arr[i].split(' ');
			ne = '';
			for(j=0,mj=arr3.length;j<mj;j++){
				if(ne==''){
					ne+=arr3[j];
				}else if(ne.length+1+arr3[j].length<=width){
					ne+=' '+arr3[j];
				}else{
					arr2.push(ne);ne = arr3[j];
				}
			}
			if(ne!=''){arr2.push(ne);}
		}
		return arr2.join(break_str);
	}
}
function wordwrap(str,break_str,cut){
	return str.wordwrap(break_str,cut);
}
/*======================================================
autolink()
문자열에서 URL에 해당되는 문자열을 하이퍼링크로 만든다

참고링크
http://www.phpschool.com/gnuboard4/bbs/board.php?bo_table=tipntech&wr_id=14253&sca=&sfl=wr_subject%7C%7Cwr_content&stx=js+%C0%DA%B5%BF%B8%B5%C5%A9&sop=and
========================================================*/
String.prototype.autolink = function(){
	var str = this;
	var regURL = new RegExp("(http|https|ftp|telnet|news|irc)(://)([-/.a-zA-Z0-9_~#%$?&;=:200-377()]+)","gi");
	var regEmail = new RegExp("([xA1-xFEa-z0-9_-]+@[xA1-xFEa-z0-9-]+\.[a-z0-9-]+)","gi");
	var result = str.replace(regURL,"<a href='$1$2$3' target='_blank'>$1$2$3</a>").replace(regEmail,"<a href='mailto:$1'>$1</a>");
	return result;
}
function autolink(str){
	return str.autolink();
}

/*======================================================
han_split()
한글을 초,중,종 으로 나눠준다.
결과값은 배열
한글이 아닌건 그냥 그대로 출력
ex>
하늘 AbC
->
Array(
	Array('ㅎ','ㅏ',''),
	Array('ㄴ','ㅡ','ㄹ'),
	' ',
	'A',
	'b',
	'C'
);

========================================================*/
function han_split(str){
	return str.han_split();
}
String.prototype.han_split = function(){
	return this.han_split_han();
}
String.prototype.han_split_int = function(){
	var str = this;
	var char_st = 44032 ;
	var char_ed = 55203 ;
	var str_arr = Array(str.length);

	for(var i=0,m=str.length;i<m;i++){
		var char = str.charAt(i);
		var uninum = char.charCodeAt(0);
		if(uninum < char_st || uninum > char_ed){
			str_arr[i]=char; //한글이 아님
			continue;
		}
		var uninum2 = uninum-char_st;
		var arr_1st_v = Math.floor(uninum2/588);
		uninum2 = uninum2%588;
		var arr_2nd_v = (Math.floor(uninum2/28));
		uninum2 = (uninum2%28);
		var arr_3th_v = uninum2;
		str_arr[i] = Array(arr_1st_v,arr_2nd_v,arr_3th_v);
	}
	return str_arr;
}
String.prototype.han_split_han = function(){
	var str_arr = this.han_split_int();
	var arr_1st= Array('ㄱ','ㄲ','ㄴ','ㄷ','ㄸ','ㄹ','ㅁ','ㅂ','ㅃ','ㅅ','ㅆ','ㅇ','ㅈ','ㅉ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ');//초성 19개
	var arr_2nd= Array('ㅏ','ㅐ','ㅑ','ㅒ','ㅓ','ㅔ','ㅕ','ㅖ','ㅗ','ㅘ','ㅙ','ㅚ','ㅛ','ㅜ','ㅝ','ㅞ','ㅟ','ㅠ','ㅡ','ㅢ','ㅣ');//중성 21개
	var arr_3th= Array('','ㄱ','ㄲ','ㄳ','ㄴ','ㄵ','ㄶ','ㄷ','ㄹ','ㄺ','ㄻ','ㄼ','ㄽ','ㄾ','ㄿ','ㅀ','ㅁ','ㅂ','ㅄ','ㅅ','ㅆ','ㅇ','ㅈ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ');//종성 28개
	for(var i =0,m=str_arr.length;i<m;i++){
		var arr = str_arr[i];
		if(arr.length<2) continue;
		str_arr[i] = Array(arr_1st[arr[0]],arr_2nd[arr[1]],arr_3th[arr[2]]);
	}
	return str_arr;
}

