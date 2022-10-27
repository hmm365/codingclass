<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    $feedBackBoardId = $_POST['feedBackBoardID'];
    $commentId = $_POST['commentID'];
    $userMemberId = $_SESSION['userMemberID'];
    $type = $_POST['type'];
    $feedBackBoardId = $connect -> real_escape_string(trim($feedBackBoardId));
    $commentId = $connect -> real_escape_string(trim($commentId));

    $likeSql = "SELECT * FROM clike WHERE commentId  = '$commentId' AND feedBackBoardID = '$feedBackBoardId' AND clike = 1";                             
    $likeResult = $connect -> query($likeSql);
    $likeCount = $likeResult -> num_rows;
    
    if($type == "like"){
        $sql = "INSERT INTO clike(feedBackBoardID, userMemberID, commentId) VALUES('$feedBackBoardId', '$userMemberId', '$commentId')";
        $result = $connect -> query($sql);

        $likeSql = "SELECT * FROM clike WHERE commentId  = '$commentId' AND feedBackBoardID = '$feedBackBoardId' AND clike = 1";                             
        $likeResult = $connect -> query($likeSql);
        $likeCount = $likeResult -> num_rows;
    } else if($type == "unLike"){
        $sql = "DELETE FROM clike WHERE feedBackBoardID = '${feedBackBoardId}' AND userMemberId = '${userMemberId}' AND  commentId = '$commentId' ";;
        $result = $connect -> query($sql);

        $likeSql = "SELECT * FROM clike WHERE commentId  = '$commentId' AND feedBackBoardID = '$feedBackBoardId' AND clike = 1";                             
        $likeResult = $connect -> query($likeSql);
        $likeCount = $likeResult -> num_rows;
    }
    
    $jsonResult = "bad";
    if($result){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult, "likeCount" => $likeCount));
    // echo "<script>location.replace('feedBackBoardView.php?feedBackBoardID=$feedBackBoardId')</script>";
?>

