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
        $userMemberId = $_SESSION['userMemberID'];

        $userPass = $_POST['userPass'];
      

        $boardTitle = $_POST['boardTitle'];
        $boardContents = $_POST['boardContents'];
    
        $boardTitle = $connect -> real_escape_string(trim($boardTitle));
        $boardContents = $connect -> real_escape_string(trim($boardContents));


        $sql = "SELECT userMemberId FROM userMember WHERE userMemberId = {$userMemberId}";
        $result = $connect -> query($sql);

        $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
        if($memberInfo['userMemberId'] === $userMemberId) {
            $sql = "UPDATE noticeBoard SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}' WHERE noticeBoardId = '{$noticeBoardId}'";
        //    echo $sql;
            $connect -> query($sql);
        }
    ?>
    <script>
        location.href="noticeBoard.php";
    </script>
