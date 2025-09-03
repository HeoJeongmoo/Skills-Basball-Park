<?php
require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");
if(isset($_POST['delete'])) {
    $delete = $_POST['delete'];
    foreach($delete as $item) {
        if(!fetchAll("SELECT * FROM `reservation` WHERE count = '$item' AND (state = '1' OR state = '2')")) {
            query("UPDATE `reservation` SET state='4' WHERE count='$item'");
        } else {
            alert("예약 승인이 가능한 예약은 삭제가 불가능합니다");
            back();
        }
    }
}
back();
?>