<?php
    include "../connect/connect.php";
    // 회원가입
    $sql = "INSERT INTO adminAccount(userMemberID) VALUES(1)";
    $result = $connect -> query($sql);
?>