<?
if (!defined("__GAUTECH__")) exit; // 개별 페이지 접근 불가

// 임의의 md5 문자열을 생성
	$tmp_str = substr(md5(microtime()),0,10);
	// 난수 발생기
	list($usec, $sec) = explode(' ', microtime());
	$seed =  (float)$sec + ((float)$usec * 100000);
	srand($seed);
	$keylen = strlen($tmp_str);
	$div = (int)($keylen / 2);
	while (count($arr) < 3)
	{
		unset($arr);
		for ($i=0; $i<$keylen; $i++)
		{
			$rnd = rand(1, $keylen);
			$arr[$rnd] = $rnd;
			if ($rnd > $div) break;
		}
	}

	// 배열에 저장된 숫자를 차례대로 정렬
	sort($arr);

	$norobot_key = "";
	$norobot_str = "";
	$m = 0;
	for ($i=0; $i<count($arr); $i++)
	{
		for ($k=$m; $k<$arr[$i]-1; $k++)
			$norobot_str .= $tmp_str[$k];
		$norobot_str .= "<span class=font_red_b_12px><font color=red><b>{$tmp_str[$k]}</b></font></span>";
		$norobot_key .= $tmp_str[$k];
		$m = $k + 1;
	}

	if ($m < $keylen) {
		for ($k=$m; $k<$keylen; $k++)
			$norobot_str .= $tmp_str[$k];
	}

	$norobot_str = "<font color=#999999>$norobot_str</font>";

	$_SESSION["ss_norobot_key"] = $norobot_key;
	//setcookie("ck_norobot_key",$norobot_key,0,"/");

	echo "\n<script language='javascript'>
	var md5_norobot_key = '".md5($norobot_key)."';
	</script>\n";
	echo "<script src=\"/s_source/md5.js\"></script>\n";
?>