<?php

include "../connect/connect.php";
include "../connect/session.php";
    
    $type = $_POST['type'];
    $userMemberID = $_SESSION['userMemberID'];

    
    if($type == "bookmarkRemove"){
        $categoryId = $_POST['categoryId'];
        $sql = "SELECT * FROM categoryLike WHERE categgoryBoardID = '$categoryId' AND userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);
        if($result -> num_rows == 1){
            $sql = "DELETE FROM categoryLike WHERE categgoryBoardID = '$categoryId' AND userMemberID = '$userMemberID'";
            $result = $connect -> query($sql);
            $sql2 = "UPDATE categoryBoard SET likecate = (SELECT count(categoryLike.categoryLike) FROM categoryLike WHERE categgoryBoardID = '$categoryId' GROUP BY categoryLike.categgoryBoardID) WHERE categgoryBoardID = '$categoryId'";
            $result2 = $connect -> query($sql2);
            echo json_encode(array("result" => 'good'));
        } else echo json_encode(array("result" => 'bad'));
        
    }

    if($type == "bookmarkAdd"){
        $categoryId = $_POST['categoryId'];
        $sql = "SELECT * FROM categoryLike WHERE categgoryBoardID = '$categoryId' AND userMemberID = '$userMemberID'";
        $result = $connect -> query($sql);

        if($result -> num_rows == 0){
            $sql = "INSERT INTO categoryLike(categgoryBoardID, userMemberID) VALUES('$categoryId', '$userMemberID')";
            $result = $connect -> query($sql);
            $sql2 = "UPDATE categoryBoard SET likecate = (SELECT count(categoryLike.categoryLike) FROM categoryLike WHERE categgoryBoardID = '$categoryId' GROUP BY categoryLike.categgoryBoardID) WHERE categgoryBoardID = '$categoryId'";
            $result2 = $connect -> query($sql2);
            echo json_encode(array("result" => "good"));
        } else echo json_encode(array("result" => 'bad'));
        
    }
    


    if($type == "categoryscroll"){
        $page = $_POST['page'];
        $viewNum = 8;
        $categoryCountSql = "SELECT count(categgoryBoardID) as cate FROM categoryBoard";
        $categoryCountResult = $connect -> query($categoryCountSql);

        $categoryCount = $categoryCountResult -> fetch_array(MYSQLI_ASSOC);
        $categoryCount = $categoryCount['cate'];
        $categoryCount = ceil($categoryCount/$viewNum);

        if($page <= $categoryCount){
            $viewLimit = ($viewNum * $page) - $viewNum;
            $boardSql = "SELECT b.categgoryBoardID, b.categgoryTitle,i.userMemberID, i.userPhoto, i.userNickName, b.categgoryPhoto, b.categgoryView FROM categoryBoard as b JOIN categoryTag as t ON b.categgoryBoardID = t.categgoryBoardID JOIN userMember as i ON i.userMemberID = b.userMemberID WHERE t.categgoryTag = 'wallpaper' OR t.categgoryTag = '배경화면' GROUP BY b.categgoryBoardID ORDER BY b.categgoryBoardID DESC LIMIT {$viewLimit}, {$viewNum}";
            $boardResult = $connect -> query($boardSql);
            $tagfile = '';
            foreach($boardResult as $board) {    
                $categoryId = $board['categgoryBoardID'];
                $tagSql = "SELECT * FROM categoryTag WHERE categgoryBoardID = $categoryId";
                $tagResult = $connect -> query($tagSql);
                $tagInfo = '';
            
                $likeSql = "SELECT * FROM categoryLike WHERE categgoryBoardID = $categoryId AND userMemberID = '$userMemberID'";
                $likeResult = $connect -> query($likeSql);
                $likeInfo = $likeResult -> num_rows;
                if($likeResult -> num_rows == 1){ 
                    $likeInfo = 'show';
                }
            
                $commentSql = "SELECT * FROM categoryComment WHERE categgoryBoardID = '$categoryId'";
                $commentResult = $connect -> query($commentSql);
                $commentNum = $commentResult -> num_rows;
                if($commentNum == null){
                    $commentNum = '0';
                }
                foreach($tagResult as $tag ){
                    $tagInfo .=  '#'.$tag['categgoryTag'];
                }
                $tagfile .= "<article class='main_cardBox' id='category".$board['categgoryBoardID']."' >
                                <em class='blind tagName'>$tagInfo</em>
                                <div class='main_image'>
                                    <figure>
                                       <a href='../imgeview/imgview.php?categgoryBoardID=".$board['categgoryBoardID']."'><img src='../assets/categoryimg/".$board['categgoryPhoto']."' alt='이미지' /></a>
                                    </figure>
                                </div>
                                <div class='main_info'>
                                    <div class='mainInfo_left'>
                                        <figure>
                                            <a href='../mypage/userpage.php?userMemberID=".$board['userMemberID']."'><img src='../assets/userimg/".$board['userPhoto']."' alt='프로필 이미지' /></a>
                                        </figure>
                                        <div class='mainInfo_title'>
                                            <h3><a href='../imgeview/imgview.php?categgoryBoardID=".$board['categgoryBoardID']."'>".$board['categgoryTitle']."</a></h3>
                                            <span>".$board['userNickName']."</span>
                                        </div>
                                    </div>
                                    <div class='mainInfo_right'>
                                        <figure>
                                            <img src='/assets/image/comment_ico.svg' alt='댓글뷰 이미지' />
                                        </figure>
                                        <span>$commentNum</span>
                                        <figure>
                                            <img src='/assets/image/view_ico.svg' alt='조회수 이미지' />
                                        </figure>
                                        <span>".$board['categgoryView']."</span>
                                    </div>
                                </div>
                                <img class='$likeInfo' src='/assets/image/heartBasic_ico.svg' alt='공감 아이콘'  />
                            </article>";
            }
                echo json_encode(array("result" => 'good', "page" => $tagfile));
        } else echo json_encode(array("result" => 'bad'));

    }
    
?>