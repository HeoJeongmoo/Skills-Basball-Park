<?php

require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");
$count = $_POST['count'];

$sql = fetchAll("SELECT * FROM `reservation` WHERE `count`=$count");

foreach($sql as $item) {
    query("INSERT INTO `date`(`day`, `state`) VALUES ('$item->date','3')");
    query("INSERT INTO `date`(`day`, `state`) VALUES ('$item->time','4')");
}
query("UPDATE `reservation` SET `state`= 6 WHERE `count`=$count");
alert("결제완료가 완료되었습니다");
back();