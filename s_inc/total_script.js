//에러출력
function err_proc(err, msg) {
	if(msg.length > 0){
		alert(msg);
	}
	err.value='';
	err.focus();
	//err.select();
//	return false;
	return;
}

//메일 체크
function check_email(obj, email){
	if(check_mail(email)){
		return true;
	}else{
		alert("이메일 형식이 틀립니다");
		obj.value = "";
		obj.focus();
		return false;
	}
}

//메일 체크
function check_mail(val) {
	var cnt = 0;
	for (i = 0; i < val.length; i++)
		if(val.charAt(i) == '@' )
			cnt++
		if(cnt != 1)
			return false;
		else if (val.indexOf("@") < 3)
			return false;
		else if(val.length - val.substr(0, val.indexOf("@")).length == 0 )
			return false;
		else if(val.search(/(\S+)@(\S+)\.(\S+)/) == -1 )
			return false;
		else
			return true;
}

// 공백을 체크
function check_space(str){
	if(str.value.indexOf(" ") != -1){
		return true;
	}
}

// 전화번호/휴대폰/팩스 체크
function check_tel(){
	var arr_val = Array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "-");
	for(i=0; i<arr_val.length; i++){
		if(String.fromCharCode(window.event.keyCode) == arr_val[i]){
			return true;
		}
	}
	return false;
}

// 숫자 체크
function check_num(){
	var arr_val = Array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
	for(i=0; i<arr_val.length; i++){
		if(String.fromCharCode(window.event.keyCode) == arr_val[i]){
			return true;
		}
	}
	return false;
}



//태그및 (')문자 막기
function check_tag(val){
	for(i=0; i<val.value.length; i++){
		if(val.value.charAt(i) == "<" || val.value.charAt(i) == ">" || val.value.charAt(i) == "'"){
			alert("문자 (), (>), (')는 사용할수 없습니다!");
			val.value = val.value.substr(0, i);
			return false;
		}
	}
}



// 페이지 로드 ///////////////////////////////////////////////////////
function page_load(){


	// 갤러리 페이지
	if(document.all.pic){
		check_size(document.all);
	}


	//clickOnNode(1);

}

// 숫자 체크
function isNumeric(s) {
        for (i=0; i<s.length; i++) {
                c = s.substr(i, 1);
                if (c < "0" || c > "9") return false;
        }
        return true;
}


// 날짜 체크
function isYYYYMMDD(y, m, d) {
        switch (m) {
        case 2:        // 2월의 경우
                if (d > 29) return false;
                if (d == 29) {
                        // 2월 29의 경우 당해가 윤년인지를 확인
                        if ((y % 4 != 0) || (y % 100 == 0) && (y % 400 != 0))
                                return false;
                }
                break;
        case 4:        // 작은 달의 경우
        case 6:
        case 9:
        case 11:
                if (d == 31) return false;
        }
        // 큰 달의 경우
        return true;
}

// preview
function es_open_view(url){
	kk = window.open('','kk','width=500,height=500,scrollbars,resizable');
	kk.document.write("<body  topmargin=0 leftmargin=0 onLoad='window.resizeTo(document.all.kk.width+60,document.all.kk.height+80);'>");
	kk.document.write("<table width=100% height=100%><tr><td align=center><img id=kk src='" + url + "' style='cursor:hand;border:solid 1 #eeeeee;' onClick=self.close();></td></tr></table>");
	kk.document.write("</body>");
	kk.document.close();

}


// 매개변수에 등록한 개체 빼고 다 disabled ///////////
function not_disable_obj(){
	var arg = not_disable_obj.arguments;
	var form = arg[0];
	for(i=0; i<form.length; i++){
		kk =0;
		for(j=1; j<arg.length; j++){	// j=0은 form;
			if(form[i] == arg[j]){
				kk = 1;
				continue;
			}
		}
		if(!kk){
			form[i].disabled = true;
		}
	}

}


// 페이지 로드
function page_load(){
	if(typeof(body_load) == "function"){
		body_load();
	}
}

// 마우스 오버 ///////////////////////////////////////////////////////////////////////
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


//공백을 제외한 길이 체크 함수
function CheckStr(strOriginal, strFind, strChange){
 var position, strOri_Length;
 position = strOriginal.indexOf(strFind);

 while (position != -1){
  strOriginal = strOriginal.replace(strFind, strChange);
  position = strOriginal.indexOf(strFind);
 }

 strOri_Length = strOriginal.length;
 return strOri_Length;
}

