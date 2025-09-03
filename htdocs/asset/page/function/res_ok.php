<?php
require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");
$count = $_POST['count'];

$sql = query("UPDATE `reservation` SET `state`='2' WHERE count=$count");
alert("승인이 완료되었습니다");
back();