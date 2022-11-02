<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    $categgoryBoardID = $_POST['categgoryBoardID'];
    $categgoryCommentId = $_POST['categgoryCommentId'];
    $userMemberId = $_SESSION['userMemberID'];
    $type = $_POST['type'];
    $categgoryBoardID = $connect -> real_escape_string(trim($categgoryBoardID));
    $categgoryCommentId = $connect -> real_escape_string(trim($categgoryCommentId));

    $likeSql = "SELECT * FROM catelike WHERE categgoryCommentId  = '$categgoryCommentId' AND categgoryBoardID = '$categgoryBoardID' AND clike = 1";                             
    $likeResult = $connect -> query($likeSql);
    $likeCount = $likeResult -> num_rows;
    
    if($type == "like"){
        $sql = "INSERT INTO catelike(categgoryBoardID, userMemberID, categgoryCommentId) VALUES('$categgoryBoardID', '$userMemberId', '$categgoryCommentId')";
        $result = $connect -> query($sql);

        $likeSql = "SELECT * FROM catelike WHERE categgoryCommentId  = '$categgoryCommentId' AND categgoryBoardID = '$categgoryBoardID' AND clike = 1";                             
        $likeResult = $connect -> query($likeSql);
        $likeCount = $likeResult -> num_rows;
    } else if($type == "unLike"){
        $sql = "DELETE FROM catelike WHERE categgoryBoardID = '${categgoryBoardID}' AND userMemberId = '${userMemberId}' AND  categgoryCommentId = '$categgoryCommentId' ";;
        $result = $connect -> query($sql);

        $likeSql = "SELECT * FROM catelike WHERE categgoryCommentId  = '$categgoryCommentId' AND categgoryBoardID = '$categgoryBoardID' AND clike = 1";                             
        $likeResult = $connect -> query($likeSql);
        $likeCount = $likeResult -> num_rows;
    }
    
    $jsonResult = "bad";
    if($result){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult, "likeCount" => $likeCount));
    // echo "<script>location.replace('feedBackBoardView.php?categgoryBoardID=$categgoryBoardID')</script>";
?>

