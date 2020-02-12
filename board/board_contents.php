<?php
    session_start();
    if(!isset($_SESSION['logined_id'])){
        echo "<script>alert('로그인이 필요합니다.');location.href='/login/login.html'</script>";
        exit;
    }

    include("../db_connect.php");
    include("../sqli_shield.php");
    $connect = db_connect();

    $contents_title = $_GET['title'];
    $contents_num = $_GET['num'];

    $contents_title = mysqli_real_escape_string($connect, $contents_title);
    $contents_num = mysqli_real_escape_string($connect, $contents_num);
    $contents_num = (int)$contents_num;

    $contents_select_query = "SELECT * FROM board WHERE num='$contents_num'&&title='$contents_title'";
    $contents_query_result = mysqli_query($connect, $contents_select_query);

    while($contents_result = mysqli_fetch_array($contents_query_result)){
        echo "글번호 : ".$contents_result['num']."</br>";
        echo "제목 : ".$contents_result['title']."</br>";
        echo "내용: ".$contents_result['contents']."</br>";
        echo "작성자: ".$contents_result['writer']."</br>";
        echo "작성시간: ".$contents_result['time']."</br>";

        $board_writer = $contents_result['writer'];
        $board_num = $contents_result['num'];

        $board_writer = mysqli_real_escape_string($connect, $board_writer);
        $board_num = mysqli_real_escape_string($connect, $board_num);
        $board_num = (int)$board_num;

        if($contents_result['filename']){
            $file = $contents_result['filename'];
            echo "업로드된 파일 : <a href='download.php?num=$board_num'>$file</a></br></br>";
        }
        
    }?>

    <input type='button' name='backbtn' value='목록으로' onclick='history.back()'>
    <form name='board_delete_form' method = 'post' action='board_delete.php'>
        <input type='hidden' name= 'board_num' value = '<?php echo $board_num;?>'> 
        <input type='submit' value='글 삭제'>
    </form>
</br>

    <?php
    echo "댓글</br>";
    $comment_select_query = "SELECT * FROM comment WHERE boardnum=$board_num";
    $comment_query_result = mysqli_query($connect, $comment_select_query);
    while($comment_result = mysqli_fetch_array($comment_query_result)){
        echo "내용: ".$comment_result['contents']."</br>";
        echo "작성자: ".$comment_result['writer']."</br>";
        echo "작성시간: ".$comment_result['time']."</br>";
        $comment_num = $comment_result['commentnum'];
        $comment_writer = $comment_result['writer'];

        $comment_num = mysqli_real_escape_string($connect, $comment_num);
        $comment_writer = mysqli_real_escape_string($connect, $comment_writer);
        $comment_num = (int)$comment_num;

        echo "<form name='board_delete_form' method = 'post' action='comment_delete.php'>
        <input type='hidden' name= 'comment_num' value = '$comment_num'>
        <input type='submit' value='댓글 삭제'>
        </form>";

    }
?>
</br></br>
<form name='comment_create_form' method = 'post' action='comment_create.php'>
        <input type='hidden' name= 'board_num2' value = <?php echo $board_num?>>
		<textarea cols="40" rows="10" name="comment_contents" placeholder="댓글을 입력하세요"></textarea>
		<input type="submit" value = "댓글작성">
    </form>