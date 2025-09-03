<?php
require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");
$row = rowCount("select * from users where id='$id'");

if($row == 1 || $id == "admin" || $id == "manager") {
    echo "fail";
} else if($id == "") {
    echo "null";   
} else if(!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/", $id)) {
    echo "non";
} else {
    echo "success";
}