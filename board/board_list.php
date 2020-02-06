<html>
<head>
	<title>board</title>
</head>
<body>
	<h1>this is board page</h1>
	<?php
	session_start();

	include("../db_connect.php");
	$connect = db_connect();
	?>
	<input type='button' name='writebtn' value='글작성' onclick= 'location.href="board_write.html"'></br>

	<?php
	$title_select_query = "SELECT title FROM board";
	$title_select_result = mysqli_query($connect, $title_select_query);

	while($title_result = mysqli_fetch_array($title_select_result)){
		echo "<a href =board_contents.php?title='$title_result[title]'>제목 :".$title_result['title']."</a><br>";
	}
	

	mysqli_close($connect);
	
	?>
</body>
</html>