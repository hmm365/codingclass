<?php
include "../connect/connect.php";
include "../connect/session.php";
$prevPage = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
if($prevPage != '/php/login/userFindId.php'){
    echo "<script>alert('허용되지 않는 잘못된 접근입니다.'); location.href = '../main/main.php'; </script>";
    return;
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메일 전송</title>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/fonts.css" />
    <link rel="stylesheet" href="../assets/css/loginCommon.css" />
</head>
<body>
<?php include "../include/header.php" ?>
<!-- header -->
        <main id="main" class="login__popup">
            <div class="login__wrap">
                <section class="login__inner">
                    <div class="login__box container">
                        <?php
                            $userEmail = $_POST['youEmail'];
                            $userEmail = $connect -> real_escape_string(trim($userEmail));
                            $sql = "SELECT userId, userEmail FROM userMember WHERE userEmail ='$userEmail'";
                            $result = $connect -> query($sql);
                            $rowNum = $result -> num_rows;
                            $row = mysqli_fetch_array($result);
                            if($rowNum == 1){
                                echo "<figure>
                                    <img src='/assets/image/passwordChange_bg.png' alt='회원가입 축하 이미지' />
                                </figure>
                                <p>ID Find complete ✅</p>
                                <span>
                                    찾으시는 아이디는 : ".$row[0]." 입니다.
                                </span>";
                            } else {
                                echo "<figure>
                                    <img src='/assets/image/passwordChange_bg.png' alt='회원가입 축하 이미지' />
                                </figure>
                                <p>에러 발생</p>
                                <span>
                                     $userEmail 메일로 등록된 된 아이디 값이 없습니다.
                                </span>";
                            }
                        ?>
                        <!-- <div class="login_Box">
                            <figure>
                                <img src="/assets/image/Congratulations_bg.png" alt="회원가입 축하 이미지" />
                            </figure>
                            <p>회원가입을 축하합니다!</p>
                            <span>
                                *** 님의 회원가입을 축하드립니다! <br />
                                저희 IT.D 사이트는 <br />
                                다양한 이미지 다운로드 기능을 무료로 제공해드리고 있습니다. <br />
                                외에도 앞으로 다양한 기능이 추가되고 이벤트도 있으니 <br />
                                많은 방문 부탁드립니다. <br />
                                다시 한 번 회원가입을 축하드립니다!
                            </span>
                            <button type="button">메인으로 이동하기</button>
                        </div> -->
                        <button type='button'>메인으로 이동하기</button>
                    </div>
                </section>
            </div>
        </main>
        <!-- main -->
        <?php include "../include/footer.php" ?>
        <!-- footer -->
        <script>
            window.onload = function(){
                document.querySelector(".login__box button").addEventListener("click", () => {
                    location.href = '../main/main.php';
                    });
            }
        </script>
    </body>
</html>