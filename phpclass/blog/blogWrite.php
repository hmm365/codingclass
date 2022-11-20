<?php
    include "../connect/connect.php";
    include "../connect/session.php";
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
    <!-- //skip -->
    <?php include "../include/header.php" ?>
    <!-- //header -->
    <main id="main">
        <section id="board" class="container section">
            <h2>블로그 글쓰기</h2>
            <p>웹디자이너, 웹퍼블리셔, 프론트앤드 개발자를 위한 블로그입니다.</p>
            <div class="board__inner">
                <div class="board__write">
                    <form action="blogWriteSave.php" name="blogWrite" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <legend>게시판 작성 영역</legend>
                            <div>
                                <label for="blogCategory">카테고리</label>
                                <select name="blogCategory" id="blogCategory" class="select_style1">
                                    <option value="javascript">javascript</option>
                                    <option value="jquery">jquery</option>
                                    <option value="html">HTML</option>
                                    <option value="css">CSS</option>
                                </select>
                            </div>
                            <div>
                                <label for="blogTitle">제목</label>
                                <input type="text" name="blogTitle" id="blogTitle">
                            </div>
                            <div>
                                <label for="blogContents">내용</label>
                                <textarea name="blogContents" id="blogContents" rows="20"></textarea>
                            </div>
                            <div>
                                <label for="blogImgFile">파일</label>
                                <input type="file" accept="image/jpeg, image/png, image/jpg, image/png, image/gif" name="blogImgFile" id="blogImgFile">
                            </div>
                            <button type="submit" class="btn">저장하기</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->
    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>