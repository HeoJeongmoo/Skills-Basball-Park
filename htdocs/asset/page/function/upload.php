<?php

require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");

$file = "";
if (isset($_FILES['file']['name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    $fileName = date("YmdHis") . "_" . basename($_FILES['file']['name']);
    $uploadFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        if( file_exists($uploadFile) ) $file = $fileName;
    }
}

isset($name) ? $name : "";
isset($detail) ? $detail : "";

query("INSERT INTO `cart`(`name`, `img`, `inter`, `detail`, `price`) VALUES ('$name','$file','1','$detail', '$price')");
alert("상품이 등록되었습니다");
back();