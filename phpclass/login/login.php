<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // var_dump($_SESSION['memberID']);
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
        <section id="login" class="container section">
            <h2>로그인</h2>
            <p>
                로그인을 하시면 게시글 및 댓글 작성이 가능합니다.<br>
                회원가입을 하면 로그인을 할 수 있습니다.<br>
                구경하시려면 admin@naver.com / 1234를 입력해주세요!
            </p>
            <div class="login__inner">
                <div class="login__contents">
                    <form name="login" action="loginSave.php" method="post">
                        <fieldset>
                            <legend class="blind">로그인 입력폼</legend>
                            <div>
                                <label class="blind" for="youEmail">이메일</label>
                                <input type="email" name="youEmail" id="youEmail" class="input_style1" placeholder="이메일" class="input__style" required>
                            </div>
                            <div>
                                <label class="blind" for="youPass">비밀번호</label>
                                <input type="password" name="youPass" id="youPass" class="input_style1" placeholder="비밀번호" class="input__style" required>
                            </div>
                            <button type="submit" class="btn_style1 mt20">로그인</button>
                        </fieldset>
                    </form>
                </div>
                <div class="login__footer">
                    
                    <div class="desc">
                        <ul>
                            <li>회원가입을 하지 않았다면 회원가입 먼저 해주세요! <a href="#" class="link">회원가입</a></li>
                            <li>아이디가 기억이 나지 않는다면. <a href="#" class="link">아이디 찾기</a></li>
                            <li>비밀번호가 기억이 나지 않는다면. <a href="#" class="link">비밀번호 찾기</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- //login -->
    </main>
    <!-- main -->

    <?php include "../include/footer.php"?>
    <!-- footer -->
</body>
</html>