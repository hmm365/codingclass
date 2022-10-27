<?php
    include "../connect/session.php";
    unset($_SESSION['userMemberID']);
    unset($_SESSION['userId']);
    unset($_SESSION['userName']);
?>

<script>
    location.href="../main/main.php";
</script>