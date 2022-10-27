<?php
include "../connect/connect.php";
include "../connect/session.php";
if(isset($_SESSION['userMemberID']) ){ 
    $userMemberId = $_SESSION['userMemberID'];
    $admin = "SELECT adminAccount FROM adminAccount WHERE userMemberID = $userMemberId";
    $resultAdmin = $connect -> query($admin);
    $adminAccount = mysqli_fetch_array($resultAdmin);
   }
if($adminAccount['adminAccount'] == 1){
    }else {
        echo "<script>alert('허용되지 않는 잘못된 접근입니다.'); location.href = '../main/main.php'; </script>";
    }
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>IT.D | 무료 이미지 다운로드 사이트</title>

        <!-- CSS 링크 -->
        <link rel="stylesheet" href="../assets/css/common.css" />
        <link rel="stylesheet" href="../assets/css/reset.css" />
        <link rel="stylesheet" href="../assets/css/fonts.css" />
        <link rel="stylesheet" href="../assets/css/board.css" />
    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- header -->
     
        <main id="main">
            <div class="main_wrap">
                <section class="board_wrap">
                    <div class="board_inner container">
                        <div class="board_box">
                            <div class="board_title">
                                <h2>NOTICE</h2>
                                <p class="line1"></p>
                            </div>
                            <p class="board_desc">IT.D에서 공지사항을 작성해주세요.</p>
                            <div class="write_inner">
                                <div class="board__write">
                                    <form action="noticeBoardWriteSave.php" name="boardWrite" method="post">
                                        <fieldset>
                                            <legend class="ir">게시판 작성 영역</legend>
                                            <div>
                                                <h3>제목</h3>
                                                <label for="boardTitle" class="ir">제목</label>
                                                <input type="text" name="boardTitle" id="boardTitle" placeholder="제목을 입력해주세요." />
                                            </div>
                                            <div>
                                                <h3>본문</h3>
                                                <label for="boardContents" class="ir">내용</label>
                                                <textarea name="boardContents" id="boardContents" rows="20" placeholder="내용을 입력해주세요."></textarea>
                                            </div>
                                            <div class="btn_group">
                                                <button type="submit" class="btn_save">등록</button>
                                                <button type="button" class="btn_cancle">취소</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <!-- main -->
        <?php include "../include/footer.php" ?>
        <!-- footer -->
        
        <!-- // footer -->
    </body>
</html>
