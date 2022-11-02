<?php 
    include "../connect/session.php";
    include "../connect/connect.php";

    if(!isset($_SESSION['userMemberID']) ){ 
        echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
        }
    
    $comment = $_POST['comment'];
    $categgoryBoardID = $_POST['categgoryBoardID'];
    $categgoryCommentID = $_POST['categgoryCommentID'];
    
    $comment = $connect -> real_escape_string(trim($comment));
    $categgoryBoardID = $connect -> real_escape_string(trim($categgoryBoardID));
    $categgoryCommentID = $connect -> real_escape_string(trim($categgoryCommentID));

    // $regTime = time();

    $sql = "UPDATE categoryComment SET categgoryComment = '$comment' WHERE categgoryBoardID = '$categgoryBoardID' AND categgoryCommentID = '$categgoryCommentID'";
    // echo $sql;
    $connect -> query($sql);  

?>
<script>
    history.back();
</script>