function GO_chk(frm){
	if(frm.agree.checked==true){
		var cnt=frm.elements.length;

		for(i=0;i<cnt;i++){
			if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
				alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
				frm.elements[i].value = "";
				frm.elements[i].focus();
				return false;
			}
		}
	}else{
		alert('개인정보 처리방침에 동의하셔야합니다.');
		return false;
	}
}

function GO_chk2(frm){
	if(frm.agree.checked==true){
		var cnt=frm.elements.length;

		for(i=0;i<cnt;i++){
			if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
				alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
				frm.elements[i].value = "";
				frm.elements[i].focus();
				return;
			}
		}

		frm.submit();
	}else{
		alert('개인정보 처리방침에 동의하셔야합니다.');
		return;
	}
}

function ValidChk_eng(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert("Enter the "+frm.elements[i].getAttribute('mval'));
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return false;
		}
	}
}

function ValidChk(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return false;
		}
	}
}

function ValidChk3(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return;
		}
	}
	frm.submit();
}

function ValidChk2(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return false;
		}
	}

	if(CheckStr(frm.wr_key.value," ","")==0){
		alert("자동등록방지 값을 입력하지 않았습니다. 내용을 정확하게 입력하여 주시기 바랍니다.");
		frm.wr_key.style.backgroundColor = "#C1C7F1";
		frm.wr_key.focus();
		return false;
	}else if(hex_md5(frm.wr_key.value) != md5_norobot_key){
		alert("자동등록방지용 빨간글자가 순서대로 입력되지 않았습니다.");
		frm.wr_key.focus();
		return false;
	}
}

function ValidChk_E(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return false;
		}
	}
	oEditors.getById["comment"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
}

function ValidChk_Eng(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert("Enter the "+frm.elements[i].getAttribute('mval'));
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return false;
		}
	}
}



function ValidChk_buy(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval'));
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return false;
		}
	}
	frm.mode.value = "";
}

function ValidChk_Now(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval'));
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return;
		}
	}
	frm.mode.value = "now";
	frm.submit();
}

function Save_Go(){
	var frm = document.form0;

	if(frm.agree.checked==true){
		var cnt=frm.elements.length;

		for(i=0;i<cnt;i++){
			if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
				alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
				frm.elements[i].value = "";
				frm.elements[i].focus();
				return;
			}
		}
		frm.submit();
	}else{
		alert('개인정보 처리방침에 동의하셔야합니다.');
		return;
	}
}

function ValidChk_PWD(frm){
	var cnt=frm.elements.length;

	for(i=0;i<cnt;i++){
		if(frm.elements[i].getAttribute('must')=="Y"&&(CheckStr(frm.elements[i].value," ","")==0)){
			alert(frm.elements[i].getAttribute('mval')+" 필수항목입니다.");
			frm.elements[i].value = "";
			frm.elements[i].focus();
			return false;
		}
	}
	if(frm.pwd.value!=frm.pwd_re.value){
		alert('비밀번호가 일치하지 않습니다.');
		return false;
	}
}
function Check_Cash(){
	if(document.all.cash_mode[0].checked==true){
		document.all.online1.style.display='none';
	}else if(document.all.cash_mode[1].checked==true){
		document.all.online1.style.display='none';
	}else{
		document.all.online1.style.display='block';
	}
}

function Check_Cash2(no){
	if(document.all.rcp_s_1[0].checked) {
		document.getElementById("rcp_tr_1").style.display = "block"
	}else if(document.all.rcp_s_1[1].checked) {
		document.getElementById("rcp_tr_1").style.display = "none"
	}

	if(document.all.rcp_s_2[0].checked) {
		document.getElementById("rcp_tr_4").style.display = "block"
		document.getElementById("rcp_tr_5").style.display = "none"
		document.getElementById("rcp_tr_6").style.display = "none"
	}else if(document.all.rcp_s_2[1].checked) {
		document.getElementById("rcp_tr_4").style.display = "none"
		document.getElementById("rcp_tr_5").style.display = "block"
		document.getElementById("rcp_tr_6").style.display = "none"
	}else if(document.all.rcp_s_2[2].checked) {
		document.getElementById("rcp_tr_4").style.display = "none"
		document.getElementById("rcp_tr_5").style.display = "none"
		document.getElementById("rcp_tr_6").style.display = "block"
	}

}

