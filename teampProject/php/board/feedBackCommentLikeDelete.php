<?php
    include "../connect/connect.php";
    include "../connect/session.php";


    $feedBackBoardId = $_POST['feedBackBoardID'];
    $commentId = $_POST['commentID'];
    $userMemberId = $_SESSION['userMemberID'];
    $feedBackBoardId = $connect -> real_escape_string(trim($feedBackBoardId));
    $commentId = $connect -> real_escape_string(trim($commentId));
    
    $sql = "DELETE FROM clike WHERE feedBackBoardID = '${feedBackBoardId}' AND userMemberId = '${userMemberId}' AND  commentId = '$commentId' ";;
    
    $result = $connect -> query($sql);
    // echo $sql;
    echo "<script>location.replace('feedBackBoardView.php?feedBackBoardID=$feedBackBoardId')</script>";
   
    
?>




