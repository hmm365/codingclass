function joinChecks() {
    // 개인정보 동의 체크
    let joinCheck = document.querySelector("#agreeCheck4").checked;
    if (joinCheck == false) {
        alert("개인정보수집 및 동의를 체크해주세요");
        return false;
    } else {
        location.href = "userJoin.php";
    }
}

document.querySelector(".agree__inner .btn").addEventListener("click", () => {
    joinChecks();
});

document.querySelector("#agreeCheck4").addEventListener("click", () => {
    if (document.querySelector("#agreeCheck4").checked) {
        document.querySelector("#agreeCheck1").checked = true;
        document.querySelector("#agreeCheck2").checked = true;
    } else {
        document.querySelector("#agreeCheck1").checked = false;
        document.querySelector("#agreeCheck2").checked = false;
    }
});
document.querySelector("#agreeCheck1").addEventListener("click", () => {
    if (document.querySelector("#agreeCheck1").checked && document.querySelector("#agreeCheck2").checked) {
        document.querySelector("#agreeCheck4").checked = true;
    } else {
        document.querySelector("#agreeCheck4").checked = false;
    }
});

document.querySelector("#agreeCheck2").addEventListener("click", () => {
    if (document.querySelector("#agreeCheck1").checked && document.querySelector("#agreeCheck2").checked) {
        document.querySelector("#agreeCheck4").checked = true;
    } else {
        document.querySelector("#agreeCheck4").checked = false;
    }
});
