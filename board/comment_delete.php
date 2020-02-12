<?php
session_start();
if(!isset($_SESSION['logined_id'])){
    echo "<script>alert('로그인이 필요합니다.');location.href='/login/login.html'</script>";
    exit;
}

include("../db_connect.php");
include("../sqli_shield.php");

$connect = db_connect();

$delete_comment_num = $_POST['comment_num'];
$logined_id = $_SESSION['logined_id'];

$delete_comment_num = mysqli_real_escape_string($connect, $delete_comment_num);
$logined_id = mysqli_real_escape_string($connect, $logined_id);

$select_comment_query = "SELECT writer FROM comment WHERE commentnum = $delete_comment_num";
$comment_delete_query = "DELETE FROM comment WHERE commentnum = $delete_comment_num && writer = '$logined_id'";

$select_comment_query_result = mysqli_query($connect, $select_comment_query);
$select_comment_result = mysqli_fetch_array($select_comment_query_result);
$real_writer = $select_comment_result['writer'];
$real_writer = mysqli_real_escape_string($connect, $real_writer);

if($logined_id == $real_writer or $logined_id == "root"){
        
    $delete_query_result = mysqli_query($connect, $comment_delete_query);

    if($delete_query_result === TRUE){
        echo "<script>alert('댓글 삭제 성공');history.back();</script>";
    }else{
        echo "<script>alert('ERROR');history.back();</script>";
    }
}else{
    echo "<script>alert('댓글 작성자가 아닙니다.');history.back();</script>";
}
?>