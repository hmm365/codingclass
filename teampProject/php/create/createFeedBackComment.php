<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE feedBackComment (";
    $sql .= "commentId int(10) unsigned NOT NULL auto_increment,";
    $sql .= "feedBackBoardID int(10) NOT NULL,";
    $sql .= "userMemberID int(10) NOT NULL,";
    $sql .= "comment longtext NOT NULL,";
    $sql .= "clike int(10) DEFAULT 0,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (commentId)";
    $sql .= ") charset=utf8;";
    echo $sql;
    $connect -> query($sql);
?>