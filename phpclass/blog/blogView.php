<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    $myBlogID = $_GET['blogID'];
    $blogSql = "SELECT * FROM myBlog WHERE myBlogID = {$myBlogID}";
    $blogResult = $connect->query($blogSql);
    $blogInfo = $blogResult->fetch_array(MYSQLI_ASSOC);

    $commentSql = "SELECT * FROM myComment ";
    $commentResult = $connect -> query($commentSql);
    $commentInfo = $commentResult -> fetch_array(MYSQLI_ASSOC);
?> 

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기 - 블로그</title>

    <?php include "../include/link.php" ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main">
       <section id="blog" class="container">
            <div class="blog__inner">
                <div class="blog__title" style="background-image:url(../assets/img/blog/<?=$blogInfo['blogImgFile']?>)">
                    <span class="blog__title__cate"><?=$blogInfo['blogCategory']?></span>
                    <h2 class="blog__title__h1"><?=$blogInfo['blogTitle']?></h2>
                    <div class="blog__title__info">
                        <div>
                            <span class="author"><?=$blogInfo['blogAuthor']?></span>
                            <span class="date"><?=date("Y-m-d", $blogInfo['blogRegTime'])?></span>
                        </div>
                        <div>
                           <a href="" class="modify"></a>
                           <a href="" class="delete"></a>
                        </div>
                    </div>
                </div>
                <div class="blog__contents">
                    <div class="blog__contents__ad">
                        <div></div>
                    </div>
                    <!-- //blog__contents__ad -->
                    <div class="blog__contents__cont">
                        <?=$blogInfo['blogContents']?>
                    </div>
                    <!-- //blog__contents__ad -->
                    <div class="blog__contents__comment">
                        <h3>댓글 쓰기</h3>
<?php
    foreach($commentResult as $comment){ ?> 
                        <div class="comment" id="comment<?=$comment['myCommentID']?>">
                            <div class="comment__view">
                                <div class="comment__view__img">
                                    <img src="../assets/img/icon_256.png" alt="dd">
                                </div>
                                <div class="comment__view__data">
                                    <span class="name"><?=$comment['commentName']?></span>
                                    <span class="date"><?=date("Y-m-d", $comment['commentName'])?></span>
                                </div>
                                <div class="comment__view__msg"><?=$comment['commentMsg']?></div>
                            </div>
                            <div class="comment__del">
                                <a href="#" class="comment__del__del">댓글삭제</a>
                                <a href="#" class="comment__del__mod">댓글수정</a>
                            </div>
                        </div>
<?php } ?>
                        <div class="comment__delete" style="display: none">
                            <label for="commentDeletePass">비밀번호</label>
                            <input type="text" id="commentDeletePass" name="commentDeletePass">
                            <button id="commentDeleteCancel">취소</button>
                            <button id="commentDeleteButton">삭제</button>
                        </div>
                        <div class="comment__modify" style="display: none">
                            <label for="commentModifyMsg">수정내용</label>
                            <input type="text" id="commentModifyMsg" name="commentModifyMsg">
                            <label for="commentModifyPass">비밀번호</label>
                            <input type="text" id="commentModifyPass" name="commentModifyPass">
                            <button id="commentModifyCancel">취소</button>
                            <button id="commentModifyButton">수정</button>
                        </div>
                        <div class="comment__write" >
                            <div class="comment__write__info">
                                <label for="commentName">이름</label>
                                <input type="text" id="commentName" name="commentName" placeholder="이름입력">
                                <label for="commentPass">비밀번호</label>
                                <input type="text" name="commentPass" id="commentPass" placeholder="비밀번호입력">
                                <button type="sumbit" id="commentBtn">댓글 쓰기</button>
                            </div>
                            <div class="comment__write__msg">
                                    <label for="commentWrite">댓글을 써주세요!</label>
                                    <input type="text" name="commentWrite" id="commentWrite" placeholder="댓글을 써주세요!">
                                </div>
                        </div>
                    </div>
                    <!-- //blog__contents__ad -->
                </div>
                <div class="blog__aside">
                    <div class="blog__aside__intro">
                        <div class="img">
                            <img src="../assets/img/banner_bg01.jpg" alt="profile">
                        </div>
                        <p class="intro">
                            어떤 일이라도 노력하고 즐기면 그 결과는 빛을 바란다고 생각합니다.
                        </p>
                    </div>
                    <div class="blog__aside__cate">
                        <h3>카테고리</h3>
                        <?php include "../include/category.php"?>
                    </div>
                    <div class="blog__aside__new">
                        <h3>최신글</h3>
                        <ul>
                        <?php include "../include/blogNew.php"?>
                        </ul>
                    </div>
                    <div class="blog__aside__pop">
                        <h3>인기글</h3>
                        <ul>
                        <?php include "../include/blogNew.php"?>
                        </ul>
                    </div>
                    <div class="blog__aside__comment">
                        <h3>최신댓글</h3>
                        <ul>
                        <?php include "../include/blogNew.php"?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="blog__relation"></div>
       </section>
    </main>
    <!-- //main -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        const commentName = $("#commentName"); //댓글 이름
        const commentPass = $("#commentPass"); //댓글 비밀번호
        const commentWrite = $("#commentWrite"); //댓글 내용
        let myCommentID = '';
        let num = '';
        let msg = '';
        //댓글 삭제 버튼 클릭시

        $(".comment__del__del").click(function (e) {
            e.preventDefault();
            // alert("댓글삭제")
            myCommentID = $(this).parent().parent().attr('id');
            
            num = myCommentID.split("comment").join('');
            // console.log(myCommentID.split("comment").join(''));
            // console.log(myCommentID.replace(/[^0-9]/g, "");

            $(".comment__delete").show();
        })
        //댓글 삭제 버튼에서 취소버튼
        $("#commentDeleteCancel").click(function () {
            // alert("댓글삭제")
            $(".comment__delete").hide();
        })
        $("#commentDeleteButton").click(function () {
            if($("#commentDeletePass").val() == ""){
                alert("비밀번호를 써주세요!")
                $("#commentDeletePass").focus();
            } else {
                $.ajax({
                    url: "blogCommentDelete.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentID": num ,
                        "pass": $("#commentDeletePass").val(),
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })
        $(".comment__del__mod").click(function (e) {
            e.preventDefault();
            myCommentID = $(this).parent().parent().attr('id');
            
            num = myCommentID.split("comment").join('');

            $(".comment__modify").show();
            // alert("댓글 수정 버튼 클릭시")
            // $(".comment__modify").slideOut(1000);
            // $(".comment__modify").fadeIn(1000);
            // $(".comment__modify").css("display","block");
        })
        //댓글 삭제 버튼에서 취소버튼
            $("#commentModifyButton").click(function () {
            // alert("댓글삭제")
            $(".comment__modify").hide();
        })
        $("#commentModifyButton").click(function () {
            if($("#commentModifyMsg").val() == ""){
                alert("수정할 내용을 써주세요!!")
                $("#commentModifyMsg").focus();
            } else if ($("#commentModifyPass").val() == ""){
                    alert("비밀번호를 써주세요!!")
                    $("#commentModifyPass").focus();
            } else {
                $.ajax({
                    url: "blogCommentUpdate.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentID": num ,
                        "comment": $("#commentModifyMsg").val() ,
                        "pass": $("#commentModifyPass").val(),
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })
        $("#commentBtn").click( () => {
            if($("#commentWrite").val() == ""){
                alert("댓글을 써주세요!")
                $("#commentWrite").focus();
            } else {
                $.ajax({
                    url: "blogCommentWrite.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "blogID": <?=$myBlogID?> ,
                        "name": commentName.val(),
                        "pass": commentPass.val(),
                        "msg": commentWrite.val()
                    },
                    success: function(data) {
                        // console.log(data);
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })
    </script>
    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>