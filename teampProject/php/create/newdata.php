<?php
    include "../connect/connect.php";
    //board 확인용
    for($i=1; $i<=30; $i++){
        $regTime = time();
        $sql = "INSERT INTO categoryComment(categgoryBoardID, userMemberID, categgoryComment, regTime)
        VALUES('30', '1', '댓글테스트$i', $regTime);";
        $connect -> query($sql);
    }
    echo $sql;
?>
