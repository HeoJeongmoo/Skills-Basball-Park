<?php

extract($_POST);
$sql = fetch("SELECT * FROM `cart` WHERE count='$count'");

if($number == "") {
    alert("수량을 다시 확인해주세요");
    back();
} else {
    query("INSERT INTO `buy`(`name`, `content`, `price`, `number`, `img`, `state`) VALUES ('$sql->name','$sql->detail','$price','$number','$sql->img', '2')");
    alert("구매가 완료되었습니다");
    move('/mypage#buy-list');
}