
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>

    <!-- CSS -->
<link rel="stylesheet" href="../assets/css/style.css">

<!-- META -->
<meta name="author" content="webstoryboy">
<meta name="description" content="PHP 사이트 만들기입니다.">
<meta name="keyword" content="사이트, 만들기, 튜토리얼, 웹스토리보이">
<meta name="robots" content="all">

<!-- ICON -->
<link rel="icon" href="../assets/img/icon_256.png" />
<link rel="shortcut icon" href="../assets/img/icon_256.png" />
<link rel="icon" type="image/png" sizes="256x256" href="../assets/img/icon_256.png" />
<link rel="icon" type="image/png" sizes="192x192" href="../assets/img/icon_192.png" />
<link rel="icon" type="image/png" sizes="32x32" href="../assets/img/icon_32.png" />
<link rel="icon" type="image/png" sizes="16x16" href="../assets/img/icon_16.png" />











</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->
    
    <header id="header">
    <div class="header__inner container">
        <div class="left">
            <a href="../index.php" class="star"><span class="ir">메인으로</span></a>
        </div>
        <h1>
            <a href="../main/main.php">PHP BLOG</a>
        </h1>
        <div class="right">
                            <ul>
                    <li><a href="../login/login.php">로그인</a></li>
                    <li><a href="../join/join.php">회원가입</a></li>
                </ul>
                    </div>
        <nav class="nav">
            <ul>
                <li><a href="../join/join.php"><span>회원가입</span></a></li>
                <li><a href="../login/login.php"><span>로그인</span></a></li>
                <li><a href="../board/board.php"><span>게시판</span></a></li>
                <li><a href="../blog/blog.php"><span>블로그</span></a></li>
            </ul>
        </nav>
    </div>
</header>    <!-- //header -->

    <main id="main">
        <section id="banner">
            <h2 class="blind">블로그 소개입니다.</h2>
            <div class="banner__inner container">
                <div class="img">
                    <img src="../assets/img/banner_bg01.jpg" alt="">
                </div>
                <div class="desc">
                    어떤 일이라도 <em>노력</em>하고 즐기면 그 결과는 <em>빛</em>을 바란다고 생각합니다.
                    신입의 <em>열정</em>과 <em>도전정신</em>을 깊숙히 새기며 배움에 있어 <em>겸손함</em>을
                    유지하며 세부적인 곳까지 파고드는 <em>개발자</em>가 되겠습니다.
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <footer id="footer">
    <h2 class="blind">푸터 영역입니다.</h2>
    <div class="footer__inner container">
        <address>Copyright @2022 webstoryboy</address>
        <div><a href="index.html">blog by webstoryboy</a></div>
    </div>
</footer>    <!-- //footer -->
    
</body>
</html>