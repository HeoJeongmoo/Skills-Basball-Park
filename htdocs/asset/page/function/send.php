<?php

require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");

$sql = fetchAll("SELECT * FROM `reservation` WHERE state=6");

foreach($sql as $item) {
    if($item->date == $days && $item->time == $times) {
        echo "success";
    }
}