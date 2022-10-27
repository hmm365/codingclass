<?php 
    include "../connect/session.php";
    include "../connect/connect.php";
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>게시글 쓰기 페이지</title>

        <!-- CSS Link -->
        <link rel="stylesheet" href="../assets/css/common.css" />
        <link rel="stylesheet" href="../assets/css/reset.css" />
        <link rel="stylesheet" href="../assets/css/fonts.css" />
        <link rel="stylesheet" href="../assets/css/board.css" />
        <link rel="stylesheet" href="../assets/css/boardView.css" />
        <link rel="stylesheet" href="../assets/css/modal.css" />
    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- header -->

        <main id="main">
            <div class="main_wrap">
                <section class="board_wrap">
                    <div class="board_inner container">
                        <div class="board_box">
                            <div class="board_title">
                                <h2>NOTICE</h2>
                                <p class="line1"></p>
                            </div>
                            <p class="board_desc">IT.D에서 제공하는 게시글 입니다.</p>

                            <div class="board__view">
                                <div class="board__view__title">
                                <?php
                                    $noticeBoardID = $_GET["noticeBoardID"];
                                    //조회수 +1
                                    $sql = "UPDATE noticeBoard SET boardView = boardView + 1 WHERE noticeBoardID = {$noticeBoardID}";
                                   
                                    $result = $connect->query($sql);

                                    //게시글 찾기
                                    $sql = "SELECT b.boardTitle, m.userNickName, b.regTime, b.boardView, b.boardContents FROM noticeBoard b JOIN userMember m ON(m.userMemberID = b.userMemberID) WHERE noticeBoardID = {$noticeBoardID}";
                                    // echo $sql;
                                    $result = $connect->query($sql);

                                    if ($result) {
                                        $info = $result->fetch_array(MYSQLI_ASSOC);
                                    }
                                
                                    // echo "<pre>";
                                    // var_dump($info);
                                    // echo "</pre>";
                                
                                    echo "<h3>{$info["boardTitle"]}<h3>";
                                    echo "<h3><div class='board__view__flex'>
                                                <p>Nickname | <span>{$info["userNickName"]}</span></p>
                                                <p>Date | <span>".date("Y-m-d", $info["regTime"])."</span></p>
                                                <p class='views'><em>Views</em> | <span>{$info["boardView"]}</span></p>
                                             </div>";
                                ?>
                                    <!-- <h3>IT.D 필수 공지사항</h3>
                                    <div class="board__view__flex">
                                        <p>Nickname | <span>쿼카</span></p>
                                        <p>Date | <span>2022. 10. 06</span></p>
                                        <p class="views"><em>Views</em> | <span>22</span></p>
                                    </div> -->
                                </div>
                                <?php 
                                    echo "<div class='board__view__desc'>
                                           {$info["boardContents"]}
                                        </div>";
                                    
                                        if( isset($_SESSION['userMemberID']) ){ 
                                            $userMemberId = $_SESSION['userMemberID'];
                                            $admin = "SELECT adminAccount FROM adminAccount WHERE userMemberID = $userMemberId";
                                            $resultAdmin = $connect -> query($admin);
                                            $adminAccount = mysqli_fetch_array($resultAdmin);
                                           }
                                        if($adminAccount['adminAccount'] == 1){
                                         // echo $admin;
                                         //  echo "<script>alert('".$adminAccount['adminAccount']."')</script>";
                                         echo "<div class='btn_group'>
                                                <button class='btn_modify'>수정하기</button>
                                                <button class='btn_delete'>삭제</button>
                                            </div>";
                                        }
                                        
                                  
                                ?>
                                <!-- <div class="board__view__desc">
                                    안녕하세요. IT.D 입니다.<br />
                                    여기는 글 보기 페이지이며 공지사항과 피드백 둘 다 동일하게 적용이 됩니다.<br /><br />
                                    제목은 Bold체, 내용과 닉네임, 날짜는 미디움으로 설정하였습니다.<br />
                                    lineheight 140%<br /><br />
                                    행복한 하루 되시길 바랍니다.<br />
                                    감사합니다.
                                </div> -->
                                
          
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="modal" class="gmark modify">
                                <div class="modal__bg"></div>
                                <div class="modal__wrap">
                                    <div class="modal__inner">
                                        <div class="modal__header">
                                            <img src="/assets/image/modal_icon.svg" alt="경고" />
                                            <h3>게시글 수정</h3>
                                        </div>
                                        <label for="userPass" class="blind">게시글 수정</label>
                                        <input type="password" id="userPass" name="userPass" maxlength="20" placeholder="비밀번호를 입력해주세요." autocomplete="off" />
                                        <div class="button">
                                            <button type="button" class="btn_cancel">취소</button>
                                            <button type="button" class="btn_check" onclick="passChecking()">확인</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="modal" class="gmark delete">
                                <div class="modal__bg"></div>
                                <div class="modal__wrap">
                                    <div class="modal__inner">
                                        <div class="modal__header">
                                            <img src="/assets/image/modal_icon.svg" alt="경고" />
                                            <h3>게시글 삭제</h3>
                                        </div>
                                        <label for="youPass" class="blind">게시글 삭제</label>
                                        <input type="password" id="youPass" name="youPass" maxlength="20" placeholder="비밀번호를 입력해주세요." autocomplete="off" />
                                        <div class="button">
                                            <button type="button" class="btn_cancel">취소</button>
                                            <button type="button" class="btn_check" onclick="passChecking2()">확인</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </main>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
                            <?php 
                                $noticeBoardID = $_GET["noticeBoardID"];
                                echo "<script>
                                     let check = 1;
                                     document.querySelector('.btn_modify').addEventListener('click', () => {
                                         document.querySelector('.modify').classList.add('show');
                                         check = 1;
                                     });

                                     document.querySelector('.btn_delete').addEventListener('click', () => {
                                         document.querySelector('.delete').classList.add('show');
                                         check = 2;
                                     });

                                     document.querySelector('.modify .btn_cancel').addEventListener('click', () => {
                                         document.querySelector('.modify').classList.remove('show');
                                         check = 0;
                                     });

                                     document.querySelector('.delete .btn_cancel').addEventListener('click', () => {
                                         document.querySelector('.delete').classList.remove('show');
                                         check = 0;
                                     });

                                     function post_to_url(path, params, method) {
                                         method = method || 'post';
                                         const form = document.createElement('form');
                                         form.setAttribute('method', method);
                                         form.setAttribute('action', path);
                                         for (let key in params) {
                                             let hiddenField = document.createElement('input');
                                             hiddenField.setAttribute('type', 'hidden');
                                             hiddenField.setAttribute('name', key);
                                             hiddenField.setAttribute('value', params[key]);
                                             form.appendChild(hiddenField);
                                         }
                                         document.body.appendChild(form);
                                         form.submit();
                                     }
                                    
                                    function passChecking() {
                                        let youPass = $('.modify #userPass').val();
                                        $.ajax({
                                             type: 'POST',
                                             url: 'feedBackCheck.php',
                                             data: { 'userPass': youPass, 'type': 'passCheck' },
                                             dataType: 'json',
                                             success: function (data) {
                                                 if (data.result == 'good') {
                                                     if (check == 1) {
                                                         post_to_url('noticeBoardModify.php', { 'noticeBoardId': '${noticeBoardID}' });
                                                         return true;
                                                     } else if (check == 2) {
                                                        post_to_url('noticeBoardDelete.php', { 'noticeBoardId': '${noticeBoardID}' });
                                                         return true;
                                                     }
                                                 } else if (data.result == 'bad') {
                                                    $('.modify #userPass').attr('placeholder', '비밀번호가 가 일치하지 않습니다.');
                                                     $('.modify #userPass').val('');
                                                     return false;
                                                 }
                                             },
                                             error: function (request, status, error) {
                                                 console.log('request' + request);
                                                 console.log('status' + status);
                                                 console.log('error' + error);
                                             },
                                         });
                                     };

                                     function passChecking2() {
                                        let youPass = $('.delete #youPass').val();
                                        // alert(youPass);
                                        $.ajax({
                                             type: 'POST',
                                             url: 'feedBackCheck.php',
                                             data: { 'userPass': youPass, 'type': 'passCheck' },
                                             dataType: 'json',
                                             success: function (data) {
                                                 if (data.result == 'good') {
                                                     if (check == 1) {
                                                         post_to_url('noticeBoardModify.php', { noticeBoardId: $noticeBoardID });
                                                         return true;
                                                     } else if (check == 2) {
                                                        post_to_url('noticeBoardDelete.php', { noticeBoardId: $noticeBoardID });
                                                         return true;
                                                     }
                                                 } else if (data.result == 'bad') {
                                                    $('.delete #youPass').attr('placeholder', '비밀번호가 가 일치하지 않습니다.');
                                                     $('.delete #youPass').val('');
                                                     return false;
                                                 }
                                             },
                                             error: function (request, status, error) {
                                                 console.log('request' + request);
                                                 console.log('status' + status);
                                                 console.log('error' + error);
                                             },
                                         });
                                     };
                                
                                
                                </script>"
                            ?>
         <!-- main -->
         <?php include "../include/footer.php" ?>
        <!-- footer -->
    </body>
</html>
