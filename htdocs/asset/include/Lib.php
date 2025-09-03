<?php 

$options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];
$db = new PDO("mysql:host=localhost; dbname=24jibang; charset=utf8mb4", "root", "", $options);

session_start();
date_default_timezone_set("Asia/Seoul");

$idx = isset($_SESSION['idx']) ? $_SESSION['idx'] : ""; 
$password = isset($_SESSION['password']) ? $_SESSION['password'] : ""; 
$userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : ""; 
$userNumber = isset($_SESSION['userNumber']) ? $_SESSION['userNumber'] : ""; 
$date = isset($_SESSION['date']) ? $_SESSION['date'] : ""; 

// insert, delete
function query($sql, $b=null) {
    $rs = $GLOBALS['db']->prepare($sql);
    $rs->execute($b);
    return $rs;
}

// select
function fetch($sql, $b=null) {
    $rs = query($sql, $b);
    $rs = $rs->fetch();
    return $rs;
}

// selectAll
function fetchAll($sql, $b=null) {
    $rs = query($sql, $b);
    $rs = $rs->fetchAll();
    return $rs;
}

// select 중복확인같은거
function rowCount($sql, $b=null) {
    $rs = query($sql, $b);
    $rs = $rs->rowCount();
    return $rs;
}

function alert($msg) {
    echo "<script>alert('$msg')</script>";
}

function back() {
    echo "<script>history.back()</script>";
    exit();
}

function move($url) {
    echo "<script>location.replace('$url')</script>";
    exit();
}

$url = $_SERVER['REQUEST_URI'];

if(!isset($_GET['url'])) {
    $page_set = 'index';
} else {
    $cur = explode("/", $_GET['url']);
    $page_set = isset($cur[0]) ? $cur[0] : "";
    $no = isset($cur[1]) ? $cur[1] : "";
    $no2 = isset($cur[2]) ? $cur[2] : "";
}

extract($_POST);