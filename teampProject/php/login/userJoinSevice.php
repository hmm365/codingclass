<!DOCTYPE html>
<?php
include "../connect/connect.php";
include "../connect/session.php";
if( isset($_SESSION['userMemberID']) ){ 
    echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
    }
?>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 입력</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/loginCommon.css">
</head>
    <body>
        <main>
        <?php include "../include/header.php" ?>
<!-- header -->
            <section id="joinAgree">
                <div class="agree__wrap container">
                    <h2>IT.<em>D</em></h2>
                    <p>Terms of service 🥑</p>
                    <div class="checkbox__top">
                        <input type="checkbox" name="agreeCheck4" id="agreeCheck4" />
                        <label for="agreeCheck4">IT.D 이용약관, 개인정보 수집 및 이용에 모두 동의합니다.</label>
                    </div>
                    <div class="agree__inner">
                        <div>
                            <div class="checkbox__inner">
                                <input type="checkbox" name="agreeCheck1" id="agreeCheck1" />
                                <label for="agreeCheck1">IT.D 이용약관 동의</label>
                            </div>
                            <div class="desc">
                                <ul>
                                    <li>회원가입은 1인당 1개의 이메일 계정을 이용할 수 있습니다.</li>
                                    <li>개인정보를 수집 및 이용하며, 회원의 개인정보를 안전하게 취급하고, 교육목적으로 사용됩니다.</li>
                                    <li>목적 : 가입자 개인 식별, 가입 의사 확인, 가입자와의 원활한 의사소통, 가입자와의 교육 커뮤니테이션</li>
                                    <li>항목 : 아이디(이메일주소), 비밀번호, 이름, 생년월일, 휴대폰번호</li>
                                    <li>보유기간 : 회원 탈퇴 시까지 보유(탈퇴일로부터 즉시 파기합니다.)</li>
                                    <li>개인정보 수집에 대한 동의를 거부할 권리가 있으며, 회원 가입시 개인정보 수집을 동의함으로 간주합니다.</li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="checkbox__footer">
                                <input type="checkbox" name="agreeCheck2" id="agreeCheck2" />
                                <label for="agreeCheck2">IT.D 개인정보 수집 및 이용 동의</label>
                            </div>
                            <div class="desc">
                                <ul>
                                    <li>이용자는 회원가입을 하지 않아도 정보 검색, 뉴스 보기 등 대부분의 네이버 서비스를 회원과 동일하게 이용할 수 있습니다. 이용자가 메일, 캘린더, 카페, 블로그 등과 같이 개인화 혹은 회원제 서비스를 이용하기 위해 회원가입을 할 경우, 네이버는 서비스 이용을 위해 필요한 최소한의 개인정보를 수집합니다.</li>
                                </ul>
                            </div>
                        </div>
                        <a href="#c" class="btn">확인</a>
                        <a href="javascript:history.back();" class="btn__prev">이전 페이지로 돌아가기</a>
                    </div>
                </div>
            </section>
        </main>
        <!-- //main -->
        <?php include "../include/footer.php" ?>
        <!-- //footer -->
        <script src="../assets/js/userSevice.js"></script>
</body>
</html>