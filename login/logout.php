<?php
session_start();
if(!isset($_SESSION['logined_id'])){
    echo "<script>alert('로그인이 필요합니다.');location.href='/login/login.html'</script>";
    exit;
}

session_destroy();
echo "<script>alert('로그아웃 성공');history.back();</script>";
?>