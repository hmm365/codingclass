<?php
    include "../connect/connect.php";

    // 받아올 값(POST 방식)
    $myBlogID = $_POST['blogID'];
    $commentName = $_POST['name'];
    $commentPass = $_POST['pass'];
    $commentMsg = $_POST['msg'];
    $regTime = time();

    $sql = "INSERT INTO myComment (memberID, blogID, commentName, commentMsg, commentPass, commentDelete, regTime) VALUES ('1','$myBlogID','$commentName','$commentMsg','$commentPass','0','$regTime')";
    
    // 데이터 가져옴
    $result = $connect -> query($sql);
    echo json_encode(array("info" => $myBlogID));
?>