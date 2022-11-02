<?php
    if(!isset($_SESSION['memberID'])){
        Header("Location: ../login/login.php");
    }
?>