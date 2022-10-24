<?php 
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
?> 

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>

    <?php include "../include/link.php" ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main">
        <section id="banner">
            <h2>블로그 소개입니다.</h2>
            <div class="banner__inner container">
                <div class="img">
                    <img src="../assets/img/banner_bg01.jpg" alt="배너 이미지">
                </div>
                <div class="desc">
                    어떤 일이라도 <em>노력</em>하고 즐기면 그 결과는 <em>빛</em>을 바란다고 생각합니다.
                    신입의 <em>열정</em>과 <em>도전정신</em>을 깊숙히 새기며 <em>배움</em>에 있어 겸손함을
                    유지하며 세부적인 곳까지 파고드는 멋진 <em>개발자</em>가 되겠습니다.
                </div>
            </div>
        </section>
        <section id="card" class="container">
            <h2>javascript topic</h2>
            <div class="card__inner">
                <div>
                    <figure>
                        <img src="../assets/img/card_bg01.jpg" alt="vscode에 scss설치하기">
                        <a href="#" class="go" title="컨텐츠 바로가기">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.646447 8.64645C0.451184 8.84171 0.451184 9.15829 0.646447 9.35355C0.841709 9.54882 1.15829 9.54882 1.35355 9.35355L0.646447 8.64645ZM9.5 1C9.5 0.723858 9.27614 0.5 9 0.5L4.5 0.5C4.22386 0.5 4 0.723858 4 1C4 1.27614 4.22386 1.5 4.5 1.5L8.5 1.5L8.5 5.5C8.5 5.77614 8.72386 6 9 6C9.27614 6 9.5 5.77614 9.5 5.5L9.5 1ZM1.35355 9.35355L9.35355 1.35355L8.64645 0.646447L0.646447 8.64645L1.35355 9.35355Z" fill="white"/>
                            </svg>
                        </a>
                    </figure>
                    <div>
                        <h3>vscode에 scss설치하기</h3>
                        <p>먼저 확장 프로그램에서 scss를 설치합니다. sass와 scss는 같지만 쓰는 방법이 살짝 틀립니다.</p>
                    </div>
                </div>
                <div>
                    <figure>
                        <img src="../assets/img/card_bg02.jpg" alt="vscode에 scss설치하기">
                        <a href="#" class="go" title="컨텐츠 바로가기">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.646447 8.64645C0.451184 8.84171 0.451184 9.15829 0.646447 9.35355C0.841709 9.54882 1.15829 9.54882 1.35355 9.35355L0.646447 8.64645ZM9.5 1C9.5 0.723858 9.27614 0.5 9 0.5L4.5 0.5C4.22386 0.5 4 0.723858 4 1C4 1.27614 4.22386 1.5 4.5 1.5L8.5 1.5L8.5 5.5C8.5 5.77614 8.72386 6 9 6C9.27614 6 9.5 5.77614 9.5 5.5L9.5 1ZM1.35355 9.35355L9.35355 1.35355L8.64645 0.646447L0.646447 8.64645L1.35355 9.35355Z" fill="white"/>
                            </svg>
                        </a>
                    </figure>
                    <div>
                        <h3>vscode에 scss설치하기</h3>
                        <p>먼저 확장 프로그램에서 scss를 설치합니다. sass와 scss는 같지만 쓰는 방법이 살짝 틀립니다.</p>
                    </div>
                </div>
                <div>
                    <figure>
                        <img src="../assets/img/card_bg03.jpg" alt="vscode에 scss설치하기">
                        <a href="#" class="go" title="컨텐츠 바로가기">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.646447 8.64645C0.451184 8.84171 0.451184 9.15829 0.646447 9.35355C0.841709 9.54882 1.15829 9.54882 1.35355 9.35355L0.646447 8.64645ZM9.5 1C9.5 0.723858 9.27614 0.5 9 0.5L4.5 0.5C4.22386 0.5 4 0.723858 4 1C4 1.27614 4.22386 1.5 4.5 1.5L8.5 1.5L8.5 5.5C8.5 5.77614 8.72386 6 9 6C9.27614 6 9.5 5.77614 9.5 5.5L9.5 1ZM1.35355 9.35355L9.35355 1.35355L8.64645 0.646447L0.646447 8.64645L1.35355 9.35355Z" fill="white"/>
                            </svg>
                        </a>
                    </figure>
                    <div>
                        <h3>vscode에 scss설치하기</h3>
                        <p>먼저 확장 프로그램에서 scss를 설치합니다. sass와 scss는 같지만 쓰는 방법이 살짝 틀립니다.</p>
                    </div>
                </div>
                <div>
                    <figure>
                        <img src="../assets/img/card_bg04.jpg" alt="vscode에 scss설치하기">
                        <a href="#" class="go" title="컨텐츠 바로가기">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.646447 8.64645C0.451184 8.84171 0.451184 9.15829 0.646447 9.35355C0.841709 9.54882 1.15829 9.54882 1.35355 9.35355L0.646447 8.64645ZM9.5 1C9.5 0.723858 9.27614 0.5 9 0.5L4.5 0.5C4.22386 0.5 4 0.723858 4 1C4 1.27614 4.22386 1.5 4.5 1.5L8.5 1.5L8.5 5.5C8.5 5.77614 8.72386 6 9 6C9.27614 6 9.5 5.77614 9.5 5.5L9.5 1ZM1.35355 9.35355L9.35355 1.35355L8.64645 0.646447L0.646447 8.64645L1.35355 9.35355Z" fill="white"/>
                            </svg>
                        </a>
                    </figure>
                    <div>
                        <h3>vscode에 scss설치하기</h3>
                        <p>먼저 확장 프로그램에서 scss를 설치합니다. sass와 scss는 같지만 쓰는 방법이 살짝 틀립니다.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- //card -->
        <!-- //banner -->
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <?php include "../login/login.php" ?>
    <!-- //login -->

    <!-- script -->
    <script src="../assets/js/custom.js"></script>
</body>
</html>