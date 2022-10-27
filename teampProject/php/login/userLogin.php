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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/loginCommon.css">
</head>
<!-- userLoginSave.php -->
<body>
<?php include "../include/header.php" ?>
<!-- header -->
    <main>
        <div class="login__popup">
            <div class="login__wrap">
                <div class="login__inner">
                    <div class="login__box container">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="login" onsubmit="return loginChecks()">
                            <fieldset>
                                <h2>IT.<em>D</em></h2>
                                <span>Welcome!🎉</span>
                                <p class="input__header">
                                    이메일과 비밀번호를 적어 로그인 하시면 스크랩 기능까지 가능하게 됩니다.
                                    아직 회원이 아니시라면 아래 회원가입 버튼을 눌러주시길 바랍니다.
                                    좋은 시간 되시길 바랍니다!
                                </p>
                                <legend class="blind">로그인 입력 폼</legend>
                                <div>
                                    <p class="input__title">ID</p>
                                    <p id="youIdComment"></p>
                                    <p class="erro"></p>
                                    <label for="youId">ID</label>
                                    <input type="text" name="youId" id="youId" placeholder="아이디를 입력해주세요."
                                        class="input__style1">
                             
                                </div>
                                <div>
                                    <p class="input__title">PASSWORD</p>
                                    <p id="youPassComment"></p>
                                    <label for="youPass">비밀번호</label>
                                    <input type="password" name="youPass" id="youPass" placeholder="비밀번호를 입력해주세요."
                                        class="input__style2">
                                    
                                </div>
                                <div class="lost">
                                    <a href="userFindPw.php" class="input__lost">비밀번호 찾기</a>
                                    <a href="userFindId.php" class="input__lost">아이디 찾기</a>
                                </div>
                                <!-- <p class="erro"></p> -->
                                <button type="submit" class="input__button">로그인</button>
                                <button type="button" class="join__button">회원가입</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <!-- //main -->
    <?php include "../include/footer.php" ?>
    <!-- //footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function loginChecks(){
            //아이디 공백 검사
            document.querySelector('.erro').innerText = ''
            if($("#youId").val() == ""){
                $("#youIdComment").text("ID을 입력해주세요!");
                return false;
            }
            //아이디 유효성 검사
            let getyouId = RegExp(/^[a-zA-Z0-9]+/);
            if(!getyouId.test($("#youId").val())){
                $("#youIdComment").text("ID 형식에 맞게 작성해주세요!");
                $("#youId").val('');
            }

            //비밀번호 공백 검사
            if($("#youPass").val() == ""){
                $("#youPassComment").text("비밀번호를 입력해주세요!");
                return false;
            }

            //비밀번호 유효성 검사
            let getYouPass = $("#youPass").val();
            if(getYouPass.length < 8 || getYouPass.length > 20){
                $("#youPassComment").text("8자리 ~ 20자리 이내로 입력해주세요!");
                return false;
            } 
            
            
        }

        document.querySelector(".join__button").addEventListener("click", () => {
            location.href = "userJoinSevice.php";
        });
    </script>
    <?php
        if($userID = $_POST['youId']){
               $userID = $_POST['youId'];
               $userPass = $_POST['youPass'];

               // echo $youEmail, $youPass; 
               $userID = $connect -> real_escape_string(trim($userID));
               $userPass = $connect -> real_escape_string(trim($userPass));
               $userPass = sha1("web".$userPass);

               // 데이터 가져오기 --> 유효성 검사  -->  데이터 조회  --> 로그인
               $sql = "SELECT userMemberID, userEmail, userID ,userName, userPass FROM userMember WHERE userId = '$userID' AND userPass = '$userPass'";
               $result = $connect -> query($sql);


               if($result){
                   $count = $result -> num_rows;
            
                   if($count != 0){
                       echo "<script>document.querySelector('.erro').innerText = '로그인성공'</script>";
                       $info = $result -> fetch_array(MYSQLI_ASSOC);
                       $_SESSION['userMemberID'] = $info['userMemberID'];
                       $_SESSION['userId'] = $info['userID'];
                       $_SESSION['userName'] = $info['userName'];
                       echo "<script>location.href = '../main/main.php';</script>";

                   } else {
                       echo "<script>document.querySelector('#youId').value = '$userID'</script>"; 
                       echo "<script>document.querySelector('.erro').innerText = '아이디 또는 비밀번호가 틀렸습니다.'</script>"; 
                   }
               } else {
                   echo "<script>document.querySelector('.erro').innerText = '에러발생 - 관리자에게 문의하세요!'</script>"; 
               }
            }
    ?>

</body>

</html>