<?php  
 if( isset($_SESSION['userMemberID']) ){ 
     $admin = "SELECT adminAccount FROM adminAccount WHERE userMemberID = $userMemberId";
     $resultAdmin = $connect -> query($admin);
     $adminAccount = mysqli_fetch_array($resultAdmin);
     
     $userSql = "SELECT * FROM feedBackBoard WHERE feedBackBoardID = '$feedBackBoardID' AND userMemberID = '$userMemberId' ";
     $userReslt = $connect -> query($userSql);
     $userCount = $userReslt -> num_rows;

if($adminAccount['adminAccount'] == 1 && $boardCount == 0){ 
?>
                            <div class='btn_group'>
                                <button class='btn_delete'>삭제</button>

                            </div>
<?php } else if(isset($_SESSION['userMemberID']) && !$adminAccount['adminAccount'] == 1 ){ 
         // $boardCount = 1;
         if($userCount > 0){ 
?>
                            <div class='btn_group'>
                                <button class='btn_modify'>수정하기</button>
                                <button class='btn_delete'>삭제</button>
                            </div>
<?php    }
     } else if(isset($_SESSION['userMemberID']) && $adminAccount['adminAccount'] == 1 ){ 
         // $boardCount = 1;
         if($userCount > 0){
?>
                            <div class='btn_group'>
                                <button class='btn_modify'>수정하기</button>
                                <button class='btn_delete'>삭제</button>
                            </div>
<?php   }
     }
    }

?>