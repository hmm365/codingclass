<?php
    $host = "localhost";
    $user = "hmm365";
    $pass = "Tkfkddlek!2";
    $db = "hmm365";
    $connect = new mysqli($host, $user, $pass, $db);
    $connect -> set_charset("utf8");

    // if(mysqli_connect_errno()){
    //     echo "Database Connect False";
    // } else {
    //     echo "Database Connect True";
    // }
?>