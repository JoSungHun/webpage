<?php
    session_start();
    include("../db_connect.php");
    $connect = db_connect();

    $contents_title = $_GET['title'];

    $contents_select_query = "SELECT * FROM board WHERE title=$contents_title";
    $contents_query_result = mysqli_query($connect, $contents_select_query);
    while($contents_result = mysqli_fetch_array($contents_query_result)){
        echo "글번호 : ".$contents_result['num']."</br>";
        echo "제목 : ".$contents_result['title']."</br>";
        echo "내용: ".$contents_result['contents']."</br>";
        echo "작성자: ".$contents_result['writer']."</br>";
        echo "작성시간: ".$contents_result['time']."</br>";
        if($contents_result['filename']){
            $file = $contents_result['filename'];
            echo "업로드된 파일 : <a href='download.php?filename=$file'>$file</a></br></br>";
        }
        
        $board_writer = $contents_result['writer'];
        $board_num = $contents_result['num'];
    }?>

    <input type='button' name='backbtn' value='목록으로' onclick='history.back()'>
    <form name='board_delete_form' method = 'post' action='board_delete.php'>
        <input type='hidden' name= 'board_num' value = '<?php echo $board_num;?>'/>
        <input type='hidden' name= 'board_writer' value = '<?php echo $board_writer;?>'/> 
        <input type='submit' value='글 삭제'/>
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

        echo "<form name='board_delete_form' method = 'post' action='comment_delete.php'>
        <input type='hidden' name= 'comment_num' value = '$comment_num'/>
        <input type='hidden' name= 'comment_writer' value = '$comment_writer'/> 
        <input type='submit' value='댓글 삭제'>
        </form>";

    }
?>
</br></br>
<form name='comment_create_form' method = 'post' action='comment_create.php'>
        <input type='hidden' name= 'board_num2' value = '<?php echo $board_num;?>'/>
		<textarea cols="40" rows="10" name="comment_contents" placeholder="댓글을 입력하세요"></textarea>
		<input type="submit" value = "댓글작성">
    </form>