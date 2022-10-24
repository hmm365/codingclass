<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $myMemberID = $_SESSION['myMemberID'];
    $blogAuthor = $_SESSION['youName'];
    $blogCategory = $_POST['blogCategory'];
    $blogTitle = $_POST['blogTitle'];
    $blogContents = nl2br($_POST['blogContents']);
    $blogView = 1;
    $blogLike = 0;
    $regTime = time();
    $blogImgFile = $_FILES['blogFile'];
    $blogImgSize = $_FILES['blogFile']['size'];
    $blogImgType = $_FILES['blogFile']['type'];
    $blogImgName = $_FILES['blogFile']['name'];
    $blogImgTmp = $_FILES['blogFile']['tmp_name'];
    echo "<pre>";
    var_dump($blogImgFile);
    echo "</pre>";
    // array(5) {
    //     ["name"]=>
    //     string(9) "icon1.png"
    //     ["type"]=>
    //     string(9) "image/png"
    //     ["tmp_name"]=>
    //     string(36) "/Applications/MAMP/tmp/php/phpWOWyQJ"
    //     ["error"]=>
    //     int(0)
    //     ["size"]=>
    //     int(1479)
    // }
    //이미지 파일명 확인
    if($blogImgType){
        $fileTypeExtension = explode("/", $blogImgType);
        $fileType = $fileTypeExtension[0];      //image
        $fileExtension = $fileTypeExtension[1]; //png
        //이미지 타입 확인
        if($fileType == "image"){
            if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif"){
                $blogImgDir = "../assets/img/blog/";
                $blogImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";
                // echo "이미지 파일이 맞네요!";
                $sql = "INSERT INTO myBlog(myMemberID, blogTitle, blogContents, blogCategory, blogAuthor, blogView, blogLike, blogImgFile, blogImgSize, blogDelete, blogRegTime) VALUES('$myMemberID', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogView', '$blogLike', '$blogImgName', '$blogImgSize', '$blogLike', '$regTime')";
            } else {
                echo "<script>alert('지원하는 이미지 파일이 아닙니다. 한번더 확인해주세요!'); history.back(1)</script>";
            }
        }
    } else {
        // echo "이미지 파일이 첨부하지 않았습니다.";
        $sql = "INSERT INTO myBlog(myMemberID, blogTitle, blogContents, blogCategory, blogAuthor, blogView, blogLike, blogImgFile, blogImgSize, blogDelete, blogRegTime) VALUES('$myMemberID', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogView', '$blogLike', 'Img_default.jpg', '$blogImgSize', '$blogLike', '$regTime')";
    }
    //이미지 사이즈 확인
    if($blogImgSize > 1000000){
        echo "<script>alert('이미지 용량이 1메가를 초과했습니다. 다시 한번 확인해 주세요!'); history.back(1)</script>";
        exit;
    }
    $result = $connect -> query($sql);
    $result = move_uploaded_file($blogImgTmp, $blogImgDir.$blogImgName);
    Header("Location: blog.php");
?>
</body>
</html>