<?php

include "../connect/connect.php";
    
    $type = $_POST['type'];
    $userMemberID = $_POST['memberId'];

    if($type == "categoryscroll"){
        $page = $_POST['page'];
        $viewNum = 8;
        $viewLimit = ($viewNum * $page) - $viewNum;
        $tagfile = '';
        $categoryCountSql = "SELECT count(categgoryBoardID) as cate FROM categoryBoard as b JOIN userMember as m ON b.userMemberID = m.userMemberID  WHERE m.userMemberID = '{$userMemberID}' ";
        $categoryCountResult = $connect -> query($categoryCountSql);

        $categoryCount = $categoryCountResult -> fetch_array(MYSQLI_ASSOC);
        $categoryCount = $categoryCount['cate'];
        $categoryCount = ceil($categoryCount/$viewNum);

            if($page <= $categoryCount){
                $boardSql = "SELECT * FROM categoryBoard as b JOIN userMember as m ON b.userMemberID = m.userMemberID  WHERE m.userMemberID = '{$userMemberID}' ORDER BY b.categgoryBoardID DESC LIMIT {$viewLimit}, {$viewNum} ";
                $boardResult = $connect -> query($boardSql);
                foreach($boardResult as $board) {    
                    $tagfile .= "<article class='mypage__cardBox'>
                            <div class='cardBox__image'>
                                <figure>
                                    <a href='../imgeview/imgview.php?categgoryBoardID=".$board['categgoryBoardID']."'><img src='../assets/categoryimg/".$board['categgoryPhoto']."' alt='이미지' /></a>
                                </figure>
                            </div>
                        </article>";
                    } 
                    echo json_encode(array("result" => 'good', "page" => $tagfile));
            } else echo json_encode(array("result" => 'bad'));

    }

?>

