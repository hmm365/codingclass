<?php
    include "../connect/connect.php";
    $myCommentID = $_POST['commentID'];
    $myCommentpass = $_POST['pass'];
    $myCommentMsg = $_POST['comment'];

    $sql = "UPDATE myComment SET commentMsg = '$myCommentMsg', commentPass = '$myCommentpass' WHERE myCommentID = '$myCommentID' ";
    $result = $connect -> query($sql);
    echo json_encode(array("info" => $sql));
?>  