<?php
    session_start();
    
    include('../db_connect.php');
    $connect = db_connect();

    $board_num = $_POST['board_num2'];
    $comment_contents = $_POST['comment_contents'];
    $user = $_SESSION['logined_id'];

    echo "contents : ".$comment_contents."</br>";
    echo "board_num : ".$board_num."</br>";
    echo "user : ".$user."</br>";

    $comment_create_query = "INSERT INTO comment VALUES ($board_num, 0, '$comment_contents', '$user', NOW())";
    echo "query : ".$write_query."</br>";
    $comment_query_result = mysqli_query($connect, $comment_create_query);
    

    if($comment_query_result === TRUE){
        echo "<script>alert('댓글 작성 성공');history.back();</script>";
    }else{
        echo "<script>alert('ERROR');history.back();</script>";
    }
    
    ?>