<?php 
    include "../connect/session.php";
    include "../connect/connect.php";
    $userMemberIDD = $_SESSION['userMemberID'];
    $IDSQL = "SELECT * FROM userMember WHERE userMemberID = '$userMemberIDD'";
    $IDRESULT = $connect -> query($IDSQL);
    $userInfo = $IDRESULT -> fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />,,
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
        <img src="../assets/userimg" alt="">
        <main id="main">
            <div class="main_wrap">
                <section class="board_wrap">
                    <div class="board_inner container">
                        <div class="board_box">
                            <div class="board_title">
                                <h2>FEEDBACK</h2>
                                <p class="line1"></p>
                            </div>
                            <p class="board_desc">IT.D에서 제공하는 게시글 입니다.</p>

                            <div class="board__view">
                                <div class="board__view__title">
                                <?php
                                    $feedBackBoardID = $_GET["feedBackBoardID"];
                                    //조회수 +1
                                    $sql = "UPDATE feedBackBoard SET boardView = boardView + 1 WHERE feedBackBoardID = {$feedBackBoardID}";
                                   
                                    $result = $connect->query($sql);

                                    //게시글 찾기
                                    $sql = "SELECT b.boardTitle, m.userNickName, b.regTime, b.boardView, b.boardContents FROM feedBackBoard b JOIN userMember m ON(m.userMemberID = b.userMemberID) WHERE feedBackBoardID = {$feedBackBoardID}";
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

                                            $boardId = $_GET['feedBackBoardID'];
                                            $boardSql = "SELECT * FROM feedBackBoard WHERE feedBackBoardID = '$boardId' AND userMemberID = '$userMemberId' ";
                                            $resultAd = $connect -> query($boardSql);
                                            
                                            $boardCount = $resultAd -> num_rows;
                                            
                                            if($adminAccount['adminAccount'] == 1 && $boardCount == 0){
                                                echo "<div class='btn_group'>
                                                       <button class='btn_delete'>삭제</button>
                                                      
                                                   </div>";
                                               } else if(isset($_SESSION['userMemberID']) && !$adminAccount['adminAccount'] == 1 ){ 
                                                // $boardCount = 1;
                                                if($boardCount > 0){
                                                     echo "<div class='btn_group'>
                                                         <button class='btn_modify'>수정하기</button>
                                                         <button class='btn_delete'>삭제</button>
                                                     </div>";
                                                 }
                                            } else if(isset($_SESSION['userMemberID']) && $adminAccount['adminAccount'] == 1 ){ 
                                                // $boardCount = 1;
                                                if($boardCount > 0){
                                                     echo "<div class='btn_group'>
                                                         <button class='btn_modify'>수정하기</button>
                                                         <button class='btn_delete'>삭제</button>
                                                     </div>";
                                                 }
                                            }
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
                            <?php 
                              $feedBackBoardID = $_GET["feedBackBoardID"];
                              $userMemberId = $_SESSION['userMemberID'];
                              
                              $sql = "SELECT userMemberID FROM feedBackComment WHERE feedBackBoardID = '$feedBackBoardID' AND  userMemberID = '$userMemberId' ";
                              $result = $connect->query($sql);
                              $commentCount = $result -> num_rows;
                              if ($result) {
                                  $info = $result->fetch_array(MYSQLI_ASSOC);
                              }
                              
                              $sql2 = "SELECT b.commentId, a.userNickName, a.userMemberID, b.feedBackBoardID, b.userMemberID, b.comment, b.clike, b.regTime, a.userPhoto FROM userMember a JOIN feedBackComment b ON (a.userMemberID = b.userMemberID) WHERE feedBackBoardID = '$feedBackBoardID' ORDER BY commentId DESC";
                            //   echo "<script>alert('".$sql2."')</script>";
                              $result2 = $connect->query($sql2);
                              $commentCount2 = $result2 -> num_rows;
                              
                            ?>
                            <div class="board__comments">
                                <?php echo "<h3>$commentCount2 Comment<h3>"?>
                                <div class="comment">
                                    <form action="feedBackCommentSave.php" name="comment" method="post">
                                        <fieldset>
                                            <legend class="ir">댓글 작성 영역</legend>
                                            <div class="userComment__inner">
                                                <div class="userIcon">
                                                    <img src="../assets/userimg/Img_default.jpg " alt="프로필 사진" />
                                                </div>
                                                    <?php
                                                    if(isset($_SESSION['userMemberID']) ){ 
                                                       echo "<div class='userComment login'>
                                                                <input type='hidden' name='feedBackBoardID' id='feedBackBoardID' value='".$feedBackBoardID."'/>
                                                                <label for='comment' class='blind'>커뮤니티를 성장시키는 의견을 공유해주세요.</label>
                                                                <textarea name='comment' id='comment' rows='2' placeholder='커뮤니티를 성장시키는 의견을 공유해주세요'></textarea>
                                                             </div>
                                                             </div>
                                                             <div class='commentBtn'>
                                                                 <button type='submit'>쓰기</button>
                                                             </div>
                                                             ";
                                                    }else {
                                                      echo "<div class='userComment'>
                                                                <label for='comment' class='blind'>댓글을 쓸려면 로그인이 필요합니다.</label>
                                                                <textarea name='comment' id='comment' rows='2' disabled='disabled'></textarea>
                                                                <p>댓글을 쓰려면 <a href='../login/userLogin.php'>로그인</a>이 필요합니다.</p>
                                                            </div>
                                                            </div>
                                                            <div class='commentBtn'>
                                                                 <button type='button'>쓰기</button>
                                                            </div>";
                                                    }
                                                    ?>
                                        </fieldset>
                                    </form>
                                </div>
                                
                                <?php  
                                    if($commentCount2 > 0) {
                                        echo "<div class='userComments'>";
                                        echo "<ul>";
                                        for($i=0; $i < $commentCount2; $i++){
                                            $info2 = $result2->fetch_array(MYSQLI_ASSOC);
                                            $likeSql = "SELECT * FROM clike WHERE commentId  = '".$info2['commentId']."' AND feedBackBoardID = '$feedBackBoardID' AND clike = 1";
                                            
                                            $likeResult = $connect -> query($likeSql);
                                            $likeCount = $likeResult -> num_rows;

                                            $likeSql2 = "SELECT * FROM clike WHERE commentId = '".$info2['commentId']."' AND feedBackBoardID = '$feedBackBoardID' AND userMemberId = '$userMemberId'";
                                          
                                            $likeResult2 = $connect -> query($likeSql2);
                                            $likeCount2 = $likeResult2 -> num_rows;

                                           

                                            echo "<li id='".$info2['commentId']."'>";
                                            echo "<div class='userComments'>";
                                            echo "<div class='userComments__item'>
                                                        <div class='userComments__title'>
                                                            <div class='userIcon'>
                                                                <img src='../assets/userimg/".$info2['userPhoto']."' alt='프로필 사진' />
                                                            </div>
                                                            <div class='userComments__name'>
                                                                <a href='../mypage/userpage.php?userMemberID=".$info2["userMemberID"]."'>".$info2["userNickName"]."</a>
                                                                <p>".date("Y-m-d", $info2["regTime"])."</p>
                                                            </div>";
                                            if($likeCount2 == 1){
                                                echo "  <div class='userComments__like like'>
                                                            <img src='../assets/img/likeIcon.svg' alt='아이콘' />
                                                            <span>".$likeCount."</span>
                                                        </div>
                                                      </div>";
                                            }else {
                                                echo "<div class='userComments__like unlike'>
                                                            <img src='../assets/img/unLikeIcon.svg' alt='아이콘' />
                                                            <span>".$likeCount."</span>
                                                        </div>
                                                    </div>";
                                            }
                                            
                 
                                            $commentSql = "SELECT * FROM feedBackComment WHERE feedBackBoardID = '$boardId' AND userMemberID = '$userMemberId' ";
                                            $resultcomment = $connect -> query($commentSql);
        
                                            $countComment = $resultcomment -> num_rows;
                                                
                                            if($_SESSION['userMemberID'] == $info2['userMemberID'] && !$adminAccount['adminAccount'] == 1 ){ 
                                                // $boardCount = 1;
                                                if($countComment > 0){
                                                     echo "<div class='userComments__modify'>
                                                                 <button class='modify' type='button'>수정하기</button>
                                                                 <span>|</span>
                                                                 <button class='delete' type='button'>삭제하기</button>
                                                           </div>";
                                                 }
                                            }  

                                            if($adminAccount['adminAccount'] == 1 && $_SESSION['userMemberID'] != $info2['userMemberID']){
                                                echo "<div class='userComments__modify'>
                                                            <button class='delete' type='button'>삭제하기</a>
                                                      </div>";
                                            } 

                                            if($_SESSION['userMemberID'] == $info2['userMemberID'] && $adminAccount['adminAccount'] == 1 ){ 
                                                // $boardCount = 1;
                                                if($countComment > 0){
                                                    echo "<div class='userComments__modify'>
                                                                <button class='modify' type='button'>수정하기</button>
                                                                <span>|</span>
                                                                <button class='delete' type='button'>삭제하기</button>
                                                          </div>";
                                                 }
                                            }
                                            echo "</div>
                                                    <div class='userComments__desc'>
                                                        <p>".$info2['comment']."</p>
                                                    </div>";
                                                    // <div class='userComments__comment'>
                                                    //     <button class='write noview'>댓글쓰기</button>
                                                    //     <div class='leftLine'></div>
                                                    // </div>";
                                            echo "</div>";
                                            echo "<div class='comment'></div>";
                                            echo "</li>";
                                        }
                                        echo "</ul>";
                                        echo "</div>";
                                    }
                                      
                                ?>
                                
                                    
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
                            <input onkeyup="enterkey()" type="password" id="userPass" name="userPass" maxlength="20" placeholder="비밀번호를 입력해주세요." autocomplete="off" />
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
                            <input onkeyup="enterkey()" type="password" id="youPass" name="youPass" maxlength="20" placeholder="비밀번호를 입력해주세요." autocomplete="off" />
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
                                $feedBackBoardID = $_GET["feedBackBoardID"];
                                echo "<script>
                                     
                                     let check = 1;
                                     
                                     if(document.querySelector('.btn_group .btn_modify')){
                                        
                                        document.querySelector('.btn_group .btn_modify').addEventListener('click', () => {
                                            document.querySelector('#modal.modify').classList.add('show');
                                            check = 1;
                                        });

                                        document.querySelector('.modify .btn_cancel').addEventListener('click', () => {
                                            document.querySelector('#modal.modify').classList.remove('show');
                                            check = 0;
                                        });
                                       
                                    }
                                     
                                    if(document.querySelector('.btn_group .btn_delete')){
                                        
                                        document.querySelector('.btn_group .btn_delete').addEventListener('click', () => {
                                            document.querySelector('#modal.delete').classList.add('show');
                                            check = 2;
                                        });

                                        document.querySelector('.delete .btn_cancel').addEventListener('click', () => {
                                            document.querySelector('#modal.delete').classList.remove('show');
                                            check = 0;
                                        });
                                    }

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
                                    
                                    function enterkey() {
                                        if (window.event.keyCode == 13) {
                                            passChecking()
                                        }
                                    }
                                    function passChecking() {
                                        let youPass = $('#modal.modify #userPass').val();
                                        $.ajax({
                                             type: 'POST',
                                             url: 'feedBackCheck.php',
                                             data: { 'userPass': youPass, 'type': 'passCheck' },
                                             dataType: 'json',
                                             success: function (data) {
                                                 if (data.result == 'good') {
                                                     if (check == 1) {
                                                         post_to_url(' feedBackBoardModify.php', { 'feedBackBoardID': '${feedBackBoardID}' });
                                                         return true;
                                                     } else if (check == 2) {
                                                        post_to_url('feedBackBoardDelete.php', { 'feedBackBoardID': '${feedBackBoardID}' });
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
                                        let youPass = $('#modal.delete #youPass').val();
                                        // alert(youPass);
                                        $.ajax({
                                             type: 'POST',
                                             url: 'feedBackCheck.php',
                                             data: { 'userPass': youPass, 'type': 'passCheck' },
                                             dataType: 'json',
                                             success: function (data) {
                                                 if (data.result == 'good') {
                                                     if (check == 1) {
                                                         post_to_url('feedBackBoardModify.php', { feedBackBoardID: $feedBackBoardID });
                                                         return true;
                                                     } else if (check == 2) {
                                                        post_to_url('feedBackBoardDelete.php', { feedBackBoardID: $feedBackBoardID });
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

                                     let mom = '';
                                     let desc ='';
                                     let momId = '';
                                     let button = '';
                                     let buttonDel = '';
                                    if(document.querySelectorAll('.userComments__modify button.modify') || document.querySelectorAll('.userComments__modify button.delete') ){
                                        button = document.querySelectorAll('.userComments__modify button.modify');
                                        buttonDel = document.querySelectorAll('.userComments__modify button.delete');

                                        buttonDel.forEach((e, i) => {
                                            e.addEventListener('click', () => {
                                                let deleteComment = confirm('정말로 삭제 하시겠습니까?');
                                                if (deleteComment == true) {
                                                    mom = e.parentNode.parentNode.parentNode.parentNode;
                                                    momId = mom.getAttribute('id');
                                                    post_to_url('feedBackCommentDelete.php', { 'feedBackBoardID': '${feedBackBoardID}', 'commentID': momId });
                                                }
                                                
                                           });
                                       });

                                        button.forEach((e, i) => {
                                                 e.addEventListener('click', () => {
                                                    mom = e.parentNode.parentNode.parentNode.parentNode;
                                                    e.parentNode.parentNode.parentNode.style.display = `none`;
                                                    desc = mom.querySelector('.userComments__desc p').innerText
                                                    momId = mom.getAttribute('id');
                                                    creat();
                                                    btn();
                                                    
                                                });
                                            });
                                        function btn() {
                                            document.querySelectorAll('.commentBtn button.back').forEach((e, i) => {
                                                e.addEventListener('click', () => {
                                                    //  console.log(e.parentNode.parentNode.parentNode.firstChild)
                                                    e.parentNode.parentNode.parentNode.parentNode.parentNode.firstChild.style.display = `block`;
                                                    e.parentNode.parentNode.parentNode.parentNode.parentNode.lastChild.innerHTML = ''
                                                });
                                            });
                                           
                                        }

                                            function creat() {
                                                mom.lastChild.innerHTML += `<form action='feedBackCommentModify.php' name='comment' method='post'>
                                                                <fieldset>
                                                                    <legend class='ir'>댓글 작성 영역</legend>
                                                                    <div class='userComment__inner'>
                                                                        <div class='userIcon'>
                                                                            <img src='../assets/userimg/".$userInfo['userPhoto']."' alt='프로필 사진' />
                                                                        </div>
                                                                        <div class='userComment login'>
                                                                           <input type='hidden' name='feedBackBoardID' id='feedBackBoardID' value='".$feedBackBoardID."'/>
                                                                           <input type='hidden' name='commentID' id='commentID' value='`+momId+`'/>
                                                                           <label for='comment' class='blind'>커뮤니티를 성장시키는 의견을 공유해주세요.</label>
                                                                           <textarea name='comment' id='comment' rows='2' placeholder='커뮤니티를 성장시키는 의견을 공유해주세요'>`+desc+`</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class='commentBtn'>
                                                                        <button class='back' type='button'>취소</button>
                                                                        <button class='sub' type='submit'>쓰기</button>
                                                                    </div>
                                                                <fieldset>
                                                            </form>`;
                                            }

                                            let cLikeId = '';
                                            if(document.querySelectorAll('.userComments__like')){
                                                document.querySelectorAll('.userComments__like').forEach((e,i) =>{
                                                    e.addEventListener('click',() => {
                                                        cLikeId = e.parentNode.parentNode.parentNode.parentNode.getAttribute('id');
                                                        // console.log(e.classList.contains('unlike'))
                                                        if(e.classList.contains('unlike')){
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'feedBackCommentLikeSave.php',
                                                                data: { 'feedBackBoardID': '${feedBackBoardID}', 'commentID': cLikeId, 'userMember' : '$userMemberId', 'type' : 'like' },
                                                                dataType: 'json',
                                                                success: function (data) {
                                                                    if (data.result == 'good') {
                                                                        e.querySelector('img').src ='../assets/img/likeIcon.svg';
                                                                        e.classList.remove('unlike');
                                                                        e.classList.add('like');
                                                                        e.querySelector('span').innerText = data.likeCount;
                                                                    } else if (data.result == 'bad') {
                                                                        return false;
                                                                    }
                                                                },
                                                                error: function (request, status, error) {
                                                                    console.log('request' + request);
                                                                    console.log('status' + status);
                                                                    console.log('error' + error);
                                                                },
                                                            });
                                                        }else if(e.classList.contains('like')) {
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'feedBackCommentLikeSave.php',
                                                                data: { 'feedBackBoardID': '${feedBackBoardID}', 'commentID': cLikeId, 'userMember' : '$userMemberId', 'type' : 'unLike' },
                                                                dataType: 'json',
                                                                success: function (data) {
                                                                    if (data.result == 'good') {
                                                                        e.querySelector('img').src ='../assets/img/unLikeIcon.svg';
                                                                        e.classList.remove('like');
                                                                        e.classList.add('unlike');
                                                                        e.querySelector('span').innerText = data.likeCount;
                                                                    } else if (data.result == 'bad') {
                                                                        return false;
                                                                    }
                                                                },
                                                                error: function (request, status, error) {
                                                                    console.log('request' + request);
                                                                    console.log('status' + status);
                                                                    console.log('error' + error);
                                                                },
                                                            }); 
                                                        }
                                                    })
                                                })
                                            }
                                            
                                    }</script>";
                            ?>
        <!-- main -->
        <?php include "../include/footer.php" ?>
        <!-- footer -->
    </body>
</html>
