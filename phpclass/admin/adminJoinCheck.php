<?php
    include "../connect/connect.php";
    // 변수 설정
    $type = $_POST['type'];
    $sql = "SELECT youEmail, youNickName FROM myAdminMember ";
    if($type == "emailCheck"){
        $youEmail = $connect -> real_escape_string(trim($_POST['youEmail']));
        $sql .= "WHERE youEmail = '{$youEmail}'";
    }
    if($type == "nickCheck"){
        $youNickName = $connect -> real_escape_string(trim($_POST['youNickName']));
        $sql .= "WHERE youNickName = '{$youNickName}'";
    }
    $result = $connect -> query($sql);
    $jsonResult = "bad";
    // 데이터 유무 확인
    if($result -> num_rows == 0){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>