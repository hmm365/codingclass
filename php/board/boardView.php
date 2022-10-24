<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 보기</title>
    <?php include "../include/link.php"; ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php"; ?>
    <!-- //header -->

    <main id="main">
        <section id="board" class="container">
            <h2>게시판 보기 영역입니다.</h2>
            <div class="board__inner">
                <div class="board__title">
                    <h3>게시판</h3>
                    <p>웹디자이너, 웹퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.</p>
                </div>
                <div class="board__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%">
                            <col style="width: 80%">
                        </colgroup>
                        <tbody>
                        <?php
                            $myBoardID = $_GET["myBoardID"];
                            // echo $myBoardID;
                            //조회수 +1
                            $sql = "UPDATE myBoard SET boardView = boardView + 1 WHERE myBoardID = {$myBoardID}";
                            $result = $connect->query($sql);
                            
                            //게시글 찾기
                            $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM myBoard b JOIN myMember m ON(m.myMemberID = b.myMemberID) WHERE myBoardID = {$myBoardID}";
                            $result = $connect->query($sql);
    
                            if ($result) {
                                $info = $result->fetch_array(MYSQLI_ASSOC);
                            }
                        
                            // echo "<pre>";
                            // var_dump($info);
                            // echo "</pre>";
                        
                            echo "<tr><th>제목</th><td>{$info["boardTitle"]}</td></tr>";
                            echo "<tr><th>등록자</th><td>{$info["youName"]}</td></tr>";
                            echo "<tr><th>등록일</th><td>" . date("Y-m-d", $info["regTime"]) . "</td></tr>";
                            echo "<tr><th>조회수</th><td>{$info["boardView"]}</td></tr>";
                            echo "<tr><th>내용</th><td class='height'>{$info["boardContents"]}</td></tr>";
                        ?>
                            <!-- <tr>
                                <th>제목</th>
                                <td>게기판 제목입니다.</td>
                            </tr>
                            <tr>
                                <th>등록자</th>
                                <td>황상연</td>
                            </tr>
                            <tr>
                                <th>등록일</th>
                                <td>2022.03.04</td>
                            </tr>
                            <tr>
                                <th>조회수</th>
                                <td>999</td>
                            </tr>
                            <tr>
                                <th>내용</th>
                                <td class="height">
                                    품위 없는 모든 버릇을 버려라.<br>
                                    욕을 하고 투덜거릴는 것, 경박한 자세로 앉아 있는 것, 남을 비웃는 것, 지저분한 차림, 약속에 늦거나 변경하는 일 등의 모든 행동은 품위 없는
                                    것이다.<br>
                                    도움을 구하는 데 망설이지 마라.<br>
                                    묻고 요청하고 찾아가고 부탁하라. 반드시 물에 답을 주고 도움을 주고 반기는 사람이 있다.<br>
                                    희생을 할 각오를 해라.<br>
                                    작은 목표에는 작은 희생이 따르고 큰 목표에는 큰 희생이 따른다. 공부를 위해서는 잠을 포기해야 하고 돈을 모으기 위해서 더 많은 시간을 일해야
                                    한다.<br>
                                    기록하고 정리하라.<br>
                                    투자내역, 정보, 갑자기 생각나 아이디어, 명함, 사이트 암호들, 구매 기록 등을 모두 정리하거나 기억하라, 이것은 재산이여 동시에 당신을
                                    보호한다.<br>
                                    제발 모두에게 사랑받을 생각을 버려라.<br>
                                    눈치를 보지 말고 비난에 의연하고 무리와 어울리는 것에 목숨을 걸지 마라. 진정한 친구는 두명도 많고 가족의 지지기 모든 것의 기초다. 부정적인 사람과
                                    결별하고 당신보다 나은 사람들과 어울려라.
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <div class="board__btn">
                    <?php echo "<a href='boardModify.php?myBoardID=${myBoardID}'>수정하기</a>"; ?>
                    <a href='boardRemove.php?myBoardID=<?= $myBoardID ?>' onclick="alert('정말 삭제하겠습니까?')">삭제하기</a>
                    <a href="board.php">목록보기</a>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"; ?>
    <!-- //footer -->
</body>
</html>