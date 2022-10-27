<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $feedBackBoardID = $_POST['feedBackBoardID'];
    $feedBackBoardID = $connect -> real_escape_string($feedBackBoardID);
    $sql = "DELETE FROM feedBackBoard WHERE feedBackBoardID = $feedBackBoardID";
    $connect -> query($sql);

?>
<script>
    location.href="feedBackBoard.php";
</script>



