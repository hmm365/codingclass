<?php
    include "../connect/connect.php";
    $commentName = $_POST['name'];
    $commentPass = $_POST['pass'];
    $commentMsg = $_POST['msg'];
    $myBlogID = $_POST['blogID'];
    $regTime = time();
    $sql = "INSERT INTO myComment(myMemberID, myBlogID, commentName, commentMsg, commentPass, commentDelete, regTime) VALUES ('1', '$myBlogID', '$commentName', '$commentMsg', '$commentPass', '1','$regTime')";
    $result = $connect -> query($sql);
    echo json_encode(array("info" => $myBlogID));
?>