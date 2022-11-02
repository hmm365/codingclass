<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE  catelike(";
    $sql .= "catelikeId int(10) unsigned NOT NULL auto_increment,";
    $sql .= "categgoryCommentId int(10) NOT NULL,";
    $sql .= "categgoryBoardID int(10) NOT NULL,";
	$sql .= "userMemberID int(10) NOT NULL,";
    $sql .= "clike int(10) DEFAULT 1,";
    $sql .= "PRIMARY KEY (catelikeId)";
    $sql .= ") charset=utf8;";
    echo $sql;
    $connect -> query($sql);
?>