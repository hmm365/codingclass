let check = 0;
document.querySelector(".btn_modify").addEventListener("click", () => {
    document.querySelector(".modify").classList.add("show");
    check = 1;
});

document.querySelector(".btn_delete").addEventListener("click", () => {
    document.querySelector(".delete").classList.add("show");
    check = 2;
});

document.querySelector(".modify .btn_cancel").addEventListener("click", () => {
    document.querySelector(".modify").classList.remove("show");
    check = 0;
});

document.querySelector(".delete .btn_cancel").addEventListener("click", () => {
    document.querySelector(".delete").classList.remove("show");
    check = 0;
});

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
if (check == 1) {
    let btn_check = ".modify .btn_check";
} else if (check == 2) {
    let btn_check = ".delete .btn_check";
}
document.querySelector(btn_check).addEventListener("click", () => {
    $.ajax({
        type: "POST",
        url: "feedBackCheck.php",
        data: { userPass: userPass, type: "userPass" },
        dataType: "json",
        success: function (data) {
            if (data.result == "good") {
                if (check == 1) {
                    post_to_url("feedBackBoardModify.php", { feedBackBoardId: $feedBackBoardID });
                    return true;
                } else if (check == 2) {
                    post_to_url("feedBackBoardDelete.php", { feedBackBoardId: $feedBackBoardID });
                    return true;
                }
            } else if (data.result == "bad") {
                $("#youPass").attr("placeholder", "비밀번호가 일치하지 않습니다.");
                $("#youPass").val("");
                return false;
            }
        },
        error: function (request, status, error) {
            console.log("request" + request);
            console.log("status" + status);
            console.log("error" + error);
        },
    });
});

document.querySelectorAll(".header__nav li").forEach((e) => {
    e.getAttribute("class");
});

<div class="comment">
    <div class="userComment__inner">
        <div class="userIcon">
            <img src="../assets/img/usericon.svg" alt="프로필 사진" />
        </div>
        <div class="userComment login">
            <label for="comment" class="blind">
                커뮤니티를 성장시키는 의견을 공유해주세요.
            </label>
            <textarea name="comment" id="comment" rows="2" placeholder="커뮤니티를 성장시키는 의견을 공유해주세요."></textarea>
        </div>
    </div>
    <div class="commentBtn">
        <button type="button">취소</button>
        <button type="submit">쓰기</button>
    </div>
</div>;

let mom = "";

document.querySelectorAll(".userComments__modify button").forEach((e, i) => {
    e.addEventListener("click", () => {
        mom = e.parentNode.parentNode.parentNode;
    });
});
console.log(mom);

if (document.querySelector(".userComments__modify button")) {
    document.querySelectorAll(".userComments__modify button").forEach((e, i) => {
        e.addEventListener("click", () => {
            mom = e.parentNode.parentNode.parentNode;
            desc = mom.querySelector(".userComments__desc p").innerText;
            monBackup = mom.innerHTML;
            // console.log(desc);
            mom.innerHTML =
                `<div class='comment'>
                                <div class='userComment__inner'>
                                    <div class='userIcon'>
                                        <img src='../assets/img/usericon.svg' alt='프로필 사진' />
                                    </div>
                                    <div class='userComment login'>
                                       <input type='hidden' name='feedBackBoardID' id='feedBackBoardID' value=''.$feedBackBoardID.''/>
                                       <label for='comment' class='blind'>커뮤니티를 성장시키는 의견을 공유해주세요.</label>
                                       <textarea name='comment' id='comment' rows='2' placeholder='커뮤니티를 성장시키는 의견을 공유해주세요'>` +
                desc +
                `</textarea>
                                    </div>
                                </div>
                                <div class='commentBtn'>
                                    <button class='back' type='button'>취소</button>
                                    <button class='sub' type='submit'>쓰기</button>
                                </div>
                            </div>`;
        });
    });
}

document.querySelectorAll(".userComments__modify button.back").forEach((e, i) => {
    e.addEventListener("click", () => {
        mom.innerHTML = monBackup;
    });
});

document.querySelector(".commentBtn button.back").addEventListener("click", () => {
    mom.innerHTML = monBackup;
});





$likeSql = "SELECT * FROM clike WHERE commentId  = '".$info2['commentId']."' AND feedBackBoardID = '$feedBackBoardID' AND clike = 1";
$likeResult = $connect -> query($likeResult);
$likeCount = $likeResult -> num_rows;

$likeSql2 = "SELECT * FROM clike WHERE commentId = '".$info2['commentId']."' AND feedBackBoardID = '$feedBackBoardID' AND userMemberId = '$userMemberId'";
$likeResult2 = $connect -> query($likeResult2);
$likeCount2 = $likeResult2 -> num_rows;

console.log("hi")
if($likeCount2 == 1){
    <div class="userComments__like">
        <img src="../assets/img/likeIcon.svg" alt="" />
        <span>".$likeCount."</span>
    </div>;
}else {
    <div class="userComments__like">
        <img src="../assets/img/unLikeIcon.svg" alt="" />
        <span>".$likeCount."</span>
    </div>;
}




document.querySelector(".userComments__like like").addEventListener("click", () => {
   
});
document.querySelector(".userComments__like unlike").addEventListener("click", () => {
    $likeUpdateSql2 = "INSERT INTO clike(feedBackBoardID, userMemberID) VALUES('$feedBackBoardId', '$userMemberID');";
    $likeResultSql2 = $connect -> query($likeUpdateSql2);
});


$likeUpdateSql2 = "INSERT INTO clike(feedBackBoardID, userMemberID, commentId) VALUES('$feedBackBoardID', '$userMemberId', '".$info2['commentId']."')";
$likeResultSql2 = $connect -> query($likeUpdateSql2);

$likeUpdateSql = "DELETE FROM clike WHERE feedBackBoardID = '${feedBackBoardID} AND userMemberId = '${userMemberId}' ";;
$likeResultSql = $connect -> query($likeUpdateSql);






document.querySelectorAll('.userComments__like unlike img').forEach((e,i) =>{
e.addEventListener("click",() => {

})
})
let cLikeId = e.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute('id')
