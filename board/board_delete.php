<?php
session_start();
include("../db_connect.php");

$delete_board_num = $_POST['board_num'];
$delete_board_writer = $_POST['board_writer'];

$board_delete_query = "DELETE FROM board WHERE num = $delete_board_num";

if(isset($_SESSION['logined_id'])){
    $logined_id = $_SESSION['logined_id'];
    if($logined_id == $delete_board_writer or $logined_id == "root"){
        
        $connect = db_connect();
        $delete_query_result = mysqli_query($connect, $board_delete_query);

        if($delete_query_result === TRUE){
            echo "<script>alert('글 삭제 성공');location.href='board_list.php'</script>";
        }else{
            echo "<script>alert('ERROR');history.back();</script>";
        }
    }else{
        echo "<script>alert('글 작성자가 아닙니다.');history.back();</script>";
    }
    

}else{
    echo "<script>alert('로그인을 해주세요');location.href ='/login/login.html'</script>";
}


?>