<?php
    session_start();
    if(!isset($_SESSION['logined_id'])){
        echo "<script>alert('로그인이 필요합니다.');location.href='/login/login.html'</script>";
        exit;
    }
    
    include('../db_connect.php');
    include('../sqli_shield.php');
    $connect = db_connect();

    //게시글 관련
    $write_title = $_POST['write_title'];
    $write_contents = $_POST['write_contents'];
    $user = $_SESSION['logined_id'];

    $write_title = mysqli_real_escape_string($connect, $write_title);
    $write_contents = mysqli_real_escape_string($connect, $write_contents);
    $user = mysqli_real_escape_string($connect, $user);
    
    $write_title = htmlspecialchars($write_title, ENT_HTML5 | ENT_QUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED);
    $write_contents = htmlspecialchars($write_contents, ENT_HTML5 | ENT_QUOTES | ENT_SUBSTITUTE | ENT_DISALLOWED);

    //파일 업로드 관련
    $uploads_dir = 'uploads';
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

    $error = $_FILES['upload_file']['error'];
    $name = $_FILES['upload_file']['name'];
    $exploded = explode('.', $name);
    $ext = array_pop($exploded);
    
    $name = mysqli_real_escape_string($connect, $name);

    if($error != UPLOAD_ERR_OK){
        switch($error){
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "파일이 너무 큽니다. ($error)";
                break;
            case UPLOAD_ERR_NO_FILE: //파일을 업로드 하지 않았을경우
                $write_query = "INSERT INTO board VALUES (0, '$write_title', '$write_contents', '$user', NOW(), NULL)";
                //echo "query : ".$write_query."</br>";
                $write_query_result = mysqli_query($connect, $write_query);
                

                if($write_query_result === TRUE){
                    echo "<script>alert('글 작성 성공');location.href='board_list.php'</script>";
                }else{
                    echo "<script>alert('ERROR');history.back();</script>";
                }
                exit;
                
            default:
                echo "파일이 제대로 업로드되지 않았습니다. ($error)";
        }
    }

    if(!in_array($ext, $allowed_ext)){
        echo "허용되지 않는 확장자입니다.";
        exit;
    }

    move_uploaded_file($_FILES['upload_file']['tmp_name'], "$uploads_dir/$name");
    
    //게시글 정보 출력
    // echo "title : ".$write_title."</br>";
    // echo "contents : ".$write_contents."</br>";
    // echo "user : ".$user."</br>";
    // echo "파일명 : ".$name."</br>";
    // echo "확장자 : ".$ext."</br>";
    // echo "파일형식 : ".$_FILES['upload_file']['type']."</br>";
    // echo "파일크기 : ".$_FILES['upload_file']['size']."</br>";
    
    $write_query = "INSERT INTO board VALUES (0, '$write_title', '$write_contents', '$user', NOW(), '$name')";
    //echo "query : ".$write_query."</br>";
    $write_query_result = mysqli_query($connect, $write_query);
    

    if($write_query_result === TRUE){
        echo "<script>alert('글 작성 성공');location.href='board_list.php'</script>";
    }else{
        echo "<script>alert('ERROR');history.back();</script>";
    }
    
    
    
    
    
    ?>