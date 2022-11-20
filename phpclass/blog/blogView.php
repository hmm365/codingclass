<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    $myBlogID = $_GET['blogID'];

    $blogSql = "SELECT * FROM myBlog WHERE blogID = {$myBlogID}";
    $blogResult = $connect -> query($blogSql);
    $blogInfo = $blogResult -> fetch_array(MYSQLI_ASSOC); //데이터 가져오기

    $commentSql = "SELECT * FROM myComment WHERE blogID = '$myBlogID' ORDER BY commentID DESC";
    $commentResult = $connect -> query($commentSql); //데이터 넣어주기
    $commentInfo = $blogResult -> fetch_array(MYSQLI_ASSOC); //데이터 넣어주기
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>
    <?php include "../include/head.php" ?>

</head>
<body>
<div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- skip -->

    <?php include "../include/header.php" ?>
    <!-- header -->

    <main id="main">
        <section id='blog' class='container'>
            <div class='blog__title' style='background-image:url(../assets/blog/<?=$blogInfo['blogImgSrc']?>)'>
                <span class="blog__title__cate"><?=$blogInfo['blogCategory']?></span>
                <h2 class="blog__title__h1"><?=$blogInfo['blogTitle']?></h2>
                <div class="blog__title__info">
                    <div>
                        <span class="author"><?=$blogInfo['blogAuthor']?></span>
                        <span class="date"><?=date('Y-m-d', $blogInfo['blogRegTime'])?></span>
                    </div>
                    <?php
                        $idchecks = $_SESSION['memberID'];
                        $idCheck = "SELECT memberID FROM myBlog WHERE memberID = '$idchecks' AND blogID = {$myBlogID}";
                        $checkResult = $connect -> query($idCheck); //데이터 넣어주기
                        $checkCount = $checkResult -> num_rows;
                        if($checkCount == 1) {
                    ?>
                    <div>
                        <a href="blogModify.php?myBlogID=<?=$myBlogID?>" class="modify">수정</a>
                        <a href="blogDelete.php?myBlogID=<?=$myBlogID?>" class="delete">삭제</a>
                    </div>
                    <?php 
                    }
                    ?>
                </div>
            </div>
            <div class='blog__inner'>
                <div class="blog__contents">
                    <div class="blog__contents__ad">
                        <div></div>
                    </div>
                    <div class="blog__contents__cont">
                        <?=$blogInfo['blogContents']?>
                    </div>
                    <div class="blog__contents__comment">
                        <h3>댓글 쓰기</h3>
