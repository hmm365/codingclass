<?php
    $boardNewSql = "SELECT * FROM myBoard as b JOIN myMember as m ON(m.memberID = b.memberID) ORDER BY boardID DESC LIMIT 6";
    $boardNewResult = $connect -> query($boardNewSql);
    foreach( $boardNewResult as $boardNew ){
?>
        <tr>
            <td><?=$boardNew['boardID']?></td>
            <td><a href='../board/boardView.php?boardID=<?=$boardNew['boardID']?>'><?=$boardNew['boardTitle']?></td>
            <td><?=$boardNew['youName']?></td>
            <td><?=$boardNew['regTime']?></td>
            <td><?=date('Y-m-d', $boardNew['regTime'])?></td>
        </tr>
<?php } ?>