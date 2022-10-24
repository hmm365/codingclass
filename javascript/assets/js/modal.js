const tabBtn = document.querySelectorAll(".modal__box .tabs > div"); //탭 버튼
const tabCont = document.querySelectorAll(".modal__box .cont > div"); //탭 내용
const modalCont = document.querySelector(".modal__cont"); //탭 콘텐츠
// const modalDot = document.querySelector(".modal__box .tab__title .dot"); // 텝 도트
const mdalClose = document.querySelector(".modal__close");
const modalBtn = document.querySelector(".modal__btn"); // 모달 버튼

//모달
modalBtn.addEventListener("click", event => {
    event.preventDefault();
    modalCont.classList.add("show");
    modalCont.classList.remove("hide");
})
//모달 닫기
mdalClose.addEventListener("click", event => {
    event.preventDefault();
    modalCont.classList.add("hide")
})

//탭
tabBtn.forEach((btn, i) => {
    //버튼을 클릭
    btn.addEventListener("click", (event) => {
        //이벤트 처리안함
        event.preventDefault();
        //클래스 active를 모두 제거함
        tabBtn.forEach(el => {
            el.classList.remove("active");
        })
        //내가 클릭한 버튼에 active를 추가함
        btn.classList.add("active");
        //버튼을 클릭하면 모든 자식 박스 숨김
        tabCont.forEach((div) => {
            div.style.display = "none";
            div.classList.remove("active");
        });
        //[i]클릭한 버튼과 [i]박스를 보이게 함
        tabCont[i].style.display = "block"
        tabCont[i].classList.add("active");
    })
});