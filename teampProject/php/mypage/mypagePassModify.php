<?php

include "../connect/connect.php";
include "../connect/session.php";
if( !isset($_SESSION['userMemberID']) ){ 
    echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
    }
    $type = $_POST['type'];
    $userMemberID = $_SESSION['userMemberID'];

    
    if($type == "prePass"){
        $prePass = $_POST['prePass'];
        $prePass = sha1("web".$prePass);
        $sql = "SELECT * FROM userMember WHERE userMemberID = '$userMemberID' AND userPass = '$prePass'";
        $result = $connect -> query($sql);
        
        $jsonResult = "bad";
        // 데이터 유무 확인
        if($result -> num_rows == 1){
            $jsonResult = "good";
        }
        echo json_encode(array("result" => $jsonResult));
    }

    if($type == "newPass"){
        $newPass = $_POST['newPass'];
        $newPass = sha1("web".$newPass);
        $sql = "UPDATE userMember SET userPass = '$newPass' WHERE userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);

        $jsonResult = "good";

        echo json_encode(array("result" => $jsonResult));
    }


?>

