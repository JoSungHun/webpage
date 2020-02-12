<?php
    session_start();
    if(!isset($_SESSION['logined_id'])){
        echo "<script>alert('로그인이 필요합니다.');location.href='/login/login.html'</script>";
        exit;
    }

    include('../db_connect.php');
    include('../sqli_shield.php');
    $connect = db_connect();

    $board_num = $_POST['board_num2'];
    $comment_contents = $_POST['comment_contents'];
    $user = $_SESSION['logined_id'];

    $board_num = (int)$board_num;
    
    if(is_numeric($board_num) == false){
        echo "<script>alert('잘못된값입력');history.back();</script>";
        exit;
    }

    $board_num = mysqli_real_escape_string($connect, $board_num);
    $comment_contents = mysqli_real_escape_string($connect, $comment_contents);
    $user = mysqli_real_escape_string($connect, $user);

    $comment_contents = htmlspecialchars($comment_contents, ENT_HTML5 | ENT_QUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED);

    /*
    echo "contents : ".$comment_contents."</br>";
    echo "board_num : ".$board_num."</br>";
    echo "user : ".$user."</br>";
    */

    $comment_create_query = "INSERT INTO comment VALUES ($board_num, 0, '$comment_contents', '$user', NOW())";
    #echo "query : ".$write_query."</br>";
    $comment_query_result = mysqli_query($connect, $comment_create_query);
    
    if($comment_query_result === TRUE){
        echo "<script>alert('댓글 작성 성공');history.back();</script>";
    }else{
        echo "<script>alert('ERROR');history.back();</script>";
    }
    
    ?>