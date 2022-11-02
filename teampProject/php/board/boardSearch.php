<?php
include "../connect/connect.php";
include "../connect/session.php";
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>IT.D | 무료 이미지 다운로드 사이트</title>

        <!-- CSS 링크 -->
        <link rel="stylesheet" href="../assets/css/common.css" />
        <link rel="stylesheet" href="../assets/css/reset.css" />
        <link rel="stylesheet" href="../assets/css/fonts.css" />
        <link rel="stylesheet" href="../assets/css/board.css" />
    </head>
    <body>
        <?php include "../include/header.php" ?>
        <!-- header -->
     
        <main id="main">
            <div class="main_wrap">
                <section class="board_wrap board_mb">
                    <div class="board_inner container">
                        <div class="board_box">
                            <div class="board_title">
                            <?php 
                                 $searchKeyword = $_GET{'searchKeyword'};
                                 $searchOption = $_GET{'searchOption'};
                                 $searchBoard = $_GET{'searchBoard'};
             
                                 $searchKeyword = $connect -> real_escape_string(trim($searchKeyword));
                                 $searchOption = $connect -> real_escape_string(trim($searchOption));
                                 $searchBoard = $connect -> real_escape_string(trim($searchBoard));
                                 $searchBoardName = strtoupper(substr($searchBoard, 0, -5));
                                 $searchBoardId = $searchBoard;
                                 $searchBoardId .= 'Id';
                            
                                 $sql = "SELECT b.${searchBoardId}, b.boardTitle, m.userNickName, b.regTime, b.boardView FROM ${searchBoard} b JOIN userMember m ON(b.userMemberID = m.userMemberID)";
             
                                 switch($searchOption) {
                                     case 'title' :
                                         $sql .= "WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY ${searchBoardId} DESC ";
                                         break;
                                     case 'contents' :
                                         $sql .= "WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY ${searchBoardId} DESC ";
                                         break;
                                     case 'name' :
                                         $sql .= "WHERE m.userNickName LIKE '%{$searchKeyword}%' ORDER BY ${searchBoardId} DESC ";
                                         break;  
                                 }
                                 $result = $connect -> query($sql);
                                //  echo "<script>alert('".$sql."')</script>";
                                 if($result){
                                     $boardCount = $result -> num_rows;
                                    //  msg($boardCount);
                                 } else {
                                     echo "안보임";
                                 }
                                echo "<h2>".$searchBoardName."</h2>";
                               ?>
                            </div>

                            <p>총 <?= $boardCount ?> 개의 게시글이 있습니다.</p>
                            <div class="board_search"> 
                                 <form action='boardSearch.php' name='boardSearch' method='get'>
                                            <fieldset>
                                                <select name='searchOption' id='searchOption'>
                                                    <option value='title'>제목</option>
                                                    <option value='contents'>내용</option>
                                                    <option value='name'>등록자</option>
                                                </select>
                                                <legend class='ir'>게시판 검색 영역</legend>
                                                <input type='search' name='searchKeyword' id='searchKeyword' placeholder='검색어를 입력해주세요.' aria-label='search' required />
                                                <input type='hidden' name='searchBoard' id='searchBoard' value='<?= $searchBoard ?>'/>
                                                <button type='submit' class='searchBtn'>검색</button>
                                                <button type='submit' class='searchBtn_Res'><img src='../assets/image/search_Icon.svg' alt='검색' /></button>
                                                <!-- <a href='boardWrite.php' class='btn'>글쓰기</a> -->
                                            </fieldset>
                                   </form>
                            </div>
                            <div class="board_table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Title</th>
                                            <th class="Nickname">Nickname</th>
                                            <th class="Date">Date</th>
                                            <th class="Views">Views</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            // viewNum * 1 - viewNum
                                                    if(isset($_GET['page'])){
                                                        $page = (int)$_GET['page'];
                                                    } else {
                                                        $page = 1;
                                                    }
                                                    $viewNum = 10;
                                                    $viewLimit = ($viewNum * $page) - $viewNum;
                                                    // echo $_GET['page'];
                                                
                                                    $sql .= "LIMIT {$viewLimit}, {$viewNum};";

                                                    $result = $connect -> query($sql);
                                                    if($result) {
                                                        $count = $result -> num_rows;
                                                        if($count > 0) {
                                                            for($i=0; $i < $count; $i++){
                                                                $info = $result -> fetch_array(MYSQLI_ASSOC);
                                                                echo "<tr>";
                                                                    echo "<td class='ce'>".$info[$searchBoardId]."</td>";
                                                                    echo "<td class='lf'><a href='noticeBoardView.php?noticeBoardID={$info[$searchBoardId]}'>".$info['boardTitle']."
                                                                    <p class='resinfo'>".$info['userNickName']. "|<span>".date('Y-m-d', $info['regTime'])." </span><em>| 조회수 : ".$info['boardView']."</em></p>
                                                                    </td>";
                                                                    echo "<td class='ce Nickname'>".$info['userNickName']."</td>";
                                                                    echo "<td class='ce Date'>".date('Y-m-d', $info['regTime'])."</td>";
                                                                    echo "<td class='ce Views'>".$info['boardView']."</td>";
                                                                echo "</tr>";
                                                            }
                                                        } else echo "<tr><td>게시글이 없습니다.</td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td> </td>
                                                        </tr>";
                                                    }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- //board_table -->
                            <?php
                                   if( isset($_SESSION['userMemberID']) ){ 
                                    $userMemberId = $_SESSION['userMemberID'];
                                    $admin = "SELECT adminAccount FROM adminAccount WHERE userMemberID = $userMemberId";
                                    $resultAdmin = $connect -> query($admin);
                                    $adminAccount = mysqli_fetch_array($resultAdmin);
                                   
                                   if($searchBoard == 'noticeBoard'){
                                    if($adminAccount['adminAccount'] == 1){ ?>
                                        <div class='board_writeBtn'>
                                            <a href='noticeBoardWrite.php'>글쓰기</a>
                                        </div>
                                 <?php }  
                                        } else { ?>
                                        <div class='board_writeBtn'>
                                            <a href='noticeBoardWrite.php'>글쓰기</a>
                                        </div>
                              <?php } 
                                } ?>
                            

                            <div class="board_pages">                          
                                <ul>
                                <?php
                                    $boardCount = ceil($boardCount/$viewNum);
                                    $pageCurrent = 3;   
                                    $startPage = $page - $pageCurrent;

                                    $endPage = $page + $pageCurrent;
                                    switch ($startPage){
                                      case -2:
                                           $endPage += 3;
                                           break;
                                      case -1:
                                           $endPage += 2;
                                           break;
                                      case 0:
                                           $endPage += 1;
                                           break;
                                    }
                                    switch ($endPage){
                                        case $endPage:
                                             $startPage -= 1;
                                             break;
                                        case $endPage -1:
                                             $startPage -= 2;
                                             break;
                                        case $endPage -2:
                                             $startPage -= 3;
                                             break;
                                      }
                                    //처음 페이지 초기화 
                                    if($startPage < 1 ){
                                    $startPage = 1;
                                    }
                                    //마지막 페이지 초기화
                                    if($endPage > $boardCount ){
                                    $endPage = $boardCount;
                                    }
                                    //이전 페이지 , 처음 페이지
                                    echo "<li><a href='?searchKeyword={$searchKeyword}&searchOption={$searchOption}&page=1&searchBoard={$searchBoard}' class='ir board_first'>처음으로</a></li>";

                                    if($page != 1){
                                    $prevPage = $page -1;
                                    echo "<li><a href='?searchKeyword={$searchKeyword}&searchOption={$searchOption}&page={$prevPage}&searchBoard={$searchBoard}' class='ir board_prev'>이전</a></li>";
                                    }  

                                    //페이지 넘버 표시
                                    for( $i = $startPage; $i<= $endPage; $i++) {
                                    $active = "";
                                    if($i == $page) $active = "active";
                                    echo "<li class='{$active}'><a href='?searchKeyword={$searchKeyword}&searchOption={$searchOption}&page={$i}&searchBoard={$searchBoard}'>{$i}</a></li>";
                                    }

                                    //다음 페이지, 마지막 페이지
                                    if($page != $endPage){
                                    $nextPage = $page +1;
                                    echo "<li><a class='ir board_next' href='?searchKeyword={$searchKeyword}&searchOption={$searchOption}&page={$nextPage}&searchBoard={$searchBoard}'>다음</a></li>";
                                    }

                                    echo "<li><a class='ir board_last' href='?searchKeyword={$searchKeyword}&searchOption={$searchOption}&page={$boardCount}&searchBoard={$searchBoard}'>마지막으로</a></li>";
                                    ?>
                                
                                </ul>
                            </div>
                            <!-- .board_pages -->
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <!-- main -->
        <?php include "../include/footer.php" ?>
        <!-- footer -->
        
        <!-- // footer -->
    </body>
</html>
