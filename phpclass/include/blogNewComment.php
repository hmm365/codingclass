<?php
    $blogNewSql = "SELECT * FROM myComment WHERE commentDelete = 0 ORDER BY commentID DESC LIMIT 4";
    // $sql = "SELECT b.blogID  FROM classBlog b JOIN myMember m ON(b.memberID = m.memberID)  WHERE commentDelete = 0 ORDER BY blogID DESC LIMIT 4";
    $blogNewResult = $connect -> query($blogNewSql);
    foreach( $blogNewResult as $blogNew ){
?>
        <li>
            <a href="blogView.php?blogID=<?=$blogNew['blogID']?>">
                <!-- <span><img src="../assets/blog/card_bg_01.png" alt="<?=$blogNew['blogTitle']?>"></span> -->
                <em><?=$blogNew['commentMsg']?></em>
            </a>
         </li>
<?php } ?>