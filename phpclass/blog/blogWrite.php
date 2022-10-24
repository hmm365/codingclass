<?php 
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
?> 

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>

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
        <section id="blogWrite">
            <h2>블로그 글쓰기</h2>
            <div class="write__inner container">
                <form action="blogWriteSave.php" name="blogWrite" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>블로그 게시글 작성 영역</legend>
                        <div>
                            <label for="blogCategory">카테고리</label>
                            <select name="blogCategory" id="blogCategory">
                                <option value="javascript">javascript</option>
                                <option value="jquery">jquery</option>
                                <option value="html">html</option>
                                <option value="css">css</option>
                                <option value="css">Apple</option>
                            </select>
                        </div>
                        <div>
                            <label for="blogTitle">제목</label>
                            <input type="text" name="blogTitle" id="blogTitle" placeholder="제목을 넣어주세요" require>     
                        </div>
                        <div>
                            <label for="blogContents">내용</label>
                            <textarea type="text" name="blogContents" id="blogContents" placeholder="내용을 넣어주세요" require></textarea>
                        </div>
                    <div>       
                            <label for="blogFile">파일</label>
                            <input type="file" name="blogFile" id="blogFile" accept=".jpg, .jpeg .png, .gif" placeholder="jpg, png, gif 파일만 넣어주세요!">    
                        </div>
                        <button type="sumbit" value="저장하기">저장하기</button>
                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <?php include "../login/login.php" ?>
    <!-- //login -->

    <!-- script -->
    <script src="../assets/js/custom.js"></script>
</body>
</html>