<html>
<head>
	<title>jsh site </title>
</head>
<?php
session_start();
if(isset($_SESSION['logined_id'])){?>
<body>
	<h1>Hello <?php echo $_SESSION['logined_id']; ?></h1>
	<a href="login/logout.php"><h2>
		logout!
		</h2></a>
	<a href="board/board_list.php"><h2>
		go to boardpage
		</h2></a>
</body>
<?php
}else{?>
	<body>
	<h1>Hello </h1>
	<a href="login/login.html"><h2>
		go to loginpage
		</h2></a>
	<a href="board/board_list.php"><h2>
		go to boardpage
		</h2></a>
</body>
<?php
}
?>
</html>