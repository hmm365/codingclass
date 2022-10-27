<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE adminAccount (";
    $sql .= "adminAccount int(10) DEFAULT 1,";
    $sql .= "userMemberID int(10) NOT NULL,";
    $sql .= "PRIMARY KEY (userMemberID)";
    $sql .= ") charset=utf8;";
    echo $sql;
    $connect -> query($sql);
?>