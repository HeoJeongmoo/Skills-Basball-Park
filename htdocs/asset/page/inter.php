<?php
$count = $_POST['count']; 

query("UPDATE `cart` SET `inter`='2' WHERE $count");
alert("관심 굿즈 등록에 성공하였습니다");