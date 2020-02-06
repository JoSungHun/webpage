<html>
<head>
	<title>regist Page</title>
</head>
<body>

    <?php
    include("../db_connect.php");
	$connect = db_connect();
    
    $regist_id = $_POST['id'];
	$regist_pw = $_POST['pw'];

    if($regist_id&&$regist_pw == NULL){
        echo "<script>alert('값을 입력해 주세요.');history.back();</script>";
        exit;
    }

    $overlap_check_query = "SELECT * FROM user WHERE id = '$regist_id'";
	$regist_query = "INSERT INTO user VALUES ('$regist_id', '$regist_pw')";

    /*
    if(mysqli_connect_errno()){
        echo "MYSQL 연결실패". mysqli_connect_errno();
        echo "<script>history.back();</script>";
    }else{
        echo "mysql 연결성공<br>";
    }*/
    $overlap_query_result = mysqli_query($connect, $overlap_check_query);

    while($overlap_result = mysqli_fetch_array($overlap_query_result)){
        if($overlap_result){
            echo "<script>alert('이미 존재하는 id 입니다.');history.back();</script>";
            exit;
        }
    }
    
    $query_result = mysqli_query($connect, $regist_query);

    if($query_result === TRUE){
        echo "<script>alert('회원가입성공');location.href='/index.php'</script>";
    }else{
        echo "<script>alert('ERROR');history.back();</script>";
    }
	
	mysqli_close($connect);
    ?>
    
</body>
</html>