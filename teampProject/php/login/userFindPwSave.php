<?php
include "../connect/connect.php";
include "../connect/session.php";
$prevPage = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
if($prevPage == '/php/login/userFindPw.php' || $prevPage == '/php/login/userFindPwSave.php'){
}else {
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
    <link rel="stylesheet" href="../assets/css/loginCommon.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/reset.css">

</head>
<body>
<?php include "../include/header.php" ?>
<!-- header -->
        <main id="main">
            <div class="login__popup">
                <div class="login__wrap">
                    <div class="login__inner">
                        <div class="login__box container">
                            <form name="changePw" name="login" method="post">
                                <fieldset>
                                    <h2>IT.<em>D</em></h2>
                                    <span>Change Password 🔍</span>
                                    <legend>비밀번호 찾기 폼</legend>
                                    <p class="login__desc">
                                        회원가입 시 입력한 이메일과 아이디를 통해 비밀번호를 찾아보세요.
                                        임시 비밀번호를 이메일로 보내드립니다!
                                    </p>
                                    <div>
                                        <div class="error__title">
                                            <p class="input__title">새 비밀번호</p>
                                            <p class="error__pw" id="youPassComment"></p>
                                        </div>
                                        <label for="NewPass">새 비밀번호</label>
                                        <input type="password" name="NewPass" id="NewPass" placeholder="비밀번호를 입력해주세요."
                                            class="input__style2">
                                    </div>
                                    <div>
                                        <div class="error__title">
                                            <p class="input__title">비밀번호 확인</p>
                                            <p class="error__pw" id="youPassCComment"></p>
                                        </div>
                                        <label for="PassC">비밀번호 확인</label>
                                        <input type="password" name="PassC" id="PassC" placeholder="비밀번호를 입력해주세요."
                                            class="input__style2">
                                    </div>
                                    <a href="#">아이디 찾기</a>
                                    <button type="submit" class="input__button">비밀번호 변경</button>
                                    <button type="button" class="join__button">이전 페이지로 돌아가기</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- main -->
        <?php include "../include/footer.php" ?>
        <!-- footer -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <?php
                 $userID = $_POST['youId'];
                 $userEmail = $_POST['youEmail'];
                 $userID = $connect -> real_escape_string(trim($userID));
                 $userEmail = $connect -> real_escape_string(trim($userEmail));;
                 echo   "<script> 
                            document.querySelector('form').addEventListener('submit', (event) => {
                               event.preventDefault()
                               findChecks();
                            });
                             function findChecks(){
                                //비밀번호 공백 검사
                                if($('#NewPass').val() == ''){
                                    $('#youPassComment').text('비밀번호를 입력해주세요!');
                                    return false;
                                }
                            
                                //비밀번호 유효성 검사
                                let getYouPass = $('#NewPass').val();
                                let getYouPassNum = getYouPass.search(/[0-9]/g);
                                let getYouPassEng = getYouPass.search(/[a-z]/ig);
                                let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩';:₩/?]/gi);
                                if(getYouPass.length < 8 || getYouPass.length > 20){
                                    $('#youPassComment').text('8자리 ~ 20자리 이내로 입력해주세요!');
                                    return false;
                                } else if(getYouPass.search(/\s/) != -1){
                                    $('#youPassComment').text('비밀번호는 공백없이 입력해주세요!');
                                    return false;
                                } else if(getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0){
                                    $('#youPassComment').text('영문, 숫자, 특수문자를 혼합하여 입력해주세요!');
                                    return false;
                                }
                            
                                //확인 비밀번호 공백 검사
                                if($('#PassC').val() == ''){
                                    $('#youPassCComment').text('확인 비밀번호를 입력해주세요!');
                                    return false;
                                }
                            
                                //비밀번호 동일한지 체크

                                if($('#NewPass').val() !== $('#PassC').val()){
                                    $('#youPassCComment').text('비밀번호가 동일하지않습니다!');
                                    return false;
                                }
                                if($('#NewPass').val() == $('#PassC').val()){
                                    post_to_url('userFindPwChage.php', {'youEmail': '${userEmail}', 'youId': '${userID}', 'NewPass': $('#NewPass').val()});

                                }
                                
                            }
          
                            document.querySelector('.join__button').addEventListener('click', () => {
                                        history.back();
                            });
                       

                             function post_to_url(path, params, method) {
                                method = method || 'post'; 
                                const form = document.createElement('form');
                                form.setAttribute('method', method);
                                form.setAttribute('action', path);
                                for(let key in params) {
                                    let hiddenField = document.createElement('input');
                                    hiddenField.setAttribute('type', 'hidden');
                                    hiddenField.setAttribute('name', key);
                                    hiddenField.setAttribute('value', params[key]);
                                    form.appendChild(hiddenField);
                                }
                                document.body.appendChild(form);
                                form.submit();
                            }
                        </script>";
            ?> 
    </body>
</html>