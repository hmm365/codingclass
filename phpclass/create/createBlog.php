<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE myBlog (";
    $sql .= "blogID int(10) unsigned auto_increment,";
    $sql .= "memberID int(10) unsigned NOT NULL,";
    $sql .= "blogTitle varchar(255) NOT NULL,";
    $sql .= "blogContents longtext NOT NULL,";
    $sql .= "blogCategory varchar(20) NOT NULL,";
    $sql .= "blogAuthor varchar(20) NOT NULL,";
    $sql .= "blogView int(10) NOT NULL,";
    $sql .= "blogLike int(10) NOT NULL,";
    $sql .= "blogImgSrc varchar(100) DEFAULT NULL,";
    $sql .= "blogImgSize varchar(100) DEFAULT NULL,";
    $sql .= "blogDelete int(10) NOT NULL,";
    $sql .= "blogRegTime int(20) NOT NULL,";
    $sql .= "blogModTime int(20) DEFAULT NULL,";
    $sql .= "PRIMARY KEY (blogID)";
    $sql .= ") charset=utf8;";
    $result = $connect -> query($sql);
    if($result){
        echo "create table true";
    } else {
        echo "create table false";
    }
?>