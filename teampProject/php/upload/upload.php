<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    if( !isset($_SESSION['userMemberID']) ){ 
        echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
        }
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>📨 Upload</title>

        <!-- CSS Link -->
        <link rel="stylesheet" href="../assets/css/common.css" />
        <link rel="stylesheet" href="../assets/css/reset.css" />
        <link rel="stylesheet" href="../assets/css/fonts.css" />
        <link rel="stylesheet" href="../assets/css/upload.css" />

        <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

        <style>
            .tagify__tag + .tagify__input::before {
                opacity: 0;
            }

            .tagify:not(.tagify--noTags) {
                --placeholder-color: transparent;
                --placeholder-color-focus: transparent;
            }
        </style>
    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- header -->
        <main id="main">
            <section id="upload" class="uplaod__wrap">
                    <form action="uploadSave.php" name="upload" method="post" enctype="multipart/form-data">
                        <div class="upload__inner container">
                            <div class="upload__title">
                                <fieldset>
                                    <label for="uploadTitle" class="blind">제목</label>
                                    <input type="text" id="uploadTitle" class="uploadTitle" name="uploadTitle" placeholder="제목을 입력해주세요." />
                                </fieldset>
                            </div>
                            <!-- upload__title 업로드 페이지 제목 입력란 -->
                            <div class="upload__write">
                                <fieldset>
                                    <label for="uploadWrite" class="blind">내용</label>
                                    <textarea name="uploadWrite" id="uploadWrite" class="uploadWrite" rows="20" placeholder="내용을 입력해주세요."></textarea>
                                </fieldset>
                            </div>
                            <!-- upload__title 업로드 페이지 내용 입력란 -->

                            <div class="upload__image">
                                <label for="uploadBasicImage" class="blind">이미지 업로드</label>
                                <input type="file" name="uploadBasicImage" id="uploadBasicImage" class="uploadBasicImage" accept=".jpg, .jpeg, .png, .gif" placeholder="jpg, gif, png 파일만 넣어주세요!" />
                                <span class="upload__image__desc" id="upload__image__desc"></span>
                            </div>

                            <div class="upload__tag">
                                <!-- <span>태그</span>
                                <span class="tagComplete">
                                    <a href="#">#태그 완료 시</a>
                                    <a href="#"></a>
                                </span>
                                //태그 완료 시 요소 -->
                                <input id="input" name="input" placeholder="태그를 입력해주세요!" value="" data-blacklist=".NET,PHP" autofocus />
                                <input id="inputHiden" name="inputHiden" type="hidden">
                                <!-- //태그 입력란 -->
                            </div>
                            <div class="upload__btn">
                                <button type="button" id="uploadBtn" class="uploadBtn"><span>업로드</span></button>
                            </div>
                        </div>    
                    </form>
            </section>
        </main>

        <?php include "../include/footer.php" ?>
        <!-- // footer -->

        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://unpkg.com/@yaireo/tagify"></script>
        <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

        <script>

            let inputElm = document.querySelector("input[name=input]");

            // 화이트 리스트 : 해당 문자만 태그로 추가 가능
            let whitelist = ["배경화면", "사진", "첫 글", "이미지", "하늘", "바다", "빈티지"];

            // initialize Tagify
            var tagify = new Tagify(inputElm, {
                // enforceWhitelist: true, // 화이트리스트에서 허용된 태그만 사용
                // whitelist: whitelist, // 화이트 리스트 배열. 화이트 리스트를 등록하면 자동으로 드롭다운 메뉴가 생긴다
            });

            // 만일 모든 태그 지우기 기능 버튼을 구현한다면
            // document.querySelector("버튼").addEventListener("click", tagify.removeAllTags.bind(tagify));

            // tagify 전용 이벤트 리스터. 참조 : https://github.com/yairEO/tagify#events
            tagify
                .on("add", onAddTag) // 태그가 추가되면
                .on("remove", onRemoveTag) // 태그가 제거되면
                .on("input", onInput) // 태그가 입력되고 있을 경우
                .on("invalid", onInvalidTag) // 허용되지 않는 태그일 경우
                .on("click", onTagClick) // 해시 태그 블럭을 클릭할 경우
                .on("focus", onTagifyFocusBlur) // 포커스 될 경우
                .on("blur", onTagifyFocusBlur) // 반대로 포커스를 잃을 경우

                .on("edit:start", onTagEdit) // 입력된 태그 수정을 할 경우

                .on("dropdown:hide dropdown:show", (e) => console.log(e.type)) // 드롭다운 메뉴가 사라질경우
                .on("dropdown:select", onDropdownSelect); // 드롭다운 메뉴에서 아이템을 선택할 경우

            // tagify 전용 이벤트 리스너 제거 할떄
            tagify.off("add", onAddTag);

            // 이벤트 리스너 콜백 메소드
            function onAddTag(e) {
                // console.log("onAddTag: ", e.detail);
                // console.log("original input value: ", inputElm.value);
            }

            // tag remvoed callback
            function onRemoveTag(e) {
                // console.log("onRemoveTag:", e.detail, "tagify instance value:", tagify.value);
            }

            function onTagEdit(e) {
                // console.log("onTagEdit: ", e.detail);
            }

            // invalid tag added callback
            function onInvalidTag(e) {
                // console.log("onInvalidTag: ", e.detail);
            }

            // invalid tag added callback
            function onTagClick(e) {
                // console.log(e.detail);
                // console.log("onTagClick: ", e.detail);
            }

            function onTagifyFocusBlur(e) {
                // console.log(e.type, "event fired");
            }

            function onDropdownSelect(e) {
                // console.log("onDropdownSelect: ", e.detail);
            }

            function onInput(e) {
                // console.log("onInput: ", e.detail);

                tagify.loading(true); // 태그 입력하는데 우측에 loader 애니메이션 추가
                tagify.loading(false); // loader 애니메이션 제거

                tagify.dropdown.show(e.detail.value); // 드롭다운 메뉴 보여주기
                tagify.dropdown.hide(); // // 드롭다운 제거
            }
        </script>
        <script>


                uploadBtn = document.querySelector("#uploadBtn");
                uploadBtn.addEventListener("click", () => {
                    uploadChecks()
                });
                
                function readImage(input) {
                    // 인풋 태그에 파일이 있는 경우
                    if(input.files && input.files[0]) {
                        const previewImage = document.getElementById("upload__image__desc");
                        previewImage.innerText = input.files[0].name;
                    }
                }

                // input file에 change 이벤트 부여
                const inputImage = document.getElementById("uploadBasicImage")
                inputImage.addEventListener("change", e => {
                    readImage(e.target)
                })

                function uploadChecks() {
                    // e.preventDefault();
                    let uploadFile = document.querySelector("#uploadBasicImage");
                    let uploadTitle = document.querySelector("#uploadTitle");
                    let uploadWrite = document.querySelector("#uploadWrite");
                    let uploadTags = document.querySelectorAll(".tagify > tag");
                    let uploadTagInput = document.querySelector("#inputHiden");
                    let uploadTagBox = [];
                    
                    if (uploadWrite.value == null || uploadWrite.value == "") {
                        uploadWrite.value = " ";
                    }
                    uploadTags.forEach((e,i) => {
                        uploadTagBox[i] = e.getAttribute('title')+'@^@&@!';
                    });
                    
                    uploadTagInput.value = uploadTagBox.join('');
                    console.log(uploadTagInput.value)

                    if(uploadFile.files.length === 0){
                            alert("이미지 파일을 올려 주세요");
                            return false;
                    } else {
                        if (uploadTitle.value == null || uploadTitle.value == '' || uploadTitle.value.length > 50){
                            alert("글 제목은 공백은 없어야하며 50글자 이내로 써주세요");
                            return false;
                        } else {
                            document.upload.submit();
                        }
                    }
            }
            
        </script>


    </body>
</html>
