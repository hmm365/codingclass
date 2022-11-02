let check = 1;

if (document.querySelector(".btn_group .btn_modify")) {
	document.querySelector(".btn_group .btn_modify").addEventListener("click", () => {
		document.querySelector("#modal.modify").classList.add("show");
		check = 1;
	});

	document.querySelector(".modify .btn_cancel").addEventListener("click", () => {
		document.querySelector("#modal.modify").classList.remove("show");
		check = 0;
	});
}

if (document.querySelector(".btn_group .btn_delete")) {
	document.querySelector(".btn_group .btn_delete").addEventListener("click", () => {
		document.querySelector("#modal.delete").classList.add("show");
		check = 2;
	});

	document.querySelector(".delete .btn_cancel").addEventListener("click", () => {
		document.querySelector("#modal.delete").classList.remove("show");
		check = 0;
	});
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
		data: { userPass: youPass, type: "passCheck" },
		dataType: "json",
		success: function (data) {
			if (data.result == "good") {
				if (check == 1) {
					post_to_url(" cateModify.php", { categgoryBoardID: "${categgoryBoardID}" });
					return true;
				} else if (check == 2) {
					post_to_url("cateDelete.php", { categgoryBoardID: "${categgoryBoardID}" });
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
		url: "feedBackCheck.php",
		data: { userPass: youPass, type: "passCheck" },
		dataType: "json",
		success: function (data) {
			if (data.result == "good") {
				if (check == 1) {
					post_to_url("cateModify.php", { categgoryBoardID: $categgoryBoardID });
					return true;
				} else if (check == 2) {
					post_to_url("cateDelete.php", { categgoryBoardID: $categgoryBoardID });
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
				post_to_url("categoryCommentDelete.php", { categgoryBoardID: "${categgoryBoardID}", categgoryCommentId: momId });
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
                                         <img src='../assets/userimg/".$userInfo['userPhoto']."' alt='프로필 사진' />
                                     </div>
                                     <div class='userComment login'>
                                        <input type='hidden' name='categgoryBoardID' id='categgoryBoardID' value='".$categgoryBoardID."'/>
                                        <input type='hidden' name='categgoryCommentId' id='categgoryCommentId' value='` +
			momId +
			`'/>
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
						data: { categgoryBoardID: "${categgoryBoardID}", categgoryCommentId: cLikeId, userMember: "$userMemberID", type: "like" },
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
						data: { categgoryBoardID: "${categgoryBoardID}", categgoryCommentId: cLikeId, userMember: "$userMemberID", type: "unLike" },
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
