<?php
    $blogNewSql = "SELECT * FROM myBlog as b JOIN myMember as m ON(m.memberID = b.memberID) WHERE blogDelete = 0 ORDER BY blogID DESC LIMIT 8";
    $blogNewResult = $connect -> query($blogNewSql);
    foreach( $blogNewResult as $blogNew ){
?>

        <div class="card">
            <figure class="card__header">
                <img src="../assets/blog/<?=$blogNew['blogImgSrc']?>" alt="<?=$blogNew['blogImgSrc']?>">
                <a href="../blog/blogView.php?blogID=<?=$blogNew['blogID']?>" class="go" title="컨텐츠 바로가기"></a>
            </figure>
            <div class="card__contents">
                <div class="title">
                    <h3><a href="../blog/blogView.php?blogID=<?=$blogNew['blogID']?>" title="컨텐츠 바로가기"><?=$blogNew['blogTitle']?></a></h3>
                    <p><?=$blogNew['boardContents']?></p>
                </div>
                <div class="info">
                    <em class="author"><?=$blogNew['youName']?></em> 
                    <span class="time"><?=date('Y-m-d', $blogNew['regTime'])?></span>
                </div>
            </div>
        </div>
<?php } ?>