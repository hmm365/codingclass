<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE feedBackBoard (";
    $sql .= "feedBackBoardID int(10) unsigned NOT NULL auto_increment,";
    $sql .= "userMemberID int(10) unsigned NOT NULL,";
    $sql .= "boardTitle varchar(50) NOT NULL,";
    $sql .= "boardContents longtext NOT NULL,";
    $sql .= "boardView int(10) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (feedBackBoardID)";
    $sql .= ") charset=utf8;";
    // echo $sql;
    $connect -> query($sql);
?>