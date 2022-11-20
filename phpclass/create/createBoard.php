<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE myBoard(";
    $sql .= "boardID int(10) unsigned NOT NULL auto_increment,";
    $sql .= "memberID int(10) NOT NULL,";
    $sql .= "boardTitle varchar(50) NOT NULL,";
    $sql .= "boardContents longtext NOT NULL,";
    $sql .= "boardView int(10) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (boardID)";
    $sql .= ") charset=utf8;";
    $result = $connect -> query($sql);

    if($result){
        echo "create table true";
    } else {
        echo "create table false";
    }
?>