function embed_write(val){
	document.write("<embed src='"+val+"' width='500px' height='400px' allowScriptAccess='always' type='application/x-shockwave-flash' allowFullScreen='true' bgcolor='#000000' ></embed>");
}

function onlyNumber(){

	if(event.keyCode>=48&&event.keyCode<=57||event.keyCode==8||event.keyCode==46||event.keyCode==37||event.keyCode==39){

	}else{
		if(event.preventDefault){
			event.preventDefault();
		}else{
			event.returnValue=false;
		}
	}
}

function onlyAlphaNumer() {
	if(event.keyCode == 13 || event.keyCode == 16 || event.keyCode == 20 || event.keyCode == 45 || event.keyCode == 46 || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 97 && event.keyCode <= 122)){

	}else{
		if(event.preventDefault){
			event.preventDefault();
		}else{
			event.returnValue=false;
		}

	}
}


//***************************************************************************
// Function : evaltostr
// Description : 문자열 두자리를 수치로 치환
// Argument : str - string
//			  i - int( 위치 )
// Return : int - (i)*10 + (i+1)
// Event :
//***************************************************************************
function evaltostr(str, i) {
	var j1 = eval(str.value.charAt(i));
	var j2 = eval(str.value.charAt(i+1));
	var j = j1*10 + j2;
	return j;
}



function getCookie(name){
	var Found = false
	var start, end
	var i = 0

	while(i <= document.cookie.length){
		start = i
		end = start + name.length
		if(document.cookie.substring(start, end) == name){
			Found = true
			break
		}
		i++
	}

	if(Found == true){
		start = end + 1
		end = document.cookie.indexOf(";", start)
		if(end < start)
		end = document.cookie.length
		return document.cookie.substring(start, end)
	}
	return ""
}

function getCookie2(name){
	var from_idx = document.cookie.indexOf(name+'=');
	if (from_idx != -1) {
		from_idx += name.length + 1
		to_idx = document.cookie.indexOf(';', from_idx)

		if (to_idx == -1) {
			to_idx = document.cookie.length
		}
		return unescape(document.cookie.substring(from_idx, to_idx))
	}
}


function setCookie( name, value, expirehours ) {
	var todayDate = new Date();
	todayDate.setHours( todayDate.getHours() + expirehours );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";";
}

function setCookie2( name, value, expiredays ) {
    var todayDate = new Date();
    todayDate.setDate( todayDate.getDate() + expiredays );
    document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

function clearCookie(name){
	var expire_date = new Date();
	//어제 날짜를 쿠키 소멸 날짜로 설정한다.
	expire_date.setDate(expire_date.getDate() - 10);
	document.cookie = name + "= " + "; expires=" + expire_date.toGMTString() + "; path=/";
}

function getPosition(e){
	try
	{
		var mouseX = e.pageX ? e.pageX : document.documentElement.scrollLeft + event.clientX;
		var mouseY = e.pageX ? e.pageX : document.documentElement.scrollLeft + event.clientY;
	}
	catch (e)
	{
		var mouseX = document.body.offsetWidth - 350;
		var mouseY = document.body.offsetHeight - 400;
	}

    return {x: mouseX, y: mouseY};
}

function flashWrite3(val,width,height){
	document.write("<embed src='"+val+"' width='"+width+"' height='"+height+"' allowScriptAccess='always' type='application/x-shockwave-flash' allowFullScreen='true'  wmode=transparent></embed>");
}


function search_addr(type){
	window.open('/post.php?gubun='+type,'searchaddress','width=800,height=500,scrollbars=yes');
}


var c=false;
// 포커스가 인풋 박스안에 있을때 배경이미지 지우기
function Img_in (value) {
        input_img.skeyword.style.backgroundImage="url(/images/main/banner_search_bg_03.jpg)";
        c=true;
}

// 포커스가 인풋 박스를 벗어났을때 배경이미지 살리기 (입력값이 있으면 살리지 않기)
function Img_out (value) {
        if (value != ""){
         input_img.skeyword.style.backgroundImage="url(/images/main/banner_search_bg_03.jpg)";
         }else{
        input_img.skeyword.style.backgroundImage="url(/images/main/banner_search_bg_02.jpg)";
        c= false;
        }
}

function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3)
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}



