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
    $uploadTags = $_POST['inputHiden'];
    $uploadId = $_POST['inputHidenID'];
    $uploadWrite = nl2br($uploadWrite);
    $uploadTag = explode( '@^@&@!', $uploadTags );
    $uploadTagCount = count($uploadTag);

   
    $cateview = 1;
    $regTime = time();
    $userMemberID = $_SESSION['userMemberID'];

    $fileTypeExtension = explode("/", $uploadImgType);
    $fileType = $fileTypeExtension[0];      //image
    $fileExtension = $fileTypeExtension[1]; //png

    // echo "<pre>";
    // var_dump($uploadTag);
    // echo "</pre>";

    if(!$uploadImgType){
        $sql = "UPDATE categoryBoard SET categgoryTitle = '$uploadTitle' ,categgoryContents = '$uploadWrite' WHERE categgoryBoardID = '$uploadId' AND userMemberID = '$userMemberID';";
        $result = $connect -> query($sql);
        $tagRemoveSql = "DELETE FROM categoryTag WHERE categgoryBoardID = $uploadId";
        $connect -> query($tagRemoveSql);

        for($i=0; $i < $uploadTagCount-1; $i++) {
            $tagSql = "INSERT INTO categoryTag(categgoryBoardID, categgoryTag) VALUES('$uploadId', '$uploadTag[$i]');";
            $tagResult = $connect -> query($tagSql);
        } 

    }else {
        if($userImgSize > 5000000){
            echo "<script>alert('이미지 용량이 5메가를 초과했습니다. 다시 한번 확인해 주세요!'); history.back(1)</script>";
            exit;
        } else if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif"){
            $uploadImgDir = "../assets/categoryimg/";
            $uploadImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";
            $sql = "UPDATE categoryBoard SET categgoryTitle = '$uploadTitle', categgoryContents='$uploadWrite', categgoryPhoto='$uploadImgName',  categgoryPhotoSize= '$uploadImgSize' WHERE categgoryBoardID = '$uploadId' AND userMemberID = '$userMemberID'";
            $result = $connect -> query($sql);
            
            $uploadImgDir = "../assets/categoryimg/";
            $result = move_uploaded_file($uploadImgTmp, $uploadImgDir.$uploadImgName);

            $tagRemoveSql = "DELETE FROM categoryTag WHERE categgoryBoardID = $uploadId";
            $connect -> query($tagRemoveSql);

            for($i=0; $i < $uploadTagCount-1; $i++) {
                $tagSql = "INSERT INTO categoryTag(categgoryBoardID, categgoryTag) VALUES('$uploadId', '$uploadTag[$i]');";
                $tagResult = $connect -> query($tagSql);
            } 

        }
    } 
    Header("Location: ../main/main.php");
    

?>