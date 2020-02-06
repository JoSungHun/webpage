<html>
<head>
	<title>Login Page</title>
</head>
<body>
	<?php
	include("../db_connect.php");
	$connect = db_connect();
	
	$login_id = $_POST['id'];
	$login_pw = $_POST['pw'];
	
	$login_query = "SELECT pw FROM user WHERE id = '$login_id'";
	
	$query_result = mysqli_query($connect, $login_query);

	while($result = mysqli_fetch_array($query_result)){
		echo "result : ". $result[0]."<br/>";
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