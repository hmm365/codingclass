<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    if(isset($_SESSION['userMemberID']) ){ 
        $userMemberId = $_SESSION['userMemberID'];
        $admin = "SELECT adminAccount FROM adminAccount WHERE userMemberID = $userMemberId";
        $resultAdmin = $connect -> query($admin);
        $adminAccount = mysqli_fetch_array($resultAdmin);
       }
    if($adminAccount['adminAccount'] == 1){
        }else {
            echo "<script>alert('허용되지 않는 잘못된 접근입니다.'); location.href = '../main/main.php'; </script>";
        }
    $noticeBoardId = $_POST['noticeBoardId'];
    $noticeBoardId = $connect -> real_escape_string($noticeBoardId);
    $sql = "DELETE FROM noticeBoard WHERE noticeBoardId = $noticeBoardId";
    $connect -> query($sql);

?>
<script>
    location.href="noticeBoard.php";
</script>



