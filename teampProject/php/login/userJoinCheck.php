<?php
    include "../connect/connect.php";
    // 변수 설정
    $type = $_POST['type'];
    $sql = "SELECT userEmail, userID FROM userMember ";
    if($type == "emailCheck"){
        $youEmail = $connect -> real_escape_string(trim($_POST['youEmail']));
        $sql .= "WHERE userEmail = '{$youEmail}'";
    }
    if($type == "idCheck"){
        $youId = $connect -> real_escape_string(trim($_POST['youId']));
        $sql .= "WHERE userID = '{$youId}'";
    }
    $result = $connect -> query($sql);
    $jsonResult = "bad";
    // 데이터 유무 확인
    if($result -> num_rows == 0){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>