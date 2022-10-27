<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE categoryComment (";
    $sql .= "categgoryCommentId int(10) unsigned NOT NULL auto_increment,";
    $sql .= "categgoryBoardID int(10) NOT NULL,";
    $sql .= "userMemberID int(10) NOT NULL,";
    $sql .= "categgoryComment longtext NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (categgoryCommentId)";
    $sql .= ") charset=utf8;";
    echo $sql;
    $connect -> query($sql);
?>