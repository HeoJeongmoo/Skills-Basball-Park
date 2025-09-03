<?php
require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");

$nameChk = '/^[가-힣]+$/u';
$cnk = '/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/';

if(!$name) {
    alert("이름을 입력해주세요");
    back();
}

if(!preg_match($nameChk, $name)) {
    alert("이름은 한글만 가능합니다");
    back();
}

if(!$id) {
    alert("아이디를 입력해주세요");
    back();
}

$sql = rowCount("SELECT * FROM `users` WHERE id='$id'");
if($sql) {  
    alert("아이디중복확인을 진행해주시기 바랍니다");
    back();
}

if(!preg_match($cnk, $id)) {
    alert("아이디는 영문과 숫자의 조합만 가능합니다.");
    back();
}

if(!$pass) {
    alert("비밀번호를 입력해주세요");
    back();
}

if(!preg_match($cnk, $pass)) {
    alert("비밀번호는 영문과 숫자의 조합만 가능합니다.");
    back();
}

if($_SESSION['captcha'] != $capt) {
    echo $_SESSION['captcha'];
	alert("자동가입방지문구를 틀렸습니다");
	back();
} else if($_SESSION['captcha'] == $capt) {
    query("INSERT INTO `users`(`id`, `pass`, `name`, `user`) VALUES ('$id','$pass','$name', '3')");
	alert("관리자 승인 대기 중입니다.");
    back();
}