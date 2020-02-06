<?php echo 'okok';

$db = mysqli_connect("localhost", "root", "root", "php_db");

/*
if (mysqli_connect_errno()){
    echo "Failed to connect to MYSQL: " . mysqli_connect_errno();
}*/

if ($db){
    echo "성공";
}else{
    echo "실패";
}

mysqli_close($db);
?>