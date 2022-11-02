<?php 
    include "../connect/session.php";
    include "../connect/connect.php";

    if( isset($_SESSION['userMemberID']) ){ 
        $userMemberId = $_SESSION['userMemberID'];
        $admin = "SELECT adminAccount FROM adminAccount WHERE userMemberID = $userMemberId";
        $resultAdmin = $connect -> query($admin);
        $adminAccount = mysqli_fetch_array($resultAdmin);
       }
       if($adminAccount['adminAccount'] == 1){
        }else {
            echo "<script>alert('허용되지 않는 잘못된 접근입니다.'); location.href = '../main/main.php'; </script>";
        }

    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];

    $boardTitle = $connect -> real_escape_string(trim($boardTitle));
    $boardContents = $connect -> real_escape_string(trim($boardContents));
    $boardContents = nl2br($_POST['boardContents']);
    $boardView = 1;
    $regTime = time();
    $userMemberID = $_SESSION['userMemberID'];

    $sql = "INSERT INTO noticeBoard(userMemberID, boardTitle, boardContents, boardView, regTime) VALUES('$userMemberID','$boardTitle', '$boardContents', '$boardView', '$regTime');";
    // echo $sql;
    $connect -> query($sql);  
?>
<script>
    location.href="noticeBoard.php";
</script>