<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE categoryTag (";
    $sql .= "categoryTagId int(10) unsigned NOT NULL auto_increment,";
    $sql .= "categgoryBoardID int(10) NOT NULL,";
    $sql .= "categgoryTag varchar(20) NOT NULL,";
    $sql .= "PRIMARY KEY (categoryTagId)";
    $sql .= ") charset=utf8;";
    echo $sql;
    $connect -> query($sql);
?>