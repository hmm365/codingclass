<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    // 변수 설정
    $type = $_POST['type'];
    $userMemberID = $_SESSION['userMemberID'];
    $sql = "SELECT * FROM userMember ";
    if($type == "passCheck"){
        $userPass = $connect -> real_escape_string(trim($_POST['userPass']));
        $userPass = sha1("web".$userPass);
        $sql .= "WHERE userPass = '{$userPass}' AND userMemberID = '{$userMemberID}'";
    }
    $result = $connect -> query($sql);
    $jsonResult = "bad";
    // 데이터 유무 확인
    if($result -> num_rows == 1){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>