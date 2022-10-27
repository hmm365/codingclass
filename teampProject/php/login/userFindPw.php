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
        <title>비밀번호 찾기</title>
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
                            <form method="post">
                                <fieldset>
                                    <h2>IT.<em>D</em></h2>
                                    <span>Find Password 🔍</span>
                                    <legend class="blind">비밀번호 찾기 폼</legend>
                                    <p class="login__desc">회원가입 시 입력한 이메일과 아이디를 통해 비밀번호를 찾아보세요. 임시 비밀번호를 이메일로 보내드립니다!</p>
                                    <div class="login__id">
                                        <p class="input__title">ID</p>
                                        <label for="youID">ID</label>
                                        <input type="id" name="youID" id="youID" placeholder="아이디를 입력해주세요." class="input__style1"  />
                                        <p id="youIdComment"></p>
                                    </div>
                                    <div>
                                        <p class="input__title">E-MAIL</p>
                                        <label for="youEmail">이메일</label>
                                        <input type="text" name="youEmail" id="youEmail" placeholder="이메일을 입력해주세요." class="input__style2"  />
                                        <p id="youEmailComment"></p>
                                    </div>
                                        <p id="Comment"></p>
                                    <a href="userFindId.php">아이디 찾기</a>
                                    <button type="submit" class="input__button">비밀번호 변경하기</button>
                                    <button type="button" class="join__button">이전 페이지로 돌아가기</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- //footer -->
        <?php include "../include/footer.php" ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
                document.querySelector("form").addEventListener("submit", (event) => {
                    event.preventDefault()
                    findChecks();
                });

                function findChecks(){
                    //아이디 공백 검사
                    if($("#youID").val() == ""){
                        $("#youIdComment").text("ID을 입력해주세요!");
                        return false;
                    }
                    //아이디 유효성 검사
                    let getyouId = RegExp(/^[a-zA-Z0-9]+/);
                    if(!getyouId.test($("#youID").val())){
                          $("#youIdComment").text("ID 형식에 맞게 작성해주세요!");
                          $("#youID").val('');
                    }

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

                    //이메일 아이디가 같은지 체크

                    let youEmail = $("#youEmail").val();
                    let youId = $("#youID").val();
                    if(youId == null || youId == ''){
                        $("#youIdComment").text("아이디를 입력해주세요!!");
                        return false;
                    } else if(youEmail == null || youEmail == ''){
                        $("#youEmailComment").text("이메일을 입력해주세요!!");
                        return false;
                    } else {
                        $.ajax({
                            type : "POST",
                            url : "userCheck.php",
                            data : {"userEmail": youEmail, "userId": youId, "type": "Check"},
                            dataType : "json",
                            success : function(data){
                                if(data.result == "good"){
                                    post_to_url('userFindPwSave.php', {'youEmail': youEmail, 'youId': youId});
                                    return true;
                                } else if (data.result == "bad") {
                                    $("#Comment").text("이메일 과 아이디가 일치하지 않습니다.");
                                    return false;
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
                
                function post_to_url(path, params, method) {
                    method = method || "post"; 
                    const form = document.createElement("form");
                    form.setAttribute("method", method);
                    form.setAttribute("action", path);
                    for(let key in params) {
                        let hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", key);
                        hiddenField.setAttribute("value", params[key]);
                        form.appendChild(hiddenField);
                    }
                    document.body.appendChild(form);
                    form.submit();
                }

                document.querySelector(".join__button").addEventListener("click", () => {
                   history.back();
                });
        </script>
        
    </body>
</html>
