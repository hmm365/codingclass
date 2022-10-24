<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>

    <?php include "../include/link.php" ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main">
        <section id="banner"> 
            <h2>로그인 페이지입니다.</h2>
            <div class="banner__inner2 container">
                <div class="img">
                    <img src="../assets/img/banner_img02.svg" alt="배너 이미지">
                </div> 
                <div class="desc">
<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youEmail = $_POST['youEmail'];
    $youPass = $_POST['youPass'];

    // echo $youEmail, $youPass; 

    function msg($alert){
        echo "<p class='arert'>{$alert}<p/>";
    }

    // 이메일 검사
    if( !filter_var($youEmail, FILTER_VALIDATE_EMAIL)){
        msg("이메일이 잘못되었습니다 <br> 올바른 이메일을 적어주세요!!!");
        exit;
    }

    // 비밀번호 검사
    if( $youPass == null || $youPass == '' ){
        msg("비밀번호를 입력해주세요!");
        exit;
    }

    // 데이터 가져오기 --> 유효성 검사  -->  데이터 조회  --> 로그인
    $sql = "SELECT myMemberID, youEmail, youName, youPass FROM myMember WHERE youEmail = '$youEmail' AND youPass = '$youPass'";
    $result = $connect -> query($sql);

    if($result){
        $count = $result -> num_rows;

        if($count == 0){
            msg("이메일 또는 비밀번호가 틀렸습니다.");
            
        } else {
            $info = $result -> fetch_array(MYSQLI_ASSOC);

            $_SESSION['myMemberID'] = $info['myMemberID'];
            $_SESSION['youEmail'] = $info['youEmail'];
            $_SESSION['youName'] = $info['youName'];

            // echo "<pre>";
            // var_dump($info);
            // echo "</pre>";

            Header("Location: ../main/main.php");
        }
    } else {
        msg("에러발생 - 관리자에게 문의하세요!");
    }
?>
                </div>
            </div>
        </section>
        <!-- //banner -->

    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <?php include "../login/login.php" ?>
    <!-- //login -->

    <!-- script -->
    <script src="../assets/js/custom.js"></script>
</body>
</html>










