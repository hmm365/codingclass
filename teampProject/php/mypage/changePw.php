<?php
include "../connect/connect.php";
include "../connect/session.php";

?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>비밀번호 찾기</title>
        <link rel="stylesheet" href="../assets/css/reset.css" />
        <link rel="stylesheet" href="../assets/css/common.css" />
        <link rel="stylesheet" href="../assets/css/fonts.css" />
        <link rel="stylesheet" href="../assets/css/loginCommon.css" />
        <style>
            @import url('https://webfontworld.github.io/gmarket/GmarketSans.css');
        </style>
        <style>
            .mypage_banner {
                width: 100%;
                background: #1363df;
                height: 200px;
                position: relative;
            }

            .banner_inner {
                display: flex;
                justify-content: center;
                align-items: center;
                line-height: 200px;
                margin-top: 120px;
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
            }

            .banner_inner > p {
                font-weight: bold;
                font-size: 20px;
                color: #fff;
                opacity: 0.8;
            }

            .banner_inner .banner_udline {
                width: 94px;
                height: 5px;
                background: #fff;
                position: absolute;
                bottom: 75px;
                opacity: 0.2;
            }

            .login__popup {
                padding-top: 0;
            }
        
        </style>
    </head>

    <body>
        <?php include "../include/header.php" ?>
        <!-- header -->
        <section class="mypage_banner">
            <div class="banner_inner container">
                <p>MY PAGE</p>
                <div class="banner_udline"></div>
            </div>
        </section>
        <!-- banner -->
        <div class="login__popup">
            <div class="login__wrap">
                <div class="login__inner">
                    <div class="login__box container">
                        <form name="login">
                            <fieldset>
                                <span>Password Change 🔍</span>
                                <legend>비밀번호 찾기 폼</legend>
                                <p class="login__desc">비밀번호를 변경하겠습니다</p>
                                <div>
                                    <div class="error__title">
                                        <p class="input__title">이전 비밀번호</p>
                                        <p class="error__pw" id="nowpass"></p>
                                    </div>
                                    <label for="PrePass">이전 비밀번호</label>
                                    <input type="password" name="PrePass" id="PrePass" placeholder="비밀번호를 입력해주세요." class="input__style1" />
                                </div>
                                <div>
                                <div class="error__title">
                                        <p class="input__title">새 비밀번호</p>
                                        <p class="error__pw" id="newnowpass"></p>
                                    </div>
                                    <label for="NewPass" >새 비밀번호</label>
                                    <input type="password" name="NewPass" id="NewPass" placeholder="비밀번호를 입력해주세요." class="input__style2" />
                                </div>
                                <div>
                                    <div class="error__title">
                                        <p class="input__title">비밀번호 확인</p>
                                        <p class="error__pw" id="newnowpassC"></p>
                                    </div>
                                    <label for="PassC">비밀번호 확인</label>
                                    <input type="password" name="PassC" id="PassC" placeholder="비밀번호를 입력해주세요." class="input__style2" />
                                </div>
                                <button type="button" class="input__button">비밀번호 변경</button>
                                <button type="button" class="join__button">이전 페이지로 돌아가기</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../include/footer.php" ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <script> 
            $(".input__button").click(function (e) {
                let newPass = $('#NewPass').val()
                let prepass = document.querySelector("#PrePass").value
                $.ajax({
                url: "mypagePassModify.php",
                method: "POST",
                dataType: "json",
                data: {
                    "type": "prePass",
                    "prePass": prepass
                },
                    success: function(data) {
                        if(data.result == 'good'){
                            //비밀번호 공백 검사
                            if($('#NewPass').val() == ''){
                                $('#newnowpass').text('비밀번호를 입력해주세요!');
                                return false;
                            }
                            //비밀번호 유효성 검사
                            let getYouPass = $('#NewPass').val();
                            
                            let getYouPassNum = getYouPass.search(/[0-9]/g);
                            let getYouPassEng = getYouPass.search(/[a-z]/ig);
                            let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩';:₩/?]/gi);
                            if(getYouPass.length < 8 || getYouPass.length > 20){
                                $('#newnowpass').text('8자리 ~ 20자리 이내로 입력해주세요!');
                                return false;
                            } else if(getYouPass.search(/\s/) != -1){
                                $('#newnowpass').text('비밀번호는 공백없이 입력해주세요!');
                                return false;
                            } else if(getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0){
                                $('#newnowpass').text('영문, 숫자, 특수문자를 혼합하여 입력해주세요!');
                                return false;
                            }

                            //확인 비밀번호 공백 검사
                            if($('#PassC').val() == ''){
                                $('#newnowpassC').text('확인 비밀번호를 입력해주세요!');
                                return false;
                            }

                            //비밀번호 동일한지 체크
                            if($('#NewPass').val() !== $('#PassC').val()){
                                $('#newnowpassC').text('비밀번호가 동일하지않습니다!');
                                return false;
                            }
                            if($('#NewPass').val() == $('#PassC').val()){
                                $.ajax({
                                    url: " mypagePassModify.php",
                                    method: "POST",
                                    dataType: "json",
                                    data: {
                                        "type": "newPass",
                                        "newPass": newPass
                                    },
                                    success: function(data) {
                                        alert("비밀번호를 변경하였습니다.");
                                        history.back();
                                    },
                                    error: function(request, status, error){
                                        console.log("request" + request);
                                        console.log("status" + status);
                                        console.log("error" + error);
                                    }
                                })
                            } else { alert("비밀번호를 변경하지못하였습니다.");}
                        } else { $('#nowpass').text("비밀번호가 일치하지않습니다.");
                            document.querySelector("#PrePass").value = '';    
                        } 
                    }, 
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            })
            $(".join__button").click(function () {
                history.back();
            })
        </script>

    </body>
</html>
