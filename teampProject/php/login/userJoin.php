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
    <title>회원가입 입력</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="stylesheet" href="../assets/css/loginCommon.css">
  

</head>
<?php include "../include/header.php" ?>
<!-- header -->
<body>
    <main>
        <div class="login__popup">
            <div class="login__wrap">
                <div class="login__inner">
                    <div class="login__box container">
                        <form action="userJoinSave.php" name="join" method="post" onsubmit="return joinChecks()">
                            <fieldset>
                                <h2>IT.<em>D</em></h2>
                                <span>Create an account 📌</span>
                                <legend class="blind">회원가입 입력 폼</legend>
                                <div class="overlay">
                                    <div class="input__alert">
                                        <p class="input__title">ID</p>
                                        <p class="msg" id="youIdComment"></p>
                                    </div>
                                    <label for="youID">ID</label>
                                    <div class="input__error">
                                        <input type="text" name="youID" id="youID" placeholder="아이디를 입력해주세요."
                                            class="input__style1" >
                                        <a href="#c" class="check" onclick="idChecking()">중복검사</a>
                                    </div>
                                </div>
                                <div class="overlay">
                                    <div class="input__alert">
                                        <p class="input__title">E-MAIL</p>
                                        <p class="msg" id="youEmailComment">
                                        </p>
                                    </div>
                                    <label for="youEmail">이메일</label>
                                    <div class="input__error">
                                        <input type="eamil" name="youEmail" id="youEmail" placeholder="이메일을 입력해주세요."
                                            class="input__style3" >
                                        <a href="#c" class="check" onclick="emailChecking()">중복검사</a>
                                    </div>
                                </div>
                                <div class="overlay">
                                    <div class="input__alert">
                                        <p class="input__title">Name</p>
                                        <p class="msg" id="youNameComment">
                                        </p>
                                    </div>
                                    <label for="youName">Name</label>
                                        <input type="name" name="youName" id="youName" placeholder="성함을 입력해주세요."
                                            class="input__style4" >
                                </div>
                                <div class="overlay">
                                    <div class="input__alert">
                                        <p class="input__title">PASSWORD</p>
                                        <p class="msg" id="youPassComment">
                                        </p>
                                    </div>
                                    <label for="youPass">비밀번호</label>
                                    <input type="password" name="youPass" id="youPass" placeholder="비밀번호를 입력해주세요."
                                        class="input__style4" >
                                </div>
                                <div class="overlay">
                                    <div class="input__alert">
                                        <p class="input__title">PASSWORD CHECK</p>
                                        <p class="msg" id="youPassCComment">
                                        </p>
                                    </div>
                                    <label for="youPassC">비밀번호 확인</label>
                                    <input type="password" name="youPassC" id="youPassC"
                                        placeholder="비밀번호를 다시한번 입력해주세요." class="input__style5" >
                                </div>
                                <button type="submit" class="input__button">계정 생성</button>
                                <button type="button" class="join__button">이전 페이지로 돌아가기</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- //main -->
    <?php include "../include/footer.php" ?>
    <!-- footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let emailCheck = false;
        let idCheck = false;
        function emailChecking(){
            let youEmail = $("#youEmail").val();
            if(youEmail == null || youEmail == ''){
                $("#youEmailComment").text("이메일을 입력해주세요!!");
            } else {
                $.ajax({
                    type : "POST",
                    url : "userJoinCheck.php",
                    data : {"youEmail": youEmail, "type": "emailCheck"},
                    dataType : "JSON",
                    success : function(data){
                        if(data.result == "good"){
                            let getYouEmail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
                            if(!getYouEmail.test($("#youEmail").val())){
                                $("#youEmailComment").text("이메일을 형식에 맞게 작성해주세요!");
                                $("#youEmail").val('');
                                emailCheck = false;
                            } else {
                                $("#youEmailComment").text("사용 가능한 이메일입니다.");
                                emailCheck = true;
                            }
                           
                        } else {
                            $("#youEmailComment").text("이미 존재하는 이메일입니다.");
                            emailCheck = false;
                        }
                    },
                    error : function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        }
        

        function idChecking(){
            let youId = $("#youID").val();

            if(youId == null || youId == ''){
                $("#youIdComment").text("ID를 입력해주세요!!");
            } else {
                $.ajax({
                    type : "POST",
                    url : "userJoinCheck.php",
                    data : {"youId": youId, "type": "idCheck"},
                    dataType : "JSON",
                    success : function(data){
                        if(data.result == "good"){
                            let getyouId = RegExp(/^[a-zA-Z0-9]+/);
                            if(!getyouId.test($("#youID").val())){
                                $("#youIdComment").text("ID 형식에 맞게 작성해주세요!");
                                $("#youID").val('');
                                idCheck = false;
                            } else {
                                $("#youIdComment").text("사용 가능한 ID입니다.");
                                idCheck = true;
                            }

                           
                        } else {
                            $("#youIdComment").text("이미 존재하는 ID입니다.");
                            idCheck = false;
                        }
                    },
                    error : function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        }

        function joinChecks(){
            //아이디 공백 검사
            if($("#youID").val() == ""){
                $("#youIdComment").text("ID을 입력해주세요!");
                return false;
            }

            // //아이디 유효성 검사
            // let getyouId = RegExp(/^[a-zA-Z0-9]+/);
            // if(!getyouId.test($("#youID").val())){
            //     $("#youIdComment").text("ID 형식에 맞게 작성해주세요!");
            //     $("#youID").val('');
            //     return false;
            // }

            //아이디 중복 검사
            if(idCheck == false) {
                $("#youIdComment").text("ID 중복 검사를 해주세요!");
                return false;
            }

             //이메일 공백 검사
             if($("#youEmail").val() == ""){
                $("#youEmailComment").text("이메일을 입력해주세요!");
                return false;
            }

            // //이메일 유효성 검사
            // let getYouEmail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
            // if(!getYouEmail.test($("#youEmail").val())){
            //     $("#youEmailComment").text("이메일을 형식에 맞게 작성해주세요!");
            //     $("#youEmail").val('');
            //     return false;
            // }

            //이메일 중복 검사
            if(emailCheck == false) {
                $("#youEmailComment").text("이메일 중복 검사를 해주세요!");
                return false;
            }

            //이름 공백 확인
            if($("#youName").val() == ""){
                $("#youNameComment").text("이름을 입력해주세요!!");
                return false;
            }

            //이름 유효성 확인
            let getyouName = RegExp(/^[가-힣]+/);
            if(!getyouName.test($("#youName").val())){
                $("#youNameComment").text("이름은 한글만 사용가능합니다!");
                $("#youName").val('');
                return false;
            }

            //비밀번호 공백 검사
            if($("#youPass").val() == ""){
                $("#youPassComment").text("비밀번호를 입력해주세요!");
                return false;
            }

            //비밀번호 유효성 검사
            let getYouPass = $("#youPass").val();
            let getYouPassNum = getYouPass.search(/[0-9]/g);
            let getYouPassEng = getYouPass.search(/[a-z]/ig);
            let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
            if(getYouPass.length < 8 || getYouPass.length > 20){
                $("#youPassComment").text("8자리 ~ 20자리 이내로 입력해주세요!");
                return false;
            } else if(getYouPass.search(/\s/) != -1){
                $("#youPassComment").text("비밀번호는 공백없이 입력해주세요!");
                return false;
            } else if(getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0){
                $("#youPassComment").text("영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                return false;
            }

            //확인 비밀번호 공백 검사
            if($("#youPassC").val() == ""){
                $("#youPassCComment").text("확인 비밀번호를 입력해주세요!");
                return false;
            }

            //비밀번호 동일한지 체크
            if($("#youPass").val() == $("#youPassC").val()){
                $("#youPassCComment").text("비밀번호가 동일합니다!");
            }

            if($("#youPass").val() !== $("#youPassC").val()){
                $("#youPassCComment").text("비밀번호가 동일하지않습니다!");
                return false;
            }
        }

        document.querySelector(".join__button").addEventListener("click", () => {
           history.back();
        });
    </script>
</body>
</html>