<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE  clike(";
    $sql .= "clikeId int(10) unsigned NOT NULL auto_increment,";
    $sql .= "commentId int(10) NOT NULL,";
    $sql .= "feedBackBoardID int(10) NOT NULL,";
	$sql .= "userMemberID int(10) NOT NULL,";
    $sql .= "clike int(10) DEFAULT 1,";
    $sql .= "PRIMARY KEY (clikeId)";
    $sql .= ") charset=utf8;";
    echo $sql;
    $connect -> query($sql);
?>