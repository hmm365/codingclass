<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE myBlog (";
    $sql.= "myBlogID int(10) UNSIGNED auto_increment,";
    $sql.= "myMemberID int(10) UNSIGNED NOT NULL,";
    $sql.= "blogTitle varchar(255) NOT NULL,";
    $sql.= "blogContents longtext NOT NULL,";
    $sql.= "blogCategory varchar(20) NOT NULL,";
    $sql.= "blogAuthor varchar(20) NOT NULL,";
    $sql.= "blogView int(10) NOT NULL,";
    $sql.= "blogLike int(10) NULL,";
    $sql.= "blogImgFile varchar(100) DEFAULT NULL,";
    $sql.= "blogImgSize varchar(100) DEFAULT NULL,";
    $sql.= "blogDelete int(10) NOT NULL,";
    $sql.= "blogRegTime int(20) NOT NULL,";
    $sql.= "blogModTime int(20) DEFAULT NULL,";
    $sql.= "PRIMARY KEY (myBlogID)";
    $sql.= ") charset=utf8;";

    $connect -> query($sql);
?>

<!-- CREATE TABLE myAdminMember (
        myAdminMemberID int(10) UNSIGNED auto_increment,
        youEmail varchar(40) NOT NULL,
        youNickName varchar(40) NOT NULL,
        youName varchar(10) NOT NULL,
        youPass varchar(40) NOT NULL,
        youBitrh varchar(40) NOT NULL,
        youPhone varchar(20) NOT NULL,
        youGender enum('남자', '여자') DEFAULT NULL,
        youPhoto varchar(255) DEFAULT NULL,
        youIntro varchar(255) DEFAULT NULL,
        youSite varchar(255) DEFAULT NULL,
        regTime int(20) NOT NULL,
        PRIMARY KEY (myAdminMemberID)
        ) charset=utf8; -->