<header id="header">
    <div class="header__inner container">
        <div class="left">
            <a href="../index.php" class="star"><span class="ir">메인으로</span></a>
        </div>
        <h1>
            <a href="../main/main.php">PHP BLOG</a>
        </h1>
        <div class="right">
            <?php if(isset($_SESSION['memberID'])){ ?>
                <ul>
                    <li><a href="../mypage/mypage.php" class="black"><?=$_SESSION['youName']?>님 환영합니다.</a></li>
                    <li><a href="../login/logout.php">로그아웃</a></li>
                </ul>
            <?php } else { ?>
                <ul>
                    <li><a href="../login/login.php">로그인</a></li>
                    <li><a href="../join/join.php">회원가입</a></li>
                </ul>
            <?php } ?>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="../join/join.php"><span>회원가입</span></a></li>
                <?php if(isset($_SESSION['memberID'])){ ?>
                    <li style="display:none"><a href="../login/login.php"><span>로그인</span></a></li>
                <?php } else { ?>
                    <li><a href="../login/login.php"><span>로그인</span></a></li>
                <?php } ?>
                <li><a href="../board/board.php"><span>게시판</span></a></li>
                <li><a href="../blog/blog.php"><span>블로그</span></a></li>
            </ul>
        </nav>
    </div>
</header>