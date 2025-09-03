<?php
require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");

$count = $_POST['count'];
query("UPDATE `reservation` SET state='4' WHERE count='$count'");
alert("삭제가 완료되었습니다");
back();