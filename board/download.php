<?php
$file = $_GET['filename'];
$filepath = './uploads/'.$file;
$filesize = filesize($filepath);
$path_parts = pathinfo($filepath);
$extension = $path_parts['extension'];

header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$file");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

readfile($filepath);
?>