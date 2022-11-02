<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    if( !isset($_SESSION['userMemberID']) ){ 
        echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
        }
    $categgoryBoardID = $_POST['categgoryBoardID'];
    $categgoryBoardID = $connect -> real_escape_string($categgoryBoardID);
    $sql = "DELETE FROM categoryBoard WHERE categgoryBoardID = $categgoryBoardID";
    $connect -> query($sql);
    $sql = "DELETE FROM categoryTag WHERE categgoryBoardID = $categgoryBoardID";
    $connect -> query($sql);

?>
<script>
    location.href="../main/main.php";
</script>



