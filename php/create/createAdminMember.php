<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE myAdminMember (";
    $sql.= "myMemberID int(10) UNSIGNED auto_increment,";
    $sql.= "youEmail varchar(40) NOT NULL,";
    $sql.= "youNickName varchar(40) UNIQUE NOT NULL,";
    $sql.= "youName varchar(10) NOT NULL,";
    $sql.= "youPass varchar(40) NOT NULL,";
    $sql.= "youBirth varchar(40) NOT NULL,";
    $sql.= "youPhone varchar(20) NOT NULL,";
    $sql.= "youGender enum('남자', '여자') DEFAULT NULL,";
    $sql.= "youPhoto varchar(255) DEFAULT NULL,";
    $sql.= "youIntro varchar(255) DEFAULT NULL,";
    $sql.= "youSite varchar(255) DEFAULT NULL,";
    $sql.= "regTime int(20) NOT NULL,";
    $sql.= "PRIMARY KEY (myMemberID)";
    $sql.= ") charset=utf8;";

    // echo $sql;

    $connect -> query($sql);
?>

<!-- CREATE TABLE myAdminMember (
        myAdminMemberID int(10) UNSIGNED auto_increment,
        youEmail varchar(40) NOT NULL,
        youNickName varchar(40) NOT NULL,
        youName varchar(10) NOT NULL,
        youPass varchar(40) NOT NULL,
        youBirth varchar(40) NOT NULL,
        youPhone varchar(20) NOT NULL,
        youGender enum('남자', '여자') DEFAULT NULL,
        youPhoto varchar(255) DEFAULT NULL,
        youIntro varchar(255) DEFAULT NULL,
        youSite varchar(255) DEFAULT NULL,
        regTime int(20) NOT NULL,
        PRIMARY KEY (myAdminMemberID)
        ) charset=utf8; -->