<?php
session_start();
if(!isset($_SESSION['logined_id'])){
    echo "<script>alert('로그인이 필요합니다.');location.href='/login/login.html'</script>";
    exit;
}

include("../db_connect.php");
include("../sqli_shield.php");
$connect = db_connect();

// $file = $_GET['filename'];
$board_num = $_GET['num'];
$board_num = mysqli_real_escape_string($connect, $board_num);
$board_num = (int)$board_num;

$select_filename_query = "SELECT filename FROM board WHERE num=$board_num";
$select_query_result = mysqli_query($connect, $select_filename_query);
$query_result = mysqli_fetch_array($select_query_result);
$file = $query_result['fileename'];

$filepath = './uploads/'.$file;
$filesize = filesize($filepath);
$path_parts = pathinfo($filepath);
$extension = $path_parts['extension'];

header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$file");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

readfile($filepath);
?>