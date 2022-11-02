<?php 
    include "../connect/session.php";
    include "../connect/connect.php";

    if(!isset($_SESSION['userMemberID']) ){ 
        echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
        }
    
    $comment = $_POST['comment'];
    $feedBackBoardId = $_POST['feedBackBoardID'];
    $commentId = $_POST['commentID'];
    
    $comment = $connect -> real_escape_string(trim($comment));
    $feedBackBoardId = $connect -> real_escape_string(trim($feedBackBoardId));
    $commentId = $connect -> real_escape_string(trim($commentId));
    $comment = nl2br($comment);
    // $regTime = time();

    $sql = "UPDATE feedBackComment SET comment = '$comment' WHERE feedBackBoardId = '$feedBackBoardId' AND commentId = '$commentId'";
    // echo $sql;
    $connect -> query($sql);  
?>
<script>
    history.back();
</script>