<?php
session_start();
include("../db_connect.php");

$delete_comment_num = $_POST['comment_num'];
$delete_comment_writer = $_POST['comment_writer'];

echo "comment_num : ".$delete_comment_num."</br>";
echo "comment_writer : ".$delete_comment_writer."</br>";

$comment_delete_query = "DELETE FROM comment WHERE commentnum = $delete_comment_num";

if(isset($_SESSION['logined_id'])){
    $logined_id = $_SESSION['logined_id'];
    if($logined_id == $delete_comment_writer or $logined_id == "root"){
        
        $connect = db_connect();
        $delete_query_result = mysqli_query($connect, $comment_delete_query);

        if($delete_query_result === TRUE){
            echo "<script>alert('댓글 삭제 성공');history.back();</script>";
        }else{
            echo "<script>alert('ERROR');history.back();</script>";
        }
    }else{
        echo "<script>alert('댓글 작성자가 아닙니다.');history.back();</script>";
    }
    

}else{
    echo "<script>alert('로그인을 해주세요');location.href ='/login/login.html'</script>";
}


?>
?>