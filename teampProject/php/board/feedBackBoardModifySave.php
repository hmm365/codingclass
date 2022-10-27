<?php
include "../connect/connect.php";
include "../connect/session.php";
        $feedBackBoardID = $_POST['feedBackBoardID'];
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
            $sql = "UPDATE feedBackBoard SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}' WHERE feedBackBoardID = '{$feedBackBoardID}'";
        //    echo $sql;
            $connect -> query($sql);
        }
    ?>
    <script>
        location.href="feedBackBoard.php";
    </script>
