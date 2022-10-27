<?php
include "../connect/connect.php";
include "../connect/session.php";
if( isset($_SESSION['userMemberID']) ){ 
    echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>아이디 찾기</title>
        <link rel="stylesheet" href="../assets/css/reset.css" />
        <link rel="stylesheet" href="../assets/css/common.css">
        <link rel="stylesheet" href="../assets/css/fonts.css" />
        <link rel="stylesheet" href="../assets/css/loginCommon.css">
        
    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- //header -->
            <main>
                <div class="login__popup">
                    <div class="login__wrap">
                        <div class="login__inner">
                            <div class="login__box container">
                                <form name="findId" action="userFindIdSave.php" method="post" onsubmit="return joinChecks()">
                                    <fieldset>
                                        <h2>IT.<em>D</em></h2>
                                        <span>Find ID 🔍</span>
                                        <legend class="ir">아이디 찾기 폼</legend>
                                        <p class="login__desc">회원가입 시 입력한 이메일을 통해 찾아보세요.</p>
                                        <div class="Email_info">
                                            <p class="input__title">E-MAIL</p>
                                            <label for="youEmail">이메일</label>
                                            <input type="text" name="youEmail" id="youEmail" placeholder="이메일을 입력해주세요." class="input__style2" />
                                            <p id="youEmailComment"></p>
                                        </div>
                                        <a href="userFindPw.php">비밀번호 찾기</a>
                                        <button type="submit" class="input__button">아이디 찾기</button>
                                        <button type="button" class="join__button">이전 페이지로 돌아가기</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "../include/footer.php" ?>
            <!-- footer -->
            <script>
                function joinChecks(){
                     //이메일 공백 검사
                     if($("#youEmail").val() == ""){
                        $("#youEmailComment").text("이메일을 입력해주세요!");
                        return false;
                    }

                    //이메일 유효성 검사
                    let getYouEmail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
                    if(!getYouEmail.test($("#youEmail").val())){
                        $("#youEmailComment").text("이메일을 형식에 맞게 작성해주세요!");
                        $("#youEmail").val('');
                        return false;
                    }

                    //이메일 중복 검사
                    if(emailCheck == false) {
                        $("#youEmailComment").text("이메일 중복 검사를 해주세요!");
                        return false;
                    }
                }

                document.querySelector(".join__button").addEventListener("click", () => {
                   history.back();
                });
        </script>
    </body>
</html>
