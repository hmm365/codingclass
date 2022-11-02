<?php
    include "../connect/session.php";
    include "../connect/connect.php";
    $categgoryBoardID = $_GET["categgoryBoardID"];
    $userMemberID = $_SESSION['userMemberID'];

    $idSql = "SELECT * FROM userMember WHERE userMemberID = '$userMemberID'";
    $idResult = $connect -> query($idSql);
    $userInfo = $idResult -> fetch_array(MYSQLI_ASSOC);


    $plusSql = "UPDATE categoryBoard SET categgoryView = categgoryView + 1 WHERE categgoryBoardID = {$categgoryBoardID}";                    
    $plusResult = $connect->query($plusSql);


    $viewSql = "SELECT b.categgoryTitle, b.regTime , b.categgoryView, m.userNickName, b.categgoryPhoto, b.categgoryContents FROM categoryBoard as b JOIN userMember as m ON b.userMemberID = m.userMemberID WHERE categgoryBoardID = '$categgoryBoardID'";
    $viewResult = $connect->query($viewSql);

    $tagsSql = "SELECT * FROM categoryTag WHERE categgoryBoardID = '$categgoryBoardID'";
    $tagsResult = $connect->query($tagsSql);

    if ($viewResult) {
        $viewinfo = $viewResult->fetch_array(MYSQLI_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>이미지 뷰 페이지</title>

        <link rel="stylesheet" href="../assets/css/common.css" />
        <link rel="stylesheet" href="../assets/css/reset.css" />
        <link rel="stylesheet" href="../assets/css/fonts.css" />
        <link rel="stylesheet" href="../assets/css/imagview.css" />
        <link rel="stylesheet" href="../assets/css/modal.css" />
    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- main -->
        <main id="main">
			<section class="view__wrap container">
				<div class="view__inner">
					<div class="view__header">
						<h3 class="view__title"><?=$viewinfo['categgoryTitle']?></h3>
						<p class="view__info">
                            <?=$viewinfo['userNickName']?>
							<span> | </span>
							<span class="view__date"><?=date("Y-m-d", $viewinfo['regTime'])?></span>
							<span> | </span>
							<span class="view_count"><img src="../../assets/image/view_ico.svg" alt="조회수" /> <?=$viewinfo['categgoryView']?></span>
						</p>
                        <div class="view__btn">
                        <?php 
                            if(isset($_SESSION['userMemberID']) ){
                                $admin = "SELECT adminAccount FROM adminAccount WHERE userMemberID = $userMemberID";
                                $resultAdmin = $connect -> query($admin);
                                $adminAccount = mysqli_fetch_array($resultAdmin);
                                $boardSql = "SELECT * FROM categoryBoard WHERE categgoryBoardID = '$categgoryBoardID' AND userMemberID = '$userMemberID'";
                                $resultAd = $connect -> query($boardSql);
                                $boardCount = $resultAd -> num_rows;
                                
                                if($adminAccount['adminAccount'] == 1 && ($boardCount == 0 || $boardCount == null)){
                                    echo " <button type='button' class='view_delete'>삭제</button>";
                                } else if(isset($_SESSION['userMemberID']) && !$adminAccount['adminAccount'] == 1 ){ 
                                    if($boardCount > 0){
                                        echo " <button type='button' class='view_modify'>수정</button>
                                        <button type='button' class='view_delete'>삭제</button>";
                                    }
                                } else if(isset($_SESSION['userMemberID']) && $adminAccount['adminAccount'] == 1 ){ 
                                    if($boardCount > 0){
                                        echo " <button type='button' class='view_modify'>수정</button>
                                        <button type='button' class='view_delete'>삭제</button>";
                                    }
                                }
                            }
                        ?>
						</div>
					</div>
					<div class="view__contents">
						<div class="view__contetns__imgs">
							<img src="../assets/categoryimg/<?=$viewinfo['categgoryPhoto']?>" class="view__contents__img" alt="이미지1" />
							<a href="../assets/categoryimg/<?=$viewinfo['categgoryPhoto']?>" class="view__contents__download ir" download="">다운로드</a>
							<!-- <img src="../../assets/image/download_ico.svg" class="view__contents__download" alt="다운로드"> -->
						</div>
						<p class="view__contents__desc"><?=$viewinfo['categgoryContents']?></p>
					</div>
					<div class="view__tag">
						<span class="view__tag__list">
                        <?php   
                            $cou = $tagsResult -> num_rows;
                            if($cou > 0){
                                foreach ($tagsResult as $tag) {
                        ?>
							<a href='../search/search.php?searchKeyword=<?=$tag['categgoryTag']?>&searchSelect=3'><?=$tag['categgoryTag']?></a>
                        <?php 
                            }
                        } else echo "<a href='#'>태그가 없어요 ㅜㅜ</a>"
                        ?>
						</span>
					</div>
				</div>


                <?php 

                    
                    $userSql = "SELECT userMemberID FROM categoryComment WHERE categgoryBoardID = '$categgoryBoardID' AND  userMemberID = '$userMemberID' ";
                    $userResult = $connect->query($userSql);
                    $commentCount = $userResult -> num_rows;
                    if ($result) {
                        $info = $result->fetch_array(MYSQLI_ASSOC);
                    }
                    
                    $sql2 = "SELECT b.categgoryCommentId, a.userNickName, a.userMemberID, b.categgoryBoardID, b.userMemberID, b.categgoryComment as comment, b.regTime, a.userPhoto FROM userMember a JOIN categoryComment b ON (a.userMemberID = b.userMemberID) WHERE categgoryBoardID = '$categgoryBoardID' ORDER BY categgoryCommentId DESC";
                    $result2 = $connect->query($sql2);
                    $commentCount2 = $result2 -> num_rows;      
                ?>
                <div class="board__comments">
                    <?php echo "<h3>$commentCount2 Comment<h3>"?>
                    <div class="comment">
                        <form action="categoryCommentSave.php" name="comment" method="post">
                            <fieldset>
                                <legend class="ir">댓글 작성 영역</legend>
                                <div class="userComment__inner">
                                        <?php
                                        if(isset($_SESSION['userMemberID']) ){ 
                                            echo "<div class='userIcon'>
                                                <img src='../assets/userimg/".$userInfo['userPhoto']."' alt='프로필 사진' />
                                            </div>
                                            <div class='userComment login'>
                                                    <input type='hidden' name='categgoryBoardID' id='categgoryBoardID' value='".$categgoryBoardID."'/>
                                                    <label for='comment' class='blind'>커뮤니티를 성장시키는 의견을 공유해주세요.</label>
                                                    <textarea name='comment' id='comment' rows='2' placeholder='커뮤니티를 성장시키는 의견을 공유해주세요'></textarea>
                                                </div>
                                                </div>
                                                <div class='commentBtn'>
                                                    <button type='submit'>쓰기</button>
                                                </div>
                                                ";
                                        }else {
                                            echo "<div class='userIcon'>
                                                <img src='../assets/userimg/Img_default.jpg' alt='프로필 사진' />
                                            </div>
                                            <div class='userComment'>
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
                                $likeSql = "SELECT * FROM catelike WHERE categgoryCommentId  = '".$info2['categgoryCommentId']."' AND categgoryBoardID = '$categgoryBoardID' AND clike = 1";
                                
                                $likeResult = $connect -> query($likeSql);
                                $likeCount = $likeResult -> num_rows;

                                $likeSql2 = "SELECT * FROM catelike WHERE categgoryCommentId = '".$info2['categgoryCommentId']."' AND categgoryBoardID = '$categgoryBoardID' AND userMemberID = '$userMemberID'";
                            
                                $likeResult2 = $connect -> query($likeSql2);
                                $likeCount2 = $likeResult2 -> num_rows;

                            

                                echo "<li id='".$info2['categgoryCommentId']."'>";
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
                                    echo "<div class='userComments__like like'>
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
                                
                                $commentSql = "SELECT * FROM categoryComment WHERE categgoryBoardID = '$categgoryBoardID' AND userMemberID = '$userMemberID' ";
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
			</section>


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
            </div>
		</main>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script>
            let check = 1;
            if (document.querySelector(".view__btn .view_modify")) {
                document.querySelector(".view__btn .view_modify").addEventListener("click", () => {
                    document.querySelector("#modal.modify").classList.add("show");
                    check = 1;
                });
            
                document.querySelector(".modify .btn_cancel").addEventListener("click", () => {
                    document.querySelector("#modal.modify").classList.remove("show");
                    check = 0;
                });
            }

            if (document.querySelector(".view__btn .view_delete")) {
                document.querySelector(".view__btn .view_delete").addEventListener("click", () => {
                    document.querySelector("#modal.delete").classList.add("show");
                    check = 2;
                });
            
                document.querySelector(".delete .btn_cancel").addEventListener("click", () => {
                    document.querySelector("#modal.delete").classList.remove("show");
                    check = 0;
                });
            }
            function enterkey() {
                if (window.event.keyCode == 13) {
                    passChecking();
                }
            }

            function post_to_url(path, params, method) {
                method = method || "post";
                const form = document.createElement("form");
                form.setAttribute("method", method);
                form.setAttribute("action", path);
                for (let key in params) {
                    let hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);
                    form.appendChild(hiddenField);
                }
                document.body.appendChild(form);
                form.submit();
            }

            function passChecking() {
                let youPass = $("#modal.modify #userPass").val();
                $.ajax({
                    type: "POST",
                    url: "cateCheck.php",
                    data: { 'userPass': youPass, 'type': "passCheck" },
                    dataType: "json",
                    success: function (data) {
                        if (data.result == "good") {
                            if (check == 1) {
                                post_to_url("../upload/uploadMod.php", { 'categgoryBoardID': '<?=$categgoryBoardID?>' });
                                return true;
                            } else if (check == 2) {
                                post_to_url("cateDelete.php", { 'categgoryBoardID': '<?=$categgoryBoardID?>' });
                                return true;
                            }
                        } else if (data.result == "bad") {
                            $(".modify #userPass").attr("placeholder", "비밀번호가 가 일치하지 않습니다.");
                            $(".modify #userPass").val("");
                            return false;
                        }
                    },
                    error: function (request, status, error) {
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    },
                });
            }

            function passChecking2() {
                let youPass = $("#modal.delete #youPass").val();
            	// alert(youPass);
                $.ajax({
                    type: "POST",
                    url: "cateCheck.php",
                    data: { 'userPass': youPass, 'type': "passCheck" },
                    dataType: "json",
                    success: function (data) {
                        if (data.result == "good") {
                            if (check == 1) {
                                post_to_url("../upload/uploadMod.php", { 'categgoryBoardID': '<?=$categgoryBoardID?>' });
                                return true;
                            } else if (check == 2) {
                                post_to_url("cateDelete.php", { 'categgoryBoardID': '<?=$categgoryBoardID?>' });
                                return true;
                            }
                        } else if (data.result == "bad") {
                            $(".delete #youPass").attr("placeholder", "비밀번호가 가 일치하지 않습니다.");
                            $(".delete #youPass").val("");
                            return false;
                        }
                    },
                    error: function (request, status, error) {
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    },
            });
        }

            let mom = "";
            let desc = "";
            let momId = "";
            let button = "";
            let buttonDel = "";
            if (document.querySelectorAll(".userComments__modify button.modify") || document.querySelectorAll(".userComments__modify button.delete")) {
                button = document.querySelectorAll(".userComments__modify button.modify");
                buttonDel = document.querySelectorAll(".userComments__modify button.delete");
            
                buttonDel.forEach((e, i) => {
                    e.addEventListener("click", () => {
                        let deleteComment = confirm("정말로 삭제 하시겠습니까?");
                        if (deleteComment == true) {
                            mom = e.parentNode.parentNode.parentNode.parentNode;
                            momId = mom.getAttribute("id");
                            post_to_url("categoryCommentDelete.php", { 'categgoryBoardID': '<?=$categgoryBoardID?>', 'categgoryCommentId': momId });
                        }
                    });
                });
            
                button.forEach((e, i) => {
                    e.addEventListener("click", () => {
                        mom = e.parentNode.parentNode.parentNode.parentNode;
                        e.parentNode.parentNode.parentNode.style.display = `none`;
                        desc = mom.querySelector(".userComments__desc p").innerText;
                        momId = mom.getAttribute("id");
                        creat();
                        btn();
                    });
                });
                
                function btn() {
                    document.querySelectorAll(".commentBtn button.back").forEach((e, i) => {
                        e.addEventListener("click", () => {
            				//  console.log(e.parentNode.parentNode.parentNode.firstChild)
                            e.parentNode.parentNode.parentNode.parentNode.parentNode.firstChild.style.display = `block`;
                            e.parentNode.parentNode.parentNode.parentNode.parentNode.lastChild.innerHTML = "";
                        });
                    });
                }
            
                function creat() {
                    mom.lastChild.innerHTML +=
                        `<form action='categoryCommentModify.php' name='comment' method='post'>
                            <fieldset>
                                <legend class='ir'>댓글 작성 영역</legend>
                                <div class='userComment__inner'>
                                    <div class='userIcon'>
                                        <img src='../assets/userimg/<?=$userInfo['userPhoto']?>' alt='프로필 사진' />
                                    </div>
                                    <div class='userComment login'>
                                        <input type='hidden' name='categgoryBoardID' id='categgoryBoardID' value='<?=$categgoryBoardID?>'/>
                                        <input type='hidden' name='categgoryCommentID' id='categgoryCommentID' value='${momId}'/>
                                        <label for='comment' class='blind'>커뮤니티를 성장시키는 의견을 공유해주세요.</label>
                                        <textarea name='comment' id='comment' rows='2' placeholder='커뮤니티를 성장시키는 의견을 공유해주세요'>${desc}</textarea>
                                    </div>
                                    </div>
                                        <div class='commentBtn'>
                                            <button class='back' type='button'>취소</button>
                                            <button class='sub' type='submit'>쓰기</button>
                                            </div>
                                        <fieldset>
                                    </form>`;
                }
            
                let cLikeId = "";
                if (document.querySelectorAll(".userComments__like")) {
                    document.querySelectorAll(".userComments__like").forEach((e, i) => {
                        e.addEventListener("click", () => {
                            cLikeId = e.parentNode.parentNode.parentNode.parentNode.getAttribute("id");
            				// console.log(e.classList.contains('unlike'))
                            if (e.classList.contains("unlike")) {
                                $.ajax({
                                    type: "POST",
                                    url: "categoryCommentLikeSave.php",
                                    data: { 'categgoryBoardID': '<?=$categgoryBoardID?>', 'categgoryCommentId': cLikeId, 'userMember': '<?=$userMemberID?>', 'type': "like" },
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.result == "good") {
                                            e.querySelector("img").src = "../assets/img/likeIcon.svg";
                                            e.classList.remove("unlike");
                                            e.classList.add("like");
                                            e.querySelector("span").innerText = data.likeCount;
                                        } else if (data.result == "bad") {
                                            return false;
                                        }
                                    },
                                    error: function (request, status, error) {
                                        console.log("request" + request);
                                        console.log("status" + status);
                                        console.log("error" + error);
                                    },
                                });
                            } else if (e.classList.contains("like")) {
                                $.ajax({
                                    type: "POST",
                                    url: "categoryCommentLikeSave.php",
                                    data: { 'categgoryBoardID': '<?=$categgoryBoardID?>', 'categgoryCommentId': cLikeId, 'userMember': '<?=$userMemberID?>', 'type': "unLike" },
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.result == "good") {
                                            e.querySelector("img").src = "../assets/img/unLikeIcon.svg";
                                            e.classList.remove("like");
                                            e.classList.add("unlike");
                                            e.querySelector("span").innerText = data.likeCount;
                                        } else if (data.result == "bad") {
                                            return false;
                                        }
                                    },
                                    error: function (request, status, error) {
                                        console.log("request" + request);
                                        console.log("status" + status);
                                        console.log("error" + error);
                                    },
                                });
                            }
                        });
                    });
                }
            }
        </script>
        <!-- //main -->
        <?php include "../include/footer.php" ?>
        <!-- // footer -->

        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- ham -->

    </body>
</html>
