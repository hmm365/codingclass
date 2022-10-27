<?php

include "../connect/connect.php";
include "../connect/session.php";
    
    $type = $_POST['type'];
    $userMemberID = $_SESSION['userMemberID'];

    
    if($type == "nicknameChange"){
        $nickname = $_POST['nickname'];
        $sql = "UPDATE userMember SET userNickName = '$nickname' WHERE userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);

        echo json_encode(array("nickname" => $nickname));
    }

    if($type == "gender"){
        $gender = $_POST['gender'];
        $sql = "UPDATE userMember SET userGender = '$gender' WHERE userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);

        echo json_encode(array("gender" => $gender));
    }

    if($type == "phonenumber"){
        $phonenumber = $_POST['phonenumber'];
        $sql = "UPDATE userMember SET userPhone = '$phonenumber' WHERE userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);

        echo json_encode(array("phonenumber" => $phonenumber));
    }

    if($type == "userShortInfo"){
        $userShortInfo = $_POST['userShortInfo'];
        $sql = "UPDATE userMember SET userShortInfo = '$userShortInfo' WHERE userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);

        echo json_encode(array("userShortInfo" => $userShortInfo));
    }

    if($type == "userLongInfo"){
        $userLongInfo = $_POST['userLongInfo'];
        $sql = "UPDATE userMember SET userLongInfo = '$userLongInfo' WHERE userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);

        echo json_encode(array("userLongInfo" => $sql));
    }

    if($type == "userOneInfo"){
        $userOneInfo = $_POST['userOneInfo'];
        $sql = "UPDATE userMember SET userOneInfo = '$userOneInfo' WHERE userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);

        echo json_encode(array("userOneInfo" => $sql));
    }

    if($type == "joinLeave"){
        $youPass = $_POST['youPass'];
        $youPass = sha1("web".$youPass);
        $sql2 = "SELECT * FROM userMember WHERE userMemberID = $userMemberID AND userPass = '$youPass'";
        $result2 = $connect -> query($sql2);

        if($result2 -> num_rows == 1){
            $sql = "DELETE FROM userMember WHERE userMemberID = $userMemberID AND userPass = '$youPass'";
            $result = $connect -> query($sql);
            unset($_SESSION['userMemberID']);
            unset($_SESSION['userId']);
            unset($_SESSION['userName']);
            $jsonResult = "good";
        } else {
            $jsonResult = "bad";
        }
        echo json_encode(array("result" => $jsonResult));
    }

?>

