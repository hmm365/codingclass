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
        <section id="banner" class="container section">
            <h2 class="blind">회원가입 축하합니다.</h2>
            <div class="banner__inner style2">
                <div class="img">
                    <img src="../assets/img/banner_img03.svg" alt="배너 이미지">
                </div>
                <div class="desc">
                    어떤 일이라도 <em>노력</em>하고 즐기면 그 결과는 <em>빛</em>을 바란다고 생각합니다.<br>
                    회원가입을 축하드립니다.
<?php
    $youEmail = $_POST['youEmail'];
    $youName = $_POST['youName'];
    $youPass = $_POST['youPass'];
    $youPassC = $_POST['youPassC'];
    $youPhone = $_POST['youPhone'];
    $regTime = time();
    // 메세지 출력
    function msg($alert){
        echo "<p class='alert'>${alert}</p>";
        echo "<a class='btn btn_style1 mt30' href='../login/login.php'>로그인</a>";
    }
    // echo $youEmail, $youName, $youPass, $youPhone, $regTime;
    // $sql = "INSERT INTO hwangMember(youEmail, youName, youPass, youPhone, regTime) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime')";
    // $connect -> query($sql);
    // 유효성 검사
    // 이메일 체크(정규식 표현)
    // $check_email = preg_match("/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i", $youEmail);
    // if($check_email == false){
    //     echo "이메일이 잘모되었습니다.<br> 올바른 이메일을 작성해주세요";
    // }

    // 이메일 체크(내장 함수)
    $check_email = filter_var($youEmail, FILTER_VALIDATE_EMAIL);
    if($check_email == false){
        msg("이메일이 잘못되었습니다.<br> 올바른 이메일을 작성해주세요");
    }

    // 이름 유효성 검사 : 정규식 표현, 한글만, 3-5글자
    $check_name = preg_match("/^[가-힣]{3,15}$/", $youName);
    if($check_name == false){
        msg("이름은 한글로(3~5)만 작성할 수 있습니다.<br> 올바른 이름을 작성해주세요");
        exit;
    }

    // 비밀번호 유효성 검사
    if($youPass !== $youPassC){
        msg("비밀번호가 일치하지 않습니다. <br> 다시 한번 확인해주세요!");
        exit;
    }

    // 비밀번호 암호화
    // $youPass = sha1($youPass);

    // 휴대폰 번호 유효성 검사
    $check_number = preg_match("/^(010|011|016|017|018|019)-[0-9]{3,4}-[0-9]{4}$/", $youPhone);
    if($check_number == false){
        msg("번호가 정확하지 않습니다..<br> 올바른 번호(000-0000-0000)를 작성해주세요");
        exit;
    }
    // 회원가입 데이터 입력 --> 유효성 검사 --> 이메일주소/핸드폰(중복X) --> 회원가입(데이터베이스 입력)
    // 회원가입 데이터 입력 --> 유효성 검사 --> 이메일주소/핸드폰(중복O) --> 로그인 페이지 유도
    // 이메일 중복 검사
    $isEmailCheck = false;
    $sql = "SELECT youEmail FROM myMember WHERE youEmail = '$youEmail'";
    $result = $connect -> query($sql);
    if($result){
        $count = $result -> num_rows;
        if($count == 0){
            //회원가입 가능
            $isEmailCheck = true;
        } else {
            //회원가입 불가능
            msg("이미 회원가입이 되어 있습니다. 로그인 해주세요!!");
            exit;
        }
    } else {
        msg("에러발생1 : 관리자에게 문의하세요!");
        exit;
    }
    // 핸드폰 중복 검사
    $isPhoneCheck = false;
    $sql = "SELECT youPhone FROM myMember WHERE youPhone = '$youPhone'";
    $result = $connect -> query($sql);
    if($result){
        $count = $result -> num_rows;
        if($count == 0){
            //회원가입 가능
            $isPhoneCheck = true;
        } else {
            //회원가입 불가능
            msg("이미 회원가입이 되어 있습니다. 로그인 해주세요!!");
            exit;
        }
    } else {
        msg("에러발생2 : 관리자에게 문의하세요!");
        exit;
    }
    // 회원가입
    if($isEmailCheck == true && $isPhoneCheck == true){
        $sql = "INSERT INTO myMember(youEmail, youName, youPass, youPhone, regTime) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime')";
        $result = $connect -> query($sql);
        if($result){
            msg("회원가입을 축하합니다. 로그인 해주세요!");
            exit;
        } else {
            msg("에러발생3 : 관리자에게 문의하세요!");
            exit;
        }
    } else {
        msg("이미 가입되어 있습니다. 로그인 해주세요!!");
        exit;
    }
?>
                </div>
                <a class="btn btn_style1 mt30" href="main.html">메인으로</a>
            </div>
        </section>
        <!-- //banner -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"?>
    <!-- footer -->
</body>
</html>