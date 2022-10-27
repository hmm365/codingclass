<?php 
    include "../connect/session.php";
    include "../connect/connect.php";

    $userMemberId = $_SESSION['userMemberID'];
    $noticeBoardID = $_GET['noticeBoardId'];
    
    $sql = "SELECT userMemberId FROM noticeBoard WHERE userMemberId = $userMemberId";

    $result = $connect -> query($sql);
    $arry = mysqli_fetch_array($result);  
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

<?php 
    $noticeBoardId = $_POST['noticeBoardId'];

    $sql = "SELECT noticeBoardId, boardTitle, boardContents FROM noticeBoard WHERE noticeBoardId = '{$noticeBoardId}'";
  
    $result = $connect -> query($sql);
    if($result){
        $info = $result->fetch_array(MYSQLI_ASSOC);
    }
    $boardContents = $connect -> real_escape_string(trim($info['boardContents']));
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>게시글 쓰기 페이지</title>

        <!-- CSS Link -->
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
                            <p class="board_desc">IT.D에서 당신만의 게시글을 수정해주세요.</p>
                            <div class="write_inner">
                                <div class="board__write">
                                    <form action="noticeBoardModifySave.php" name="boardWrite" method="post">
                                        <fieldset>
                                            <legend class="ir">게시판 수정 영역</legend>
                                                    <div style='display:none'>
                                                        <label for='noticeBoardId'>번호</label>
                                                        <input type='text' name='noticeBoardId' id='noticeBoardId' value='<?=$info['noticeBoardId']?>' >
                                                    </div>
                                                    <div>
                                                        <label for='boardTitle'>제목</label>
                                                         <input type='text' name='boardTitle' id='boardTitle' value='<?=$info['boardTitle'] ?>'>
                                                        </div>
                                                    <div>
                                                        <label for='boardContents'>내용</label>
                                                         <textarea name='boardContents' id='boardContents' rows='20' ><?=$boardContents; ?></textarea>
                                                    </div>
                                            <div class="btn_group">
                                                <button type="submit" class="btn_save">수정</button>
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
            <script>
                document.querySelector(".btn_cancle").addEventListener("click", () => {
                    history.back();
                });
            </script>
        </main>
         <!-- main -->
         <?php include "../include/footer.php" ?>
        <!-- footer -->
    </body>
</html>


