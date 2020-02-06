<?php
function db_connect(){
    $host = 'localhost';
	$dbuser = 'root';
	$dbpw = 'root';
	$dbname = 'php_db';

    $connect = mysqli_connect($host, $dbuser, $dbpw, $dbname);
    
    if(mysqli_connect_errno()){
        echo "MYSQL 연결실패". mysqli_connect_errno();
        //echo "<script>history.back();</script>";
    }

    return $connect;
}
?>