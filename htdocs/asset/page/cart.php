<?php

extract($_POST);
query("UPDATE `cart` SET `state`='1' WHERE count='$count'");
$sql = fetch("SELECT * FROM `cart` WHERE count='$count'");

if($sql->state == 1) {
    query("UPDATE `cart` SET `state`='1' WHERE count='$count'");
    alert("장바구니 등록이 완료되었습니다");
    move('/mypage#cartlist');
}  else {
    alert("이미 구매한 상품입니다");
    move('/sub04');
}