function resizeBoardImage(imageWidth, borderColor) {
    var target = document.getElementsByName('target_resize_image[]');
    var imageHeight = 0;

    if (target) {
        for(i=0; i<target.length; i++) {
            // 원래 사이즈를 저장해 놓는다
            target[i].tmp_width  = target[i].width;
            target[i].tmp_height = target[i].height;
            // 이미지 폭이 테이블 폭보다 크다면 테이블폭에 맞춘다
            if(target[i].width > imageWidth) {
                imageHeight = parseFloat(target[i].width / target[i].height)
                target[i].width = imageWidth;
                target[i].height = parseInt(imageWidth / imageHeight);
                target[i].style.cursor = 'pointer';

                // 스타일에 적용된 이미지의 폭과 높이를 삭제한다
                target[i].style.width = '';
                target[i].style.height = '';
            }

            if (borderColor) {
                target[i].style.borderWidth = '1px';
                target[i].style.borderStyle = 'solid';
                target[i].style.borderColor = borderColor;
            }
        }
    }
}


function image_window(img){

	var w = img.tmp_width;
	var h = img.tmp_height;
	var winl = (screen.width-w)/2;
	var wint = (screen.height-h)/3;
	if (w >= screen.width) {
		winl = 0;
		h = (parseInt)(w * (h / w));
	}

	if (h >= screen.height) {
		wint = 0;
		w = (parseInt)(h * (w / h));
	}

	var js_url = "<script type='text/javascript'> \n";
		js_url += "<!-- \n";
		js_url += "var ie=document.all; \n";
		js_url += "var nn6=document.getElementById&&!document.all; \n";
		js_url += "var isdrag=false; \n";
		js_url += "var x,y; \n";
		js_url += "var dobj; \n";
		js_url += "function movemouse(e) \n";
		js_url += "{ \n";
		js_url += "  if (isdrag) \n";
		js_url += "  { \n";
		js_url += "    dobj.style.left = nn6 ? tx + e.clientX - x : tx + event.clientX - x; \n";
		js_url += "    dobj.style.top  = nn6 ? ty + e.clientY - y : ty + event.clientY - y; \n";
		js_url += "    return false; \n";
		js_url += "  } \n";
		js_url += "} \n";
		js_url += "function selectmouse(e) \n";
		js_url += "{ \n";
		js_url += "  var fobj      = nn6 ? e.target : event.srcElement; \n";
		js_url += "  var topelement = nn6 ? 'HTML' : 'BODY'; \n";
		js_url += "  while (fobj.tagName != topelement && fobj.className != 'dragme') \n";
		js_url += "  { \n";
		js_url += "    fobj = nn6 ? fobj.parentNode : fobj.parentElement; \n";
		js_url += "  } \n";
		js_url += "  if (fobj.className=='dragme') \n";
		js_url += "  { \n";
		js_url += "    isdrag = true; \n";
		js_url += "    dobj = fobj; \n";
		js_url += "    tx = parseInt(dobj.style.left+0); \n";
		js_url += "    ty = parseInt(dobj.style.top+0); \n";
		js_url += "    x = nn6 ? e.clientX : event.clientX; \n";
		js_url += "    y = nn6 ? e.clientY : event.clientY; \n";
		js_url += "    document.onmousemove=movemouse; \n";
		js_url += "    return false; \n";
		js_url += "  } \n";
		js_url += "} \n";
		js_url += "document.onmousedown=selectmouse; \n";
		js_url += "document.onmouseup=new Function('isdrag=false'); \n";
		js_url += "//--> \n";
		js_url += "</"+"script> \n";

	var settings;

	settings  ='width='+w+',';
	settings +='height='+h+',';
	settings +='top='+wint+',';
	settings +='left='+winl+',';
	settings +='scrollbars=no,';
	settings +='resizable=yes,';
	settings +='status=no';

	win=window.open("","image_window",settings);
	win.document.open();
	win.document.write ("<html><head> \n<meta http-equiv='imagetoolbar' CONTENT='no'> \n<meta http-equiv='content-type' content='text/html; charset=utf-8'>\n");
	var size = "이미지 사이즈 : "+w+" x "+h;
	win.document.write ("<title>"+size+"</title> \n");
	if(w >= screen.width || h >= screen.height) {
		win.document.write (js_url);
		var click = "ondblclick='window.close();' style='cursor:move' title=' "+size+" \n\n 이미지 사이즈가 화면보다 큽니다. \n 왼쪽 버튼을 클릭한 후 마우스를 움직여서 보세요. \n\n 더블 클릭하면 닫혀요. '";
	}
	else
		var click = "onclick='window.close();' style='cursor:pointer' title=' "+size+" \n\n 클릭하면 닫혀요. '";
	win.document.write ("<style>.dragme{position:relative;}</style> \n");
	win.document.write ("</head> \n\n");
	win.document.write ("<body leftmargin=0 topmargin=0 bgcolor=#dddddd style='cursor:arrow;'> \n");
	win.document.write ("<table width=100% height=100% cellpadding=0 cellspacing=0><tr><td align=center valign=middle><img src='"+img.src+"' width='"+w+"' height='"+h+"' border=0 class='dragme' "+click+"></td></tr></table>");
	win.document.write ("</body></html>");
	win.document.close();

	if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}

