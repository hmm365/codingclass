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
        <section id="banner" class="container section">
            <h2 class="blind">회원가입 축하합니다.</h2>
            <div class="banner__inner style2">
                <div class="img">
                    <img src="../assets/img/banner_img03.svg" alt="배너 이미지">
                </div>
                <div class="desc">
                    어떤 일이라도 <em>노력</em>하고 즐기면 그 결과는 <em>빛</em>을 바란다고 생각합니다.<br>
<?php
    $youEmail = $_POST['youEmail'];
    $youPass = $_POST['youPass'];
    // echo $youEmail, $youPass;
    function msg($alert){
        echo "<p class='alert'>${alert}</p>";
        echo "<a class='btn btn_style1 mt30' href='../login/login.php'>로그인</a>";
    }
    // 데이터 조회
    $sql = "SELECT memberID, youEmail, youName, youPass FROM myMember WHERE youEmail = '$youEmail' AND youPass = '$youPass'";
    $result = $connect -> query($sql);
    if($result){
        $count = $result -> num_rows;
        if($count == 0){
            msg("이메일 또는 비밀번호가 틀렸습니다.");
        } else {
            //로그인 성공
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
            //섹션 생성
            $_SESSION['memberID'] = $memberInfo['memberID'];
            $_SESSION['youEmail'] = $memberInfo['youEmail'];
            $_SESSION['youName'] = $memberInfo['youName'];
            // echo "<pre>";
            // var_dump($result);
            // echo "<pre>";
            Header("Location: ../main/main.php");
        }
    } else {
        msg("에러발생 - 관리자에게 문의하세요");
    }
?>
                </div>
                <!-- <a class="btn btn_style1 mt30" href="main.html">메인으로</a> -->
            </div>
        </section>
        <!-- //banner -->
    </main>
    <!-- main -->

    <?php include "../include/footer.php"?>
    <!-- footer -->
</body>
</html>