<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    var_dump($_SESSION['memberID']);
    $boardID = $_GET['boardID'];
    $boardID = $connect -> real_escape_string($boardID);
    $sql = "SELECT * FROM myBoard WHERE boardId = '$boardID'";
    $result = $connect -> query($sql);
    $info = $result->fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>

    <?php include "../include/head.php"?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php"?>
    <!-- header -->
    
    <main id="main">
        <section id="board" class="container section">
            <h2>게시글 쓰기</h2>
            <p>웹디자이너, 웹퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.</p>
            <div class="board__inner">
                <div class="board__write">
                    <form action="boardModifySave.php" name="boardModifySave" method="post">
                        <fieldset>
                            <legend>게시판 작성 영역</legend>
                            <div>
                                <input type="hidden" name="boardId" id="boardId" value='<?=$boardID?>'>
                                <label for="boardTitle">제목</label>
                                <input type="text" name="boardTitle" id="boardTitle" value='<?=$info['boardTitle']?>'>
                            </div>
                            <div>
                                <label for="boardContents">내용</label>
                                <textarea name="boardContents" id="boardContents" rows="20"><?=$content = str_replace("<br />","\n",$info['boardContents'])?></textarea>
                            </div>
                            <button type="submit" class="btn">저장하기</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
        <!-- //board -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"?>
    <!-- footer -->
</body>
</html>