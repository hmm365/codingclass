<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE categoryBoard (";
    $sql .= "categgoryBoardID int(10) unsigned NOT NULL auto_increment,";
    $sql .= "userMemberID int(10) NOT NULL,";
    $sql .= "categgoryTitle varchar(50) NOT NULL,";
    $sql .= "categgoryContents longtext NOT NULL,";
    $sql .= "categgoryPhoto varchar(50) NOT NULL,";
    $sql .= "categgoryPhotoSize varchar(50) NOT NULL,";
    $sql .= "categgoryView int(10) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (categgoryBoardID)";
    $sql .= ") charset=utf8;";
    echo $sql;
    $connect -> query($sql);
?>