function openDaumPostcode(type) {
	new daum.Postcode({
		oncomplete: function(data) {
			var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');

			if (type==2) 	{
				document.getElementById('post2').value = data.zonecode;
				document.getElementById('addr3').value = addr;
				document.getElementById('addr4').focus();
			} else {
				document.getElementById('post').value = data.zonecode;
				document.getElementById('addr1').value = addr;
				document.getElementById('addr2').focus();
			}
		}
	}).open();
}






var _keyStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';

// -- encoding function

function base64_encode(input) {
   var output = ''
     ,chr1, chr2, chr3, enc1, enc2, enc3, enc4
     ,i = 0;

// get keyCode

function _keyStrCharAt() {
   var ar=arguments, i, ov='';

  for (i=0; i<ar.length; i++) ov+=_keyStr.charAt(ar[i]);

  return ov;
   }

// get utf8

function _utf8_encode(string) {

  string = string.replace(/\r\n/g,'\n');
   var utftext = '', c;

   for (var n = 0; n < string.length; n++) {

     var c = string.charCodeAt(n);

     if (c < 128)
       utftext += String.fromCharCode(c);
     else if((c > 127) && (c < 2048))
       utftext += String.fromCharCode((c >> 6) | 192, (c & 63) | 128);
     else
       utftext += String.fromCharCode((c >> 12) | 224, ((c >> 6) & 63) | 128, (c & 63) | 128);
     }

  return utftext;
 }

// main

  input = _utf8_encode(input);

  while (i < input.length) {

    chr1 = input.charCodeAt(i++);
     chr2 = input.charCodeAt(i++);
     chr3 = input.charCodeAt(i++);

     enc1 = chr1 >> 2;
     enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
     enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
     enc4 = chr3 & 63;

     if (isNaN(chr2)) enc3 = enc4 = 64;
     else if (isNaN(chr3)) enc4 = 64;

    output +=_keyStrCharAt(enc1, enc2, enc3, enc4);
     }

  return output;
}

// -- decoding function

function base64_decode(input) {

// for optimzing

  function _keyStrindexOfinputcharAt(p) { return _keyStr.indexOf(input.charAt(p)); }

// put utf8

function _utf8_decode (utftext) {

  var string = '', i = 0, c, c2, c3;


  while ( i < utftext.length ) {
     c = utftext.charCodeAt(i);

     if (c < 128) {
       string += String.fromCharCode(c);
       i++;
       }
     else if((c > 191) && (c < 224)) {
       c2 = utftext.charCodeAt(i+1);
       string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
       i += 2;
       }
     else {
       c2 = utftext.charCodeAt(i+1);
       c3 = utftext.charCodeAt(i+2);
       string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
       i += 3;
       }

    }

  return string;
 }

// main

  var output = ''
     ,chr1, chr2, chr3
     ,enc1, enc2, enc3, enc4
     , i = 0;

   input = input.replace(/[^A-Za-z0-9\+\/\=]/g, '');

   while (i < input.length) {

     enc1 = _keyStrindexOfinputcharAt(i++);
     enc2 = _keyStrindexOfinputcharAt(i++);
     enc3 = _keyStrindexOfinputcharAt(i++);
     enc4 = _keyStrindexOfinputcharAt(i++);

     chr1 = (enc1 << 2) | (enc2 >> 4);
     chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
     chr3 = ((enc3 & 3) << 6) | enc4;

    output += String.fromCharCode(chr1);

     if (enc3 != 64) output += String.fromCharCode(chr2);
     if (enc4 != 64) output += String.fromCharCode(chr3);
     }
   output = _utf8_decode(output);

  return output;
   }



