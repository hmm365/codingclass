<?php
    include "../connect/connect.php";
    // 변수 설정
    $type = $_POST['type'];
    $sql = "SELECT * FROM userMember ";
    if($type == "Check"){
        $userEmail = $connect -> real_escape_string(trim($_POST['userEmail']));
        $userId = $connect -> real_escape_string(trim($_POST['userId']));
        $sql .= "WHERE userEmail = '{$userEmail}' AND userId = '{$userId}'";
    }
    $result = $connect -> query($sql);
    $jsonResult = "bad";
    // 데이터 유무 확인
    if($result -> num_rows == 1){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>