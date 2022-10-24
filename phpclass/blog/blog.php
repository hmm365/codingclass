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
        <section id="blogSearch">
            <h2>개발과 관련된 블로그 입니다</h2>
            <div class="blog__search">
                <form action="blogSearch.php">
                        <legend>블로그 서치</legend>
                        <label for="searchKeyword"></label>
                        <input type="text" name="searchKeyword" id="searchKeyword" placeholder="검색하세요">
                        <button class="btn">검색</button>
                </form>
            </div>
        </section>
        

        <section id="card" class="container">
            <h2>javascript topic</h2>
            <a href="blogWrite.php">글쓰기</a>
            <div class="card__inner">
<?php
    $sql = "SELECT * FROM myBlog WHERE blogDelete = 0 ORDER BY myBlogID DESC";
    $result = $connect -> query($sql);

    foreach($result as $blog){ ?>
        <div class="card">
            <div class="cate"><?=$blog['blogCategory']?></div>
            <figure>
                <img src="../assets/img/blog/<?=$blog['blogImgFile']?>" alt="vscode에 scss설치하기">
                <a href="blogView.php?blogID=<?=$blog['myBlogID']?>" class="go" title="컨텐츠 바로가기">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.646447 8.64645C0.451184 8.84171 0.451184 9.15829 0.646447 9.35355C0.841709 9.54882 1.15829 9.54882 1.35355 9.35355L0.646447 8.64645ZM9.5 1C9.5 0.723858 9.27614 0.5 9 0.5L4.5 0.5C4.22386 0.5 4 0.723858 4 1C4 1.27614 4.22386 1.5 4.5 1.5L8.5 1.5L8.5 5.5C8.5 5.77614 8.72386 6 9 6C9.27614 6 9.5 5.77614 9.5 5.5L9.5 1ZM1.35355 9.35355L9.35355 1.35355L8.64645 0.646447L0.646447 8.64645L1.35355 9.35355Z" fill="white"/>
                    </svg>
                </a>
            </figure>
            <div>
                <h3><?=$blog['blogTitle']?></h3>
                <p><?=$blog['blogContents']?></p>
            </div>
        </div>
<?php    }?>
                
            </div>
        </section>
        <!-- //card -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>