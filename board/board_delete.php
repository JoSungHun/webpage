<?php
session_start();
if(!isset($_SESSION['logined_id'])){
    echo "<script>alert('로그인이 필요합니다.');location.href='/login/login.html'</script>";
    exit;
}

include("../db_connect.php");
include("../sqli_shield.php");
$connect = db_connect();

$delete_board_num = $_POST['board_num'];
$logined_id = $_SESSION['logined_id'];


$delete_board_num = mysqli_real_escape_string($connect, $delete_board_num);
$logined_id = mysqli_real_escape_string($connect, $logined_id);

$board_delete_query = "DELETE FROM board WHERE num = $delete_board_num && writer = '$logined_id'";
$select_board_query = "SELECT writer FROM board WHERE num = $delete_board_num";

$select_board_query_result = mysqli_query($connect, $select_board_query);
$select_board_result = mysqli_fetch_array($select_board_query_result);
$real_writer = $select_board_result['writer'];
$real_writer = mysqli_real_escape_string($connect, $real_writer);

if($logined_id == $real_writer or $logined_id == "root"){
        
        $delete_query_result = mysqli_query($connect, $board_delete_query);

        if($delete_query_result === TRUE){
            echo "<script>alert('글 삭제 성공');location.href='board_list.php'</script>";
        }else{
            echo "<script>alert('ERROR');history.back();</script>";
        }
    }else{
        echo "<script>alert('글 작성자가 아닙니다.');history.back();</script>";
    }

?>