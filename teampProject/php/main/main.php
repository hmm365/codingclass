<?php
include "../connect/connect.php";
include "../connect/session.php";
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>IT.D | 무료 이미지 다운로드 사이트</title>

        <!-- CSS 링크 -->
        <link rel="stylesheet" href="/assets/css/common.css" />
        <link rel="stylesheet" href="/assets/css/fonts.css" />
        <link rel="stylesheet" href="/assets/css/reset.css" />
        <link rel="stylesheet" href="/assets/css/main.css" />
    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- header -->
        <main id="main">
            <div class="main_wrap">
                <div class="main_inner">
                    <section class="main_banner">
                        <div class="banner_inner container">
                            <div class="banner">
                                <div class="banner__text">
                                    안녕하세요!<br />
                                    <em>IT.D</em> 사이트에 오신 것을 환영합니다.
                                    <p>
                                        저희는 이미지 무료 다운로드 기능을 제공해 드리고있습니다.<br />
                                        꾸준히 업로드 하며 잘 관리하겠습니다.<br />
                                        저희 IT.D 사이트를 방문해주셔서 너무 감사드립니다.
                                    </p>
                                </div>
                                <div class="banner__bg">
                                    <figure>
                                        <img src="../assets/image/banner_bg01.png" alt="배너 이미지" />
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="main_card container">
                        <?php 
                            $page = 1;
                            $viewNum = 8;
                            $viewLimit = ($viewNum * $page) - $viewNum;

                            $boardSql = "SELECT b.categgoryBoardID, b.categgoryTitle, i.userMemberID ,i.userPhoto, i.userNickName, b.categgoryPhoto, b.categgoryView 
                            FROM categoryBoard as b 
                            JOIN userMember as i ON i.userMemberID = b.userMemberID 
                            GROUP BY b.categgoryBoardID ORDER BY b.categgoryBoardID DESC LIMIT {$viewLimit}, {$viewNum};";
                            
                            $boardResult = $connect -> query($boardSql);
                            foreach($boardResult as $board) {    
                                $categoryId = $board['categgoryBoardID'];
                                $tagSql = "SELECT * FROM categoryTag WHERE categgoryBoardID = $categoryId";
                                $tagResult = $connect -> query($tagSql);
                                $tagInfo = '';

                                $likeSql = "SELECT * FROM categoryLike WHERE categgoryBoardID = $categoryId AND userMemberID = '$userMemberId'";
                                $likeResult = $connect -> query($likeSql);
                                $likeInfo = $likeResult -> num_rows;
                                if($likeResult -> num_rows == 1){ 
                                    $likeInfo = 'show';
                                }

                                $commentSql = "SELECT * FROM categoryComment WHERE categgoryBoardID = '$categoryId'";
                                $commentResult = $connect -> query($commentSql);
                                $commentNum = $commentResult -> num_rows;
                                if($commentNum == null || $commentNum == ''){
                                    $commentNum = '0';
                                }
                                foreach($tagResult as $tag ){
                                    $tagInfo .=  '#'.$tag['categgoryTag'];
                                }
                        ?>
                        <article class="main_cardBox" id="category<?=$board['categgoryBoardID']?>">
                            <em class="blind tagName"><?=$tagInfo?></em>
                            <div class="main_image">
                                <figure>
                                    <a href="../imgeview/imgview.php?categgoryBoardID=<?=$board['categgoryBoardID']?>"><img src="../assets/categoryimg/<?=$board['categgoryPhoto']?>" alt="이미지" /></a>
                                </figure>
                            </div>
                            <div class="main_info">
                                <div class="mainInfo_left">
                                    <figure>
                                        <a href="../mypage/userpage.php?userMemberID=<?=$board['userMemberID']?>"><img src="../assets/userimg/<?=$board['userPhoto']?>" alt="프로필 이미지" /></a>
                                    </figure>
                                    <div class="mainInfo_title">
                                        <h3><a href="../imgeview/imgview.php?categgoryBoardID=<?=$board['categgoryBoardID']?>"><?=$board['categgoryTitle']?></a></h3>
                                        <span><?=$board['userNickName']?></span>
                                    </div>
                                </div>

                                <div class="mainInfo_right">
                                    <figure>
                                        <img src="/assets/image/comment_ico.svg" alt="댓글뷰 이미지" />
                                    </figure>
                                    <span><?=$commentNum?></span>
                                    <figure>
                                        <img src="/assets/image/view_ico.svg" alt="조회수 이미지" />
                                    </figure>
                                    <span><?=$board['categgoryView']?></span>
                                </div>
                            </div>
                            <img class="<?=$likeInfo?>" src="/assets/image/heartBasic_ico.svg" alt="공감 아이콘"  />
                        </article>
                        <?php } ?>
                    </section>
                </div>
            </div>
        </main>
        <!-- main -->
        <?php include "../include/footer.php" ?>
        <!-- // footer -->

        <!-- 스크립트 -->
        <script>
            function heartLike() {
                const heartBtn = document.querySelectorAll('.main_card .main_cardBox > img');        
                heartBtn.forEach((heart, num) => {
                heart.addEventListener('click', () => {
                    const regex = /[^0-9]/g;	
                    let categoryId = heart.parentElement.getAttribute('id');
                    categoryId = categoryId.replace(regex, "");
                    if(heart.classList.contains('show')){
                    $.ajax({
                        url: "mainMore.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "type": "bookmarkRemove",
                            "categoryId": categoryId
                        },
                        success: function(data) {
                            if(data.result == 'good'){ 
                                heart.classList.remove('show');
                            }
                        },
                        error: function(request, status, error){
                            console.log("request" + request);
                            console.log("status" + status);
                            console.log("error" + error);
                        }
                    })
                } else {
                    $.ajax({
                        url: "mainMore.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "type": "bookmarkAdd",
                            "categoryId": categoryId
                        },
                        success: function(data) {
                            if(data.result == 'good'){
                                heart.classList.add('show');
                            }
                        },
                        error: function(request, status, error){
                            console.log("request" + request);
                            console.log("status" + status);
                            console.log("error" + error);
                        }
                    })
                }
                });
            });
            }
            heartLike();
            let loading = false;
            let pagecount = 2;
            function next_load(){
                $.ajax({
                        method: "POST",
                        url:"mainMore.php",
                        data : {
                            "type": "categoryscroll",
                            'page': pagecount,
                        },
                        dataType: "json",
                        success: function(data)
                        {
                            if(data.result == 'good'){
                                pagecount++;
                                $('.main_card').append(data.page)                            
                                loading = false;    //실행 가능 상태로 변경
                                heartLike();
                            }
                            else
                            {
                                console.log('failed');
                            }
                        },error: function(request, status, error){
                            console.log("request" + request);
                            console.log("status" + status);
                            console.log("error" + error);
                        }
                    });
            }

            $(window).scroll(function(){
                if($(window).scrollTop()+200>=$(document).height() - $(window).height())
                {
                    if(!loading)    //실행 가능 상태라면?
                    {
                        loading = true; //실행 불가능 상태로 변경
                        next_load(); 
                    }
                    else            //실행 불가능 상태라면?
                    {
                        // console.log('다음페이지를 로딩중입니다.');  
                    }
                }
            });            
        </script>

    </body>
</html>
