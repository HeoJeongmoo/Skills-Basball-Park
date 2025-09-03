<?php
require_once($_SERVER['DOCUMENT_ROOT']."/asset/include/Lib.php");
session_destroy();
alert("로그아웃이 완료되었습니다");
back();