function Ajax_Request(sUrl,Result_Id,Method){
	var objXmlHttp = null;

	if(!Method){
		Method = "Post";
	}

	try {
		objXmlHttp = new XMLHttpRequest();
	} catch (trymicrosoft) {
		try {
			objXmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (othermicrosoft) {
			try {
				objXmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (failed) {
				objXmlHttp = null;
			}
		}
	}

	if (objXmlHttp == null) location.reload();

	objXmlHttp.open(Method, sUrl, false);
	objXmlHttp.send();

	if(objXmlHttp.responseText){
		$("#"+Result_Id).html(objXmlHttp.responseText);
		//document.getElementById(Result_Id).innerHTML =  objXmlHttp.responseText;
	}

}

function resizeBoardImage_M() {
    var target = document.getElementsByName('target_resize_image[]');
    var imageHeight = 0;

    if (target) {
        for(i=0; i<target.length; i++) {
			target[i].style.width = "95%";
        }
    }
}


var d_id = "list_result";
var method = "post";

function List_PageLoad(page_url,page){
	if(document.location.hash){
		var HashLocationName = document.location.hash;
		HashLocationName = HashLocationName.replace(/^.*#/, '');
		Ajax_Request(page_url+HashLocationName,d_id,method);
	}else{
		Ajax_Request(page_url+page,d_id,method);
	}
}

function Page_Go(url,page){
	document.location.hash = page;

	var page_url = url+page;

	List_PageLoad(page_url,page);
}


//사업자등록번호 유효성 체크
function check_BizRegNo(){
	var frm = document.form0;
	var bizID = frm.creg1.value+frm.creg2.value+frm.creg3.value;
	var checkID = new Array(1, 3, 7, 1, 3, 7, 1, 3, 5, 1);
	var i, Sum=0, c2, remander;

	bizID = bizID.replace(/-/gi,'');
	for (i=0; i<=7; i++){
		   Sum += checkID[i] * bizID.charAt(i);
	}
	c2 = "0" + (checkID[8] * bizID.charAt(8));
	c2 = c2.substring(c2.length - 2, c2.length);
	Sum += Math.floor(c2.charAt(0)) + Math.floor(c2.charAt(1));
	remander = (10 - (Sum % 10)) % 10 ;

	if(bizID.length != 10){
			alert("사업자등록번호를 정확히 입력하세요!");
			frm.creg1.value = '';
			frm.creg2.value = '';
			frm.creg3.value = '';
			frm.creg1.focus();
		   return;
	}else if (Math.floor(bizID.charAt(9)) != remander){
			alert("사업자등록번호를 정확히 입력하세요!");
			frm.creg1.value = '';
			frm.creg2.value = '';
			frm.creg3.value = '';
			frm.creg1.focus();
		   return;
	}

	alert('사업자등록번호가 인증되었습니다.');
	return;
}



function Add_G(){
	objTbl = document.getElementById("GroupOption");

	if((objTbl.rows.length-1)>=10){
		alert('최대 10개까지만 추가가능합니다.');
		return;
	}

	objRow = objTbl.insertRow(objTbl.rows.length);

	objCell = objRow.insertCell(0);
	objCell.innerHTML = "<select name=gName[] id=gName_"+(objTbl.rows.length-1)+"><option value=1>1인실</option><option value=2>2인실</option><option value=4>4인실</option><option value=6>6인실이상</option><option value=O>오픈스페이스</option><option value=D>Desk</option></select>";
	objCell.align			=	"left";
	objCell.valign		=	"middle";
	objCell.class			=	"tb_01";

	objCell = objRow.insertCell(1);
	objCell.innerHTML = "<select name=gPeriod[] id=gPeriod_"+(objTbl.rows.length-1)+"><option value=M>월</option><option value=D>일</option></select>";
	objCell.align			=	"right";
	objCell.valign		=	"middle";
	objCell.class			=	"tb_02";

	objCell = objRow.insertCell(2);
	objCell.innerHTML = "<input type=\"text\" name=\"gPrice[]\" id=gPrice_"+(objTbl.rows.length-1)+" onkeypress=\"onlyNumber();\" maxlength=\"10\" style=\"ime-mode:disabled;\">";
	objCell.align			=	"right";
	objCell.valign		=	"middle";
	objCell.class			=	"tb_03";
}


