<?php
include "../connect/connect.php";

$userMemberNum = $_GET['userMemberID'];

$userSql = "SELECT * FROM userMember WHERE userMemberID = '$userMemberNum'";
$userResult = $connect -> query($userSql);
$userInfoo = $userResult -> fetch_array(MYSQLI_ASSOC);


$page = 1;
$viewNum = 8;

$viewLimit = ($viewNum * $page) - $viewNum;
$boardSql = "SELECT * FROM categoryBoard as b JOIN userMember as m ON b.userMemberID = m.userMemberID  WHERE m.userMemberID = '$userMemberNum' ORDER BY b.categgoryBoardID DESC ";
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
        <title>유저페이지</title>

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
                        <h2 class='banner_title'>USER PAGE</h2>
                        <p class='banner_udline'></p>
                    </div>
                </div>

                <div class='mypage__info container'>
                    <div class='info__profile'>
                        <div>
                            <img class='info__profile_img' src='../assets/userimg/<?=$userInfoo['userPhoto']?>' alt='프로필 이미지' />
                        </div>
                        <div class='info'>
                            <p class='nickname'><?=$userInfoo['userNickName']?></p>
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
                            <div class='personal_gender'>
                                <form>
                                    <label for='gender' class='ir'>성별</label>
                                    <input type='text' id='gender_val' class='gender' name='gender_val' placeholder='male or female' value='<?=$userInfoo['userGender']?>' disabled/>
                                </form>
                            </div>
                            <div class='personal_phone'>
                                <form>
                                    <label for='phone' class='ir'>전화번호</label>
                                    <input type='text' id='phone_val' class='phone' name='phone_val' placeholder='010-0000-0000' value='<?=$userInfoo['userPhone']?>' disabled/>
                                </form>
                            </div>
                            <div class='personal_email'><?=$userInfoo['userEmail']?></div>
                            <div class='personal_upload'><?=$boardcount?></div>
                        </div>
                    </div>
                </div>

                <div class='mypage__text container'>
                    <div class='text__intro'>
                        <div class='intro__part1'>
                            <div class='intro__inner'>
                                <h3>짧은 소개</h3>
                            </div>
                            <label for='intro_title' class='ir'>짧은 소개</label>
                            <textarea name='intro' id='intro' cols='30' rows='1' placeholder='총 글자 수 30자 입니다.' style='resize: none' disabled><?=$userInfoo['userShortInfo']?></textarea>
                        </div>

                        <div class='intro__part2'>
                            <div class='introD__inner'>
                                <h3>자세한 소개</h3>
                            </div>
                            <label for='introD_title' class='ir'>자세한 소개</label>
                            <textarea name='introD' id='introD' cols='30' rows='1' placeholder='안녕하세요. 이 곳은 자세한 소개 칸 입니다. 총 200자 까지 적을 수 있으며, 짧은 소개에서 자신을 소개 한 것보다 더욱 더 자세한 소개를 적을 수 있습니다.' style='resize: none' disabled><?=$userInfoo['userLongInfo']?></textarea>
                        </div>
                        <div class='intro__part3'>
                            <div class='active__inner'>
                                <h3>활동 분야</h3>
                            </div>
                            <label for='active_title' class='ir'>활동 분야</label>
                            <textarea name='active' id='active' cols='30' rows='1' placeholder='배경 화면' style='resize: none' disabled><?=$userInfoo['userOneInfo']?></textarea>
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
                let loading = false;
                let pagecount = 2;
                let memberId = <?=$userMemberNum?>;
                console.log(memberId)
                function next_load(){
                    $.ajax({
                            method: "POST",
                            url:"userpageModify.php",
                            data : {
                                "type": "categoryscroll",
                                'page': pagecount,
                                'memberId': memberId,
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if(data.result == 'good'){
                                    pagecount++;
                                    $('.mypage__inner').append(data.page)                            
                                    loading = false;    //실행 가능 상태로 변경
                                }
                                else
                                {
                                    console.log('bad');
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