<?php
    foreach($commentResult as $comment){ ?> 
                        <div class="comment" id="comment<?=$comment['commentID']?>">
                            <div class="comment__view">
                                <div class="comment__view__img">
                                    <!-- <img src="../assets/img/icon_256.png" alt="프로파일 이미지"> -->
                                    <img src="../assets/img/imgDefault.svg" alt="프로필 이미지">
                                    <!-- <div class='comment_profile' style='background-image:url(../assets/img/imgDefault.svg)'></div> -->
                                </div>
                                <div class="comment__view__data">
                                    <span class="name"><?=$comment['commentName']?></span>
                                    <span class="date"><?=date('Y-m-d', $comment['regTime'])?></span>
                                </div>
                                <div class="comment__view__msg">
                                    <?=$comment['commentMsg']?>
                                </div>
                            </div>
                            <div class="comment__del">
                                <a href="#" class="comment__del__del">댓글 삭제</a>
                                <a href="#" class="comment__del__mod">댓글 수정</a>
                            </div>
                        </div>
<?php }?>
                        <div class="comment__delete" style="display:none">
                            <label for="commentDeletePass">비밀번호</label>
                            <input type="text" id="commentDeletePass" name="commentDeletePass">
                            <button id="commentDeleteCancel">취소</button>
                            <button id="commentDeleteButton">삭제</button>
                            <button>삭제</button>
                        </div>
                        <div class="comment__modify" style="display:none">
                            <label for="commentModifyMsg">수정 내용</label>
                            <input type="text" id="commentModifyMsg" name="commentModifyMsg">
                            <label for="commentModifyPass">비밀번호</label>
                            <input type="text" id="commentModifyPass" name="commentModifyPass">
                            <button id="commentModifyCancel">취소</button>
                            <button id="commentModifyButton">수정</button>
                        </div>

                        <div class="comment__write">
                            <div class="comment__write__info">
                                <label for="commentName" class="">이름</label>
                                <input type="text" name="commentName" id="commentName" placeholder="이름">
                                <label for="commentPass">비밀번호</label>
                                <input type="password" id="commentPass" name="commentPass" placeholder="비밀번호">
                                <button type="submit" id="commentBtn">댓글쓰기</button>
                            </div>
                            <div class="comment__write__msg">
                                <label for="commentWrite">댓글을 써주세요</label>
                                <input type="text" id="commentWrite" name="commentWrite" placeholder="댓글을 써주세요">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //blog__contents -->

                <div class="blog__aside">
                    <div class="blog__aside__intro">
                        <div class="img">
                            <img src="../assets/blog/card_bg_01.png" alt="나">
                        </div>
                        <div class="intro">
                            오늘도 희망찬 하루!
                        </div>
                    </div>
                    <div class="blog__aside__cate">
                        <h3>카테고리</h3>
                            <?php include "../include/category.php" ?>
                    </div>
                    <div class="blog__aside__new">
                        <h3>최신글</h3>
                        <ul>
                            <?php include "../include/blogNew.php" ?>
                        </ul>
                    </div>
                    <div class="blog__aside__pop">
                        <h3>인기글</h3>
                        <ul>
                            <?php include "../include/blogpop.php" ?>
                        </ul>
                    </div>
                    <div class="blog__aside__comment">
                        <h3>최신 댓글</h3>
                        <ul>
                            <?php include "../include/blogNewComment.php" ?>
                        </ul>
                    </div>
                    <!-- <div class="blog__aside__ad"></div> -->
                </div>
                <div class="blog__relation"></div>
            </div>
        </section>
    </main>
    <!-- main -->
    
    <?php include "../include/footer.php" ?>
    <!-- footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        const commentName = $("#commentName"); //댓글 이름
        const commentPass = $("#commentPass"); //댓글 비밀번호
        const commentWrite = $("#commentWrite"); //댓글 내용
        
        let commentID = "";

        // 댓글 삭제버튼
        $(".comment__del__del").click(function(e){
            e.preventDefault();
            

            $(".comment__delete").fadeIn();
            
            // 클릭한 ID 값
            commentID = $(this).parent().parent().attr("id");

        });

        // 댓글 삭제 버튼 --> 취소 버튼 클릭
        $("#commentDeleteCancel").click(function(){
            $(".comment__delete").fadeOut();
        })

        // 댓글 삭제 버튼 --> 진짜 삭제 버튼 클릭
        $("#commentDeleteButton").click(function(){

            // comment14 : 0~9 까지 여러개(g)의 값을 교환
            let number = commentID.replace(/[^0-9]/g, "");

            if($("#commentDeletePass").val()==""){
                alert("댓글 작성시 비밀번호를 적어주세요");
                $("#commentDeletePass").focus();

            } else {
                $.ajax({
                    url: "blogCommentDelete.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "pass" : $("#commentDeletePass").val(),
                        "commentID" : number
                    },
                    // 성공했을때
                    success : function(data){
                        console.log(data);
                        location.reload();
                    },
                    // 오류시 3가지 값을 알려줍니다
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })

        // 댓글 수정버튼
        $(".comment__del__mod").click(function(e){
            e.preventDefault();
            
            $(".comment__modify").fadeIn();
            // 클릭한 ID 값
            commentID = $(this).parent().parent().attr("id");
        });

        $(".commentModifyCancel").click(function(e){
            e.preventDefault();
            
            $(".comment__modify").hide();
        });

        // 댓글 수정 버튼 --> 진짜 수정 버튼 클릭
        $("#commentModifyButton").click(function(){

            // comment14 : 0~9 까지 여러개(g)의 값을 교환
            let number = commentID.replace(/[^0-9]/g, "");

            if($("#commentModifyPass").val()=="" || $("#commentModifyMsg").val()==""){
                alert("댓글 수정시 빈칸을 모두 채워주세요");
                $("#commentModifyMsg").focus();

            } else {
                $.ajax({
                    url: "blogCommentModify.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "msg" : $("#commentModifyMsg").val(),
                        "pass" : $("#commentModifyPass").val(),
                        "commentID" : number
                    },
                    // 성공했을때
                    success : function(data){
                        console.log(data);
                        location.reload();
                    },
                    // 오류시 3가지 값을 알려줍니다
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })




        
        // 댓글 쓰기 버튼
        $("#commentBtn").click(function(){
            if($("#commentWrite").val()==""){
                alert("댓글을 써주세요!!");
                $("#commentWrite").focus();
            } else {
                $.ajax({
                    // 블로그 커멘트 php로 넘겨줍니다.
                    url: "blogCommentWrite.php",
                    method : "POST",
                    // json 파일로 제작하기 때문에 데이터 타입은 json
                    dataType: "json",
                    // 넣어줄 값
                    data: {
                        "blogID" : <?=$myBlogID?>,
                        "name" : commentName.val(),
                        "pass" : commentPass.val(),
                        "msg"  : commentWrite.val()
                    },
                    // 성공했을때
                    success : function(data){
                        console.log(data);
                        location.reload();
                    },
                    // 오류시 3가지 값을 알려줍니다
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })
    </script>
</body>
</html>