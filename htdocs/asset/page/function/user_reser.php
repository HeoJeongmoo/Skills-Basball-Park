<?php
require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");

extract($_POST);
$sql = rowCount("SELECT * FROM `reservation` WHERE state='1' AND date='$date' AND time='$time'");

if(!isset($label) || !isset($date) || !isset($time) || !isset($number) || !isset($price)) {
    alert("모든값을 입력해주세요");
    back();
}

if($time == "not") {
    alert("매월 첫째주 월 새벽 04시는 예약이 불가능합니다");
    back();
}

if ($number < 20) {
    alert("최소인원은 20명 이상입니다");
    back();
} 

if($time == "full" || $time == "full") {
    alert("해당 날짜는 이미 예약이 있는 날짜입니다");
    back();
}

if(!$sql) {
    query("INSERT INTO `reservation`(`league`, `date`, `time`, `number`, `price`, `state`, `name`, `id`) VALUES ('$label','$date','$time','$number','$price','1', '$userName', '$idx')");
    alert("예약이 완료되었습니다");
    back();
}

if($sql) {
    query("INSERT INTO `reservation`(`league`, `date`, `time`, `number`, `price`, `state`, `name`, `id`) VALUES ('$label','$date','$time','$number','$price','3', '$userName', '$idx')");
    alert("예약이 완료되었습니다");
    back();
}

?>