<?php
include "../connect/connect.php";
include "../connect/session.php";
if( !isset($_SESSION['userMemberID']) ){ 
    echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
}
$userMemberId = $_SESSION['userMemberID'];
$userSql = "SELECT * FROM userMember WHERE userMemberID = '$userMemberId'";
$userResult = $connect -> query($userSql);
$userInfo = $userResult -> fetch_array(MYSQLI_ASSOC);

$page = 1;
$viewNum = 8;

$viewLimit = ($viewNum * $page) - $viewNum;
$boardSql = "SELECT * FROM categoryBoard as b JOIN userMember as m ON b.userMemberID = m.userMemberID  WHERE m.userMemberID = '$userMemberId' ORDER BY b.categgoryBoardID DESC ";
$boardResult = $connect -> query($boardSql);
$boardcount = $boardResult -> num_rows;
$boardSql .= "LIMIT {$viewLimit}, {$viewNum} ";
$boardResult = $connect -> query($boardSql);


?>
<!DOCTYPE html>
<html lang='ko'>
    <head>
        <meta charset='UTF-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <title>마이페이지</title>

        <link rel='stylesheet' href='../assets/css/reset.css' />
        <link rel='stylesheet' href='../assets/css/common.css' />
        <link rel='stylesheet' href='../assets/css/fonts.css' />
        <link rel='stylesheet' href='../assets/css/mypage.css' />
        <link rel='stylesheet' href='../assets/css/modal.css' />

    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- header -->
        
        <main id='main'>
            <section class='mypage__wrap'>
                <div class='mypage__banner'>
                    <div class='banner__inner container'>
                        <h2 class='banner_title'>MY PAGE</h2>
                        <p class='banner_udline'></p>
                    </div>
                </div>

                <div class='mypage__info container'>
                    <div class='info__profile'>
                        <div>
                            <img class='info__profile_img' src='../assets/userimg/<?=$userInfo['userPhoto']?>' alt='프로필 이미지' />
                            <div>
                                <from id="uploadForm">
                                    <label for="userFile" class='modify_profile_input'>사진 변경</label>
                                    <input type="file" enctype="multipart/form-data" name="userFile" id="userFile" accept=".jpg, .jpeg .png, .gif" style= 'display : none' >
                                    <button type='button' class='modify_profile_cancel' >취소</button>
                                    <!-- placeholder="jpg, png, gif 파일만 넣어주세요!" -->
                                    <button type='button' class='modify_profile' >변경</button>
                                </from>
                            </div>
                        </div>
                        <div class='info_change'>
                            <div>
                                <label for='nickname' class='ir'><?=$userInfo['userNickName']?></label>
                                <input type='text' id='nickname' class='nickname' name='nickname' placeholder='1~10글자까지' value='<?=$userInfo['userNickName']?>' />
                            </div>
                            <div>
                                <button type='button' class='modify_nickname_cancel'>취소</button>
                                <button type='button' class='modify_nickname_complete'>변경</button>
                            </div>
                            </div>
                        <div class='info'>
                            <p class='nickname'><?=$userInfo['userNickName']?></p>
                            <button type='button' class='modify_nickName'>수정</button>
                        </div>
                    </div>
                    <div class='info__personal'>
                        <div class='info__title'>
                            <p>Gender</p>
                            <p>Phone</p>
                            <p>E-mail</p>
                            <p>Upload</p>
                        </div>
                        <div class='info__desc'>
                            <div class='personal_gender_change'>
                                <form>
                                    <label for='gender' class='ir'>성별</label>
                                    <input type='text' id='gender' class='gender' name='gender' placeholder='male or female' value='<?=$userInfo['userGender']?>' />
                                    <button type='button' class='modify_gender_cancel'>취소</button>
                                    <button type='button' class='modify_gender_complete'>변경</button>
                                </form>
                            </div>
                            <div class='personal_gender'>
                                <form>
                                    <label for='gender' class='ir'>성별</label>
                                    <input type='text' id='gender_val' class='gender' name='gender_val' placeholder='male or female' value='<?=$userInfo['userGender']?>' disabled/>
                                    <button type='button' class='modify_gender'>수정</button>
                                </form>
                            </div>

                            <div class='personal_phone_change'>
                                <form>
                                    <label for='phone' class='ir'>전화번호</label>
                                    <input type='text' id='phone' class='phone' name='phone' placeholder='010-0000-0000' value='<?=$userInfo['userPhone']?>' />
                                    <button type='button' class='modify_Phone_cancel'>취소</button>
                                    <button type='button' class='modify_Phone_complete'>변경</button>
                                </form>
                            </div>

                            <div class='personal_phone'>
                                <form>
                                    <label for='phone' class='ir'>전화번호</label>
                                    <input type='text' id='phone_val' class='phone' name='phone_val' placeholder='010-0000-0000' value='<?=$userInfo['userPhone']?>' disabled/>
                                    <button type='button' class='modify_Phone'>수정</button>
                                </form>
                            </div>
                            <div class='personal_email'><?=$userInfo['userEmail']?></div>
                            <div class='personal_upload'><?=$boardcount?></div>
                        </div>
                    </div>
                </div>

                <div class='mypage__text container'>
                    <div class='text__intro'>
                        <div class='intro__part1'>
                            <div class='intro__change'>
                                <h3>짧은 소개</h3>
                                <button type='button' class='modify_intro_cancle'>취소</button>
                                <button type='button' class='modify_intro_complete'>완료</button>
                            </div>
                            <div class='intro__inner'>
                                <h3>짧은 소개</h3>
                                <button type='button' class='modify_intro'>수정</button>
                            </div>
                            <label for='intro_title' class='ir'>짧은 소개</label>
                            <textarea name='intro' id='intro' cols='30' rows='1' placeholder='총 글자 수 30자 입니다.' style='resize: none' disabled><?=$userInfo['userShortInfo']?></textarea>
                        </div>

                        <div class='intro__part2'>
                            <div class='introD__change'>
                                <h3>자세한 소개</h3>
                                <button type='button' class='modify_introD_cancel'>취소</button>
                                <button type='button' class='modify_introD_complete'>완료</button>
                            </div>
                            <div class='introD__inner'>
                                <h3>자세한 소개</h3>
                                <button type='button' class='modify_introD'>수정</button>
                            </div>
                            <label for='introD_title' class='ir'>자세한 소개</label>
                            <textarea name='introD' id='introD' cols='30' rows='1' placeholder='안녕하세요. 이 곳은 자세한 소개 칸 입니다. 총 200자 까지 적을 수 있으며, 짧은 소개에서 자신을 소개 한 것보다 더욱 더 자세한 소개를 적을 수 있습니다.' style='resize: none' disabled><?=$userInfo['userLongInfo']?></textarea>
                        </div>
                        <div class='intro__part3'>
                            <div class='active__change'>
                                <h3>활동 분야</h3>
                                <button type='button' class='active_intro_cancel'>취소</button>
                                <button type='button' class='active_intro_complete'>완료</button>
                            </div>
                            <div class='active__inner'>
                                <h3>활동 분야</h3>
                                <button type='button' class='active_intro'>수정</button>
                            </div>
                            <label for='active_title' class='ir'>활동 분야</label>
                            <textarea name='active' id='active' cols='30' rows='1' placeholder='배경 화면' style='resize: none' disabled><?=$userInfo['userOneInfo']?></textarea>
                        </div>
                        <div class="intro__part4">
                            <button type="button" class="modify_pass">비밀번호 변경</button>
                            <button type="button" class="join_leave">회원 탈퇴</button>
                        </div>
                    </div>
                </div>
            </section>
            

            <section class='mypage__card container'>
                <h1 class='card__title'>UPLOAD POSTS</h1>
                <div class='mypage__inner'>
                <?php 
                        foreach($boardResult as $board) {    
                ?>
                    <article class='mypage__cardBox'>
                        <div class='cardBox__image'>
                            <figure>
                                <a href='../imgeview/imgview.php?categgoryBoardID=<?=$board['categgoryBoardID']?>'><img src='../assets/categoryimg/<?=$board['categgoryPhoto']?>' alt='이미지' /></a>
                            </figure>
                        </div>
                    </article>
                <?php } ?>
                </div>
            </section>
        </main>
        <!-- //main -->
        <?php include "../include/footer.php" ?>
        
        <div id="modal" class="gmark">
            <div class="modal__bg"></div>
            <div class="modal__wrap">
                <div class="modal__inner">
                    <div class="modal__header">
                        <img src="/assets/image/modal_icon.svg" alt="경고" />
                        <h3>회원 탈퇴</h3>
                    </div>
                    <label for="youPass" class="blind">회원 탈퇴</label>
                    <input type="password" id="youPass" name="youPass" maxlength="20" placeholder="비밀번호를 입력해주세요." autocomplete="off" />
                    <div class="button">
                        <button type="button" class="btn_cancel">취소</button>
                        <button type="button" class="btn_check">확인</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
                $(".active__change").css('display', 'none');
                $(".active_intro").click(function (e) {
                    e.preventDefault();
                    $(".active__inner").css('display', 'none');
                    $(".active__change").css('display', 'flex');
                    $("#active").attr("disabled", false);
                })
                $(".active_intro_cancel").click(function (e) {
                    e.preventDefault();
                    $(".active__change").css('display', 'none');
                    $(".active__inner").css('display', 'flex');
                    $("#active").attr("disabled", true);
                })
            
                $(".active_intro_complete").click(function (e) {
                    
                    e.preventDefault();
                    $.ajax({
                        url: "mypageModify.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "type": "userOneInfo",
                            "userOneInfo": $("#active").val()
                        },
                        success: function(data) {
                            $("#active").text(data.userOneInfo); 
                            $(".active__change").css('display', 'none');
                            $(".active__inner").css('display', 'flex');
                            $("#active").attr("disabled", true);
                        },
                        error: function(request, status, error){
                            console.log("request" + request);
                            console.log("status" + status);
                            console.log("error" + error);
                        }
                    })
                })

            
                $(".info_change").css('display', 'none');
                $(".modify_nickName").click(function (e) {
                    e.preventDefault();
                    $(".info").css('display', 'none');
                    $(".info_change").css('display', 'block');
                })
                $(".modify_nickname_cancel").click(function (e) {
                    e.preventDefault();
                    $(".info_change").css('display', 'none');
                    $(".info").css('display', 'block');
                })

                const nickName = $("#nickname").val()
                $(".modify_nickname_complete").click(function (e) {
                    e.preventDefault();
                    if($("#nickname").val().length < 2 || $("#nickname").val().length > 10){
                    alert("2자리 ~ 10자리 이내로 입력해주세요!");
                    } else if($("#nickname").val() == null || $("#nickname").val() == ''){
                        alert("공백없이 입력해주세요!");
                    } else {
                        $.ajax({
                            url: "mypageModify.php",
                            method: "POST",
                            dataType: "json",
                            data: {
                                "type": "nicknameChange",
                                "nickname": $("#nickname").val()
                            },
                            success: function(data) {
                                $(".nickname").text(data.nickname);
                                $(".info_change").css('display', 'none');
                                $(".info").css('display', 'block');
                                // console.log(data);
                                // location.reload();
                            },
                            error: function(request, status, error){
                                console.log("request" + request);
                                console.log("status" + status);
                                console.log("error" + error);
                            }
                        })
                    }
                })

                $(".modify_profile_input").click(function (e) {
                    $(this).css('display', 'none');
                    $(".modify_profile_cancel").css('display', 'inline-block');
                    $(".modify_profile").css('display', 'inline-block');
                    $("#intro").attr("disabled", false);
                })

                $(".modify_profile_cancel").click(function (e) {
                    $(this).css('display', 'none');
                    $(".modify_profile_input").css('display', 'inline-block');
                    $(".modify_profile").css('display', 'none');
                    $("#intro").attr("disabled", true);
                })

                $(".modify_profile").click(function (e) {
                    e.preventDefault();
                    let userFile = $("#userFile")[0];

                    if(userFile.files.length === 0){
                        alert("파일은 선택해주세요");
                        $(".modify_profile").css('display', 'none');
                        $(".modify_profile_cancel").css('display', 'none');
                        $(".modify_profile_input").css('display', 'inline-block');
                    } else {
                        let formData = new FormData();
                        formData.append('userFile', userFile.files[0]);
                        // console.log("userFile: ", userFile.files[0])
                    
                        $.ajax({
                            url: "mypageModifyimage.php",
                            contentType: 'multipart/form-data', 
                            type: 'POST',
                            dataType: 'json', 
                            mimeType: 'multipart/form-data',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                console.log(data);
                                $(".info__profile_img").attr("src", '../assets/userimg/'+data.image);
                                $(".modify_profile").css('display', 'none');
                                $(".modify_profile_cancel").css('display', 'none');
                                $(".modify_profile_input").css('display', 'inline-block');
                                // console.log(data);
                                // location.reload();
                            },
                            error: function(request, status, error){
                                console.log("request" + request);
                                console.log("status" + status);
                                console.log("error" + error);
                            }
                        })
                    }

                })

                $(".personal_gender_change").css('display', 'none');
                $(".modify_gender").click(function (e) {
                    e.preventDefault();
                    $(this).parent().parent().css('display', 'none');
                    $(".personal_gender_change").css('display', 'block');
                })
                $(".modify_gender_cancel").click(function (e) {
                    e.preventDefault();
                    $(this).parent().parent().css('display', 'none');
                    $(".personal_gender").css('display', 'block');
                })

                const gender = $("#gender").val()
                $(".modify_gender_complete").click(function (e) {
                    e.preventDefault();
                    if($("#gender").val() == null || $("#gender").val() == ''){
                        alert("공백없이 입력해주세요!");
                    }   else if($("#gender").val() == 'male' || $("#gender").val() == 'female'){
                            $.ajax({
                                url: "mypageModify.php",
                                method: "POST",
                                dataType: "json",
                                data: {
                                    "type": "gender",
                                    "gender": $("#gender").val()
                                },
                                success: function(data) {
                                    $("#gender_val").val(data.gender);
                                    $(".personal_gender_change").css('display', 'none');
                                    $(".personal_gender").css('display', 'block');
                                    // console.log(data);
                                    // location.reload();
                                },
                                error: function(request, status, error){
                                    console.log("request" + request);
                                    console.log("status" + status);
                                    console.log("error" + error);
                                }
                            })
                        }   else {
                            alert("male 또는 female 로만 입력해주세요!");
                            }
                })

                $(".personal_phone_change").css('display', 'none');
                $(".modify_Phone").click(function (e) {
                    e.preventDefault();
                    $(".personal_phone").css('display', 'none');
                    $(".personal_phone_change").css('display', 'block');
                })
                $(".modify_Phone_cancel").click(function (e) {
                    e.preventDefault();
                    $(".personal_phone_change").css('display', 'none');
                    $(".personal_phone").css('display', 'block');
                })
                $(".modify_Phone_complete").click(function (e) {
                    e.preventDefault();
                    let regExp = /^(010|011|016|017|018|019)-[0-9]{3,4}-[0-9]{4}$/;
        
                    if(!regExp.test($("#phone").val()) ){
                        alert("번호가 정확하지 않습니다. 올바른 핸드폰 번호(000-0000-0000)를 적어주세요");
                    } else if($("#phone").val() == null || $("#checkNumber").val() == ''){
                        alert("공백없이 입력해주세요!");
                    } else {
                        $.ajax({
                            url: "mypageModify.php",
                            method: "POST",
                            dataType: "json",
                            data: {
                                "type": "phonenumber",
                                "phonenumber": $("#phone").val()
                            },
                            success: function(data) {
                                $("#phone_val").val(data.phonenumber);
                                $(".personal_phone_change").css('display', 'none');
                                $(".personal_phone").css('display', 'block');
                            },
                            error: function(request, status, error){
                                console.log("request" + request);
                                console.log("status" + status);
                                console.log("error" + error);
                            }
                        })
                    }
                })

                $(".intro__change").css('display', 'none');
                $(".modify_intro").click(function (e) {
                    e.preventDefault();
                    $(".intro__inner").css('display', 'none');
                    $(".intro__change").css('display', 'flex');
                    $("#intro").attr("disabled", false);
                })
                $(".modify_intro_cancle").click(function (e) {
                    e.preventDefault();
                    $(".intro__change").css('display', 'none');
                    $(".intro__inner").css('display', 'flex');
                    $("#intro").attr("disabled", true);
                })
            
                $(".modify_intro_complete").click(function (e) {
                    e.preventDefault();
                    if($("#intro").val().length > 50){
                    alert("50자리 이내로 입력해주세요!");
                    }  else {
                        $.ajax({
                            url: "mypageModify.php",
                            method: "POST",
                            dataType: "json",
                            data: {
                                "type": "userShortInfo",
                                "userShortInfo": $("#intro").val()
                            },
                            success: function(data) {
                                $("#intro").text(data.userShortInfo);
                                $(".intro__change").css('display', 'none');
                                $(".intro__inner").css('display', 'flex');

                            },
                            error: function(request, status, error){
                                console.log("request" + request);
                                console.log("status" + status);
                                console.log("error" + error);
                            }
                        })
                    }
                })

                $(".introD__change").css('display', 'none');
                $(".modify_introD").click(function (e) {
                    e.preventDefault();
                    $(".introD__inner").css('display', 'none');
                    $(".introD__change").css('display', 'flex');
                    $("#introD").attr("disabled", false);
                })
                $(".modify_introD_cancel").click(function (e) {
                    e.preventDefault();
                    $(".introD__change").css('display', 'none');
                    $(".introD__inner").css('display', 'flex');
                    $("#introD").attr("disabled", true);
                })
            
                $(".modify_introD_complete").click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: "mypageModify.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "type": "userLongInfo",
                            "userLongInfo": $("#introD").val()
                        },
                        success: function(data) {
                            
                            $("#introD").text(data.userLongInfo); 
                            $(".introD__change").css('display', 'none');
                            $(".introD__inner").css('display', 'flex');
                            $("#introD").attr("disabled", true);
                        },
                        error: function(request, status, error){
                            console.log("request" + request);
                            console.log("status" + status);
                            console.log("error" + error);
                        }
                    })
                })

                $('.modify_pass').click(function (e) {
                    location.href = 'changePw.php';
                })

                $('.join_leave').click(function (e) {
                    $('#modal').css('display', 'block');
                
                })
                $('.btn_cancel').click(function (e) {
                    $('#modal').css('display', 'none');
                })
                
                $('.btn_check').click(function (e) {
                    $.ajax({
                        url: "mypageModify.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "type": "joinLeave",
                            "youPass": $("#youPass").val()
                        },
                        success: function(data) {
                            if(data.result == 'good'){
                                alert('탈퇴되었습니다. 이용해주셔서 감사합니다.');
                                // console.log(data.result)
                                location.href = "../main/main.php";
                            }else {
                                alert('비밀번호가 틀려요! 다시 적어주세요!');
                                console.log(data.result)
                            }
                        },
                        error: function(request, status, error){
                            console.log("request" + request);
                            console.log("status" + status);
                            console.log("error" + error);
                        }
                    })
                })

                let loading = false;
                let pagecount = 2;
                function next_load(){
                    $.ajax({
                            url:"mypageModify.php",
                            method: "POST",
                            dataType: "json",
                            data : {
                                "type": "categoryscroll",
                                "page": pagecount,
                            },
                            
                            success: function(data)
                            {
                                if(data.result == 'good'){
                                    pagecount++;
                                    $('.mypage__inner').append(data.page)                            
                                    loading = false;    //실행 가능 상태로 변경
                                }
                                else
                                {
                                    console.log('failed');
                                }
                            },error: function(request, status, error){
                                console.log("request" + request);
                                console.log("status" + status);
                                console.log("error" + error);
                            }
                        });
                }

                $(window).scroll(function(){
                    if($(window).scrollTop()+200>=$(document).height() - $(window).height())
                    {
                        if(!loading)    //실행 가능 상태라면?
                        {
                            loading = true; //실행 불가능 상태로 변경
                            next_load(); 
                        }
                        else            //실행 불가능 상태라면?
                        {
                            // console.log('다음페이지를 로딩중입니다.');  
                        }
                    }
                });          
            </script>
        
    </body>
</html>
