<?php
include "../connect/connect.php";
include "../connect/session.php";
$searchKeyword = $_GET['searchKeyword'];
if(isset($_GET['searchSelect'])){
    $searchSelect = $_GET['searchSelect'];
} else {
    $searchSelect = 0;
}

$page = 1;
$viewNum = 8;
$viewLimit = ($viewNum * $page) - $viewNum;
if($searchSelect == 0){
    $boardSql = "SELECT b.categgoryBoardID, b.categgoryTitle, i.userMemberID, i.userPhoto, i.userNickName, b.categgoryPhoto, b.categgoryView 
    FROM categoryBoard as b 
    JOIN userMember as i ON i.userMemberID = b.userMemberID 
    WHERE b.categgoryTitle LIKE '%{$searchKeyword}%'
    GROUP BY b.categgoryBoardID ORDER BY b.categgoryBoardID DESC ";
} else if ($searchSelect == 1) {
    $boardSql = "SELECT b.categgoryBoardID, b.categgoryTitle, i.userMemberID, i.userPhoto, i.userNickName, b.categgoryPhoto, b.categgoryView 
    FROM categoryBoard as b 
    JOIN userMember as i ON i.userMemberID = b.userMemberID 
    WHERE b.categgoryTitle LIKE '%{$searchKeyword}%'
    GROUP BY b.categgoryBoardID ORDER BY b.categgoryView DESC ";
} else if ($searchSelect == 2) {
    $boardSql = "SELECT b.categgoryBoardID, b.categgoryTitle, i.userMemberID, i.userPhoto, i.userNickName, b.categgoryPhoto, b.categgoryView 
    FROM categoryBoard as b 
    JOIN userMember as i ON i.userMemberID = b.userMemberID 
    WHERE b.categgoryTitle LIKE '%{$searchKeyword}%'
    GROUP BY b.categgoryBoardID ORDER BY b.likecate DESC, b.categgoryBoardID DESC ";
} else if ($searchSelect == 3) {
    $boardSql = "SELECT b.categgoryBoardID, b.categgoryTitle, i.userMemberID, i.userPhoto, i.userNickName, b.categgoryPhoto, b.categgoryView 
    FROM categoryBoard as b 
    JOIN userMember as i ON i.userMemberID = b.userMemberID 
    JOIN categoryTag as t ON b.categgoryBoardID = t.categgoryBoardID
    WHERE t.categgoryTag LIKE '{$searchKeyword}'
    GROUP BY b.categgoryBoardID ORDER BY b.likecate DESC, b.categgoryBoardID DESC ";
}

$boardResult = $connect -> query($boardSql);
$boardCount = $boardResult -> num_rows;


$boardSql .= "LIMIT {$viewLimit}, {$viewNum}";
$boardResult = $connect -> query($boardSql);
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>IT.D | 무료 이미지 다운로드 사이트</title>
        <!-- CSS 링크 -->
        <link rel="stylesheet" href="../assets/css/common.css">
        <link rel="stylesheet" href="../assets/css/reset.css">
        <link rel="stylesheet" href="../assets/css/search.css">
        <link rel="stylesheet" href="../assets/css/fonts.css">
    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- header -->
        
        <section class="search_banner">
            <div class="banner_inner container">
                <p>Search</p>
                <div class="banner_udline"></div>
            </div>
        </section>

        <section class="search_wrap ">
            <div class="search_inner container">
                <div class="search_input">
                    <label for="search" class="ir"></label>
                    <img src="../../assets/image/search_Icon.svg" alt="검색">
                    <label for="search__inputResult" class="ir"></label>
                    <input onkeypress="show_name(event)" id="search__inputResult" name="search__inputResult" type="text" placeholder="검색어를 입력해주세요." value="<?=$searchKeyword?>" />
                    <button id="search__input__searchBtn">검색</button>
                </div>
            </div>
            <div class="search_sort container">
                

                <select name="image" id="image_sort">
                    <option value="date">날짜별</option>
                    <option value="viewcount">조회수</option>
                    <option value="like">좋아요수</option>
                    <option value="tag">태그</option>
                </select>
                <div class="num">Total Found:<?=$boardCount?></div>
            </div>
        </section>


        <main id="main">
            <div class="main_wrap">
                <div class="main_inner">
                    <section class="main_card container">
                        <?php
                            if($boardCount > 0){
                                foreach($boardResult as $board) {    
                                    $categoryId = $board['categgoryBoardID'];

                                    $likeSql = "SELECT * FROM categoryLike WHERE categgoryBoardID = $categoryId AND userMemberID = '$userMemberId'";
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
                        ?>
                        <article class="main_cardBox" id="category<?=$board['categgoryBoardID']?>" >
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
                                        <img src="../assets/image/comment_ico.svg" alt="댓글뷰 이미지" />
                                    </figure>
                                    <span><?=$commentNum?></span>
                                    <figure>
                                        <img src="../assets/image/view_ico.svg" alt="댓글뷰 이미지" />
                                    </figure>
                                    <span><?=$board['categgoryView']?></span>
                                </div>
                            </div>
                            <img class="<?=$likeInfo?>" src="../assets/image/heartBasic_ico.svg" alt="공감 아이콘" />
                        </article>
                        <?php 
                            } 
                        } else { echo "<p>검색하신 내용이 없습니다.</p>";}
                        ?>
                    </section>
                </div>
            </div>
        </main>
        <!-- main -->
        <?php include "../include/footer.php" ?>
        <!-- // footer -->
        <script>
            document.querySelector(".header__bottom").style.display = "none";        
        </script>
        <script>
            const searchSelect = document.getElementById("image_sort")
            searchSelect.selectedIndex = <?=$searchSelect?>;

            const searchInputBtn = document.querySelector('#search__input__searchBtn')
            searchInputBtn.addEventListener('click', () =>{
                let resultText = document.querySelector('#search__inputResult').value
                let userVal = searchSelect.selectedIndex;
                location.href=`search.php?searchKeyword=${resultText}&searchSelect=${userVal}`;
            })
            function show_name(e){
                let resultText = document.querySelector('#search__inputResult').value
                let userVal = searchSelect.selectedIndex;
                if(e.keyCode == 13){   
                    location.href=`search.php?searchKeyword=${resultText}&searchSelect=${userVal}`;
                }
            }
        </script>

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
                        url: "searchMod.php",
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
                        url: "searchMod.php",
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
                        url:"searchMod.php",
                        data : {
                            "type": "categoryscroll",
                            'page': pagecount,
                            'searchSelect': '<?=$searchSelect?>',
                            'searchKeyword': '<?=$searchKeyword?>',
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
