<?php
    include "../connect/connect.php";
    $myCommentID = $_POST['commentID'];
    $myCommentpass = $_POST['pass'];

    $sql = "DELETE FROM myComment WHERE myCommentID = '$myCommentID'";
    $result = $connect -> query($sql);
    echo json_encode(array("info" => $myCommentID));
?>