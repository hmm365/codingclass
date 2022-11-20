<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
    
    $memberID = $_SESSION['memberID'];
    $blogAuthor = $_SESSION['youName'];
    $blogTitle = $_POST['blogTitle'];
    $blogContents = nl2br($_POST['blogContents']);
    $blogCategory = $_POST['blogCategory'];
    $blogView = 1;
    $blogLike = 0;
    $regTime = time();
    $blogTitle = $connect -> real_escape_string($blogTitle);
    $blogContents = $connect -> real_escape_string($blogContents);

    $blogImgFile = $_FILES['blogImgFile'];
    $blogImgSize = $_FILES['blogImgFile']['size'];
    $blogImgType = $_FILES['blogImgFile']['type'];
    $blogImgName = $_FILES['blogImgFile']['name'];
    $blogImgTmp  = $_FILES['blogImgFile']['tmp_name'];
    
    echo "<pre>";
    var_dump($blogImgFile);
    echo "</pre>";
    // array(5) {
    //     ["name"]=>
    //     string(8) "face.png"
    //     ["type"]=>
    //     string(9) "image/png"
    //     ["tmp_name"]=>
    //     string(14) "/tmp/phpunlYrE"
    //     ["error"]=>
    //     int(0)
    //     ["size"]=>
    //     int(830)
    // }
    // 이미지 파일명 확인
    if($blogImgType){
        $fileTypeExtension = explode("/", $blogImgType);
        $fileType = $fileTypeExtension[0];  //image
        $fileExtension = $fileTypeExtension[1]; //png.jpg.gif
        if($fileType == "image"){
            //확장자 설정
            if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "gif" || $fileExtension == "png"){
                //저장할 파일 이름 만들기
                $blogImgDir = "../assets/blog/";
                $blogImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";
                $sql = "INSERT INTO myBlog(memberID, blogTitle, blogContents, blogCategory, blogAuthor, blogView, blogLike, blogImgSrc, blogImgSize, blogDelete, blogRegTime) VALUES('$memberID', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogView', '$blogLike', '$blogImgName', '$blogImgSize', '0', '$regTime')";
            } else {
                echo "지원하는 이미지 파일 형식이 아닙니다.";
                exit;
            }
        }
    } else {
        //echo "이미지 파일이 아닙니다.";
        $sql = "INSERT INTO myBlog(memberID, blogTitle, blogContents, blogCategory, blogAuthor, blogView, blogLike, blogImgSrc, blogDelete, blogRegTime) VALUES('$memberID', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$blogView', '$blogLike', 'Img_default.jpg', '0', '$regTime')";
    }
    //이미지 사이즈 확인
    if($blogImgSize > 1000000){
        echo "<script>alert('이미지 용량이 1메가를 초과했습니다.'); history.back(1)</script>";
        exit;
        }
        $result = $connect -> query($sql);
        $result = move_uploaded_file($blogImgTmp, $blogImgDir.$blogImgName);
        Header("Location: blog.php");
    ?>