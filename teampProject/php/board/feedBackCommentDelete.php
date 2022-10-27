<?php
    include "../connect/connect.php";
    include "../connect/session.php";


    $feedBackBoardId = $_POST['feedBackBoardID'];
    $commentId = $_POST['commentID'];

    $feedBackBoardId = $connect -> real_escape_string(trim($feedBackBoardId));
    $commentId = $connect -> real_escape_string(trim($commentId));
   
    $sql = "DELETE FROM feedBackComment WHERE feedBackBoardId = '$feedBackBoardId' AND commentId = '$commentId'";
    
    $connect -> query($sql);
    echo "<script>location.replace('feedBackBoardView.php?feedBackBoardID=$feedBackBoardId')</script>";
   
    
?>




