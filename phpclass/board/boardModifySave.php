<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardTitle = $_POST['boardTitle'];
    $boardId = $_POST['boardId'];
    $boardContents = nl2br($_POST['boardContents']);

    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);
    $memberID = $_SESSION['memberID'];
    
    $sql = "UPDATE myBoard SET boardTitle = '$boardTitle', boardContents = '$boardContents' WHERE boardId = '$boardId'";
    echo $sql;
    
    $connect -> query($sql);
?>
<script>
    location.href = "board.php";
</script>