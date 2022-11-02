<?php 
    include "../connect/session.php";
    include "../connect/connect.php";

    if(!isset($_SESSION['userMemberID']) ){ 
        echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
        }
    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];

    $boardTitle = $connect -> real_escape_string(trim($boardTitle));
    $boardContents = $connect -> real_escape_string(trim($boardContents));
    $boardContents = nl2br($_POST['boardContents']);
    $boardView = 1;
    $regTime = time();
    $userMemberID = $_SESSION['userMemberID'];

    $sql = "INSERT INTO feedBackBoard(userMemberID, boardTitle, boardContents, boardView, regTime) VALUES('$userMemberID','$boardTitle', '$boardContents', '$boardView', '$regTime');";
    // echo $sql;
    $connect -> query($sql);  
?>
<script>
    location.href="feedBackBoard.php";
</script>