<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE  categoryLike(";
    $sql .= "categoryLikeId int(10) unsigned NOT NULL auto_increment,";
    $sql .= "categgoryBoardID int(10) NOT NULL,";
	$sql .= "userMemberID int(10) NOT NULL,";
    $sql .= "categoryLike int(10) DEFAULT 1,";
    $sql .= "PRIMARY KEY (categoryLikeId)";
    $sql .= ") charset=utf8;";
    echo $sql;
    $connect -> query($sql);
?>