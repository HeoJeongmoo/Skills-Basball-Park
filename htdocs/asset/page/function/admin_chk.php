<?php

require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");
extract($_POST);

$hue = isset($hue) ? $hue : "";
$time = isset($time) ? $time : "";

if($hue != "" && $time == "") {
    query("INSERT INTO `date`(`day`, `state`) VALUES ('$hue','1')");
    alert("해당 일자를 휴일로 정하셨습니다");
} else if($hue == "" && $time != "") {
    query("INSERT INTO `date`(`day`, `state`) VALUES ('$time','2')");
    alert("해당 시간을 휴일로 정하셨습니다");
} else if($hue == "휴일" || $time == "휴일") {
    alert("이미 휴일로 설정해있습니다");
}
back();