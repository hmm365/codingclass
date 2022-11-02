<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    if( !isset($_SESSION['userMemberID']) ){ 
        echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
        }

    $categgoryBoardID = $_POST['categgoryBoardID'];
    $categgoryCommentId = $_POST['categgoryCommentId'];

    $categgoryBoardID = $connect -> real_escape_string(trim($categgoryBoardID));
    $categgoryCommentId = $connect -> real_escape_string(trim($categgoryCommentId));

    $sql = "DELETE FROM categoryComment WHERE categgoryBoardID = '$categgoryBoardID' AND categgoryCommentId = '$categgoryCommentId'";
    
    $connect -> query($sql);
    echo "<script>location.replace('imgview.php?categgoryBoardID=$categgoryBoardID')</script>";
?>




