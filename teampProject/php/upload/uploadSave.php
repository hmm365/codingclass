<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    if( !isset($_SESSION['userMemberID']) ){ 
        echo "<script>window.alert('잘못된접근입니다.'); location.href = '../main/main.php';</script>";
        }
    $uploadImgFile = $_FILES['uploadBasicImage'];
    $uploadImgSize = $_FILES['uploadBasicImage']['size'];
    $uploadImgType = $_FILES['uploadBasicImage']['type'];
    $uploadImgName = $_FILES['uploadBasicImage']['name'];
    $uploadImgTmp = $_FILES['uploadBasicImage']['tmp_name'];
    $uploadTitle = $_POST['uploadTitle'];
    $uploadWrite = $_POST['uploadWrite'];
    $uploadWrite = nl2br($_POST['uploadWrite']);
    
    $uploadTags = $_POST['inputHiden'];
    $uploadTag = explode( '@^@&@!', $uploadTags );
    $uploadTagCount = count($uploadTag);
    
    $cateview = 1;
    $regTime = time();
    $userMemberID = $_SESSION['userMemberID'];


    $fileTypeExtension = explode("/", $uploadImgType);
    $fileType = $fileTypeExtension[0];      //image
    $fileExtension = $fileTypeExtension[1]; //png

    if($fileType == "image"){
        if($userImgSize > 5000000){
            echo "<script>alert('이미지 용량이 5메가를 초과했습니다. 다시 한번 확인해 주세요!'); history.back(1)</script>";
            exit;
        } else if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif"){
            $uploadImgDir = "../assets/categoryimg/";
            $uploadImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";
            $sql = "INSERT INTO categoryBoard(userMemberID, categgoryTitle ,categgoryContents, categgoryPhoto,  categgoryPhotoSize, categgoryView, regTime) VALUES('$userMemberID', '$uploadTitle', '$uploadWrite', '$uploadImgName', '$uploadImgSize', '$cateview', '$regTime')";
            $result = $connect -> query($sql);

            $sqlSerch = "SELECT categgoryBoardID FROM categoryBoard WHERE categgoryPhoto = '$uploadImgName'";
            $serchResult = $connect -> query($sqlSerch);
            $serch = mysqli_fetch_array($serchResult);

            for($i=0; $i < $uploadTagCount-1; $i++) {
                $tagSql = "INSERT INTO categoryTag(categgoryBoardID, categgoryTag) VALUES(".$serch['categgoryBoardID'].", '$uploadTag[$i]');";
                $tagResult = $connect -> query($tagSql);
            } 

        }
    } 
    $uploadImgDir = "../assets/categoryimg/";
    $result = move_uploaded_file($uploadImgTmp, $uploadImgDir.$uploadImgName);
    Header("Location: ../main/main.php");
    

?>