<?php
require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");

extract($_POST);

$sql = rowCount("SELECT `id`, `pass`, `name` FROM `users` WHERE id='$id' AND pass='$pass' AND user='$user'");
$cnk = fetch("SELECT * FROM `users` WHERE id='$id'");
$date = date("Y-m-d");

if($sql) {
    $_SESSION['date'] = $date;
    fetch("UPDATE `users` SET `date`='$date' WHERE id='$id'");
    $_SESSION['idx'] = $id;
    $_SESSION['password'] = $pass;
    $_SESSION['userName'] = $cnk->name;
    $_SESSION['userNumber'] = $user;
    move("/index");
} else {
    alert("회원구분, 아이디 또는 비밀번호를 확인해주세요.");
    back();
}