<?php 
    include "../connect/session.php";
    include "../connect/connect.php";

    if(!isset($_SESSION['userMemberID']) ){ 
        echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
        }
    
    $comment = $_POST['comment'];
    $categgoryBoardID = $_POST['categgoryBoardID'];
    
    $comment = $connect -> real_escape_string(trim($comment));
    $categgoryBoardID = $connect -> real_escape_string(trim($categgoryBoardID));

    $comment = nl2br($comment);

    $regTime = time();
    $userMemberID = $_SESSION['userMemberID'];

    $sql = "INSERT INTO categoryComment(categgoryBoardID, userMemberID, categgoryComment, regTime) VALUES('$categgoryBoardID', '$userMemberID', '$comment', '$regTime');";
    // echo $sql;
    $result = $connect -> query($sql);  
    
    $jsonResult = "bad";
    if($result){
        $jsonResult = "good";
    }
    // echo json_encode(array("result" => $jsonResult, "likeCount" => $likeCount));

     echo "<script>location.replace('imgview.php?categgoryBoardID=$categgoryBoardID')</script>";
?>
