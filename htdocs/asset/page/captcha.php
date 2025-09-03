<?php
	session_start();
	header('Content-Type: image/gif');

	$captcha = '';
	$pattern = '123456789QWEERTYUIOPASZDFGHJKLZMXNCBVqpwoeirutyalskdjfhgzmxncbv'; //패턴 설정
	for ($i = 0, $len = strlen($pattern) - 1; $i < 5; $i++) { //6가지 문자 생성
		$captcha .= $pattern[rand(0, $len)];
	}

	$_SESSION['captcha'] = $captcha;
	
	$img = imagecreatetruecolor(60, 20); 
	imagefilledrectangle($img, 0,0,100,100,0xc80000);
	imagestring($img, 5, 6, 3, $captcha, 0xffffff); //문자 여백, 문자색상
	imageline($img,0,rand() % 20,100,rand() % 20, 0x001458); //줄 색상 
	imagegif($img);
	imagedestroy($img);
?>