<?php
    include "../connect/connect.php";
    include "../connect/session.php";
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
            <h2>게시판</h2>
            <p>웹디자이너, 웹퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.</p>
            <div class="board__inner">
                <div class="board__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%">
                            <col style="width: 80%">
                        </colgroup>
                        <tbody>
<?php
    $boardID = $_GET['boardID'];
    // echo $boardID;
    // 보드뷰 + 1(UPDATE)
    $sql = "UPDATE myBoard SET boardView = boardView + 1 WHERE boardID = {$boardID}";
    $connect -> query($sql);
    $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM myBoard b JOIN myMember m ON(m.memberID = b.memberID) WHERE b.boardID = {$boardID}";
    $result = $connect -> query($sql);
    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        // echo "<pre>";
        // var_dump($info);
        // echo "</pre>";
        echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('Y-m-d H:i', $info['regTime'])."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['boardView']."</td></tr>";
        echo "<tr><th>내용</th><td class='height'>".$info['boardContents']."</td></tr>";
    }
?>
                        </tbody>
                    </table>
                </div>
                <div class="board__btn">
                <?php
                        $idchecks = $_SESSION['memberID'];
                        $idCheck = "SELECT memberID FROM myBoard WHERE memberID = '$idchecks' AND boardID = {$boardID}";
                        $checkResult = $connect -> query($idCheck); //데이터 넣어주기
                        $checkCount = $checkResult -> num_rows;
                        if($checkCount == 1) {
                    ?>
                    <a href="boardModify.php?boardID=<?=$boardID?>">수정하기</a>
                    <a href="boardRemove.php?boardID=<?=$boardID?>">삭제하기</a>
                    
                <?php }
                ?>
                <a href="board.php">목록보기</a>
                </div>
        </section>
        <!-- //board -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"?>
    <!-- footer -->
</body>
</html>