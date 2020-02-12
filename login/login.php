<html>
<head>
	<title>Login Page</title>
</head>
<body>
	<?php
	include("../db_connect.php");
	include("../sqli_shield.php");
	$connect = db_connect();
	
	$login_id = $_POST['id'];
	$login_pw = $_POST['pw'];

	if($login_id&&$login_pw == NULL){
        echo "<script>alert('값을 입력해 주세요.');history.back();</script>";
        exit;
    }
    if(sqli_preg($login_id)== false){
        echo "<script>alert('로그인실패');history.back();</script>";
        exit;
    }
    if(sqli_preg($login_pw)== false){
        echo "<script>alert('로그인실패');history.back();</script>";
        exit;
    }

	$login_id = mysqli_real_escape_string($connect, $login_id);
	$login_pw = mysqli_real_escape_string($connect, $login_pw);
	
	$login_query = "SELECT pw FROM user WHERE id = '$login_id'";
	
	$query_result = mysqli_query($connect, $login_query);

	if($query_result ===false){
		echo "<script>alert('로그인실패');history.back();</script>";
	}

	while($result = mysqli_fetch_array($query_result)){
		if ($result[0] == $login_pw){
			session_start();
			$_SESSION['logined_id'] = $login_id;
			echo "<script>alert('로그인성공');location.href ='/index.php'</script>";
		}else{
			echo "<script>alert('로그인실패');history.back();</script>";
		}
	}

	mysqli_close($connect);
	?>
</body>
</html>