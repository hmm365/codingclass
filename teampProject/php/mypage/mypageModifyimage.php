<?php

include "../connect/connect.php";
include "../connect/session.php";
    
    $userMemberID = $_SESSION['userMemberID'];

    $userFile = $_FILES['userFile'];
    $userImgFile = $_FILES['userFile'];
    $userImgSize = $_FILES['userFile']['size'];
    $userImgType = $_FILES['userFile']['type'];
    $userImgName = $_FILES['userFile']['name'];
    $userImgTmp = $_FILES['userFile']['tmp_name'];
    
    $fileTypeExtension = explode("/", $userImgType);
    $fileType = $fileTypeExtension[0];      //image
    $fileExtension = $fileTypeExtension[1]; //png

    if($fileType == "image"){
        if($userImgSize > 5000000){
            echo "<script>alert('이미지 용량이 5메가를 초과했습니다. 다시 한번 확인해 주세요!'); history.back(1)</script>";
            exit;
        } else if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif"){
            $userImgDir = "../assets/userimg/";
            $userImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";
            $sql = "UPDATE userMember SET userPhoto = '$userImgName', userPhotoSize = '$userImgSize' WHERE userMemberID = '$userMemberID'";
        }
        
    } 
    
    $result = $connect -> query($sql);
    $result = move_uploaded_file($userImgTmp, $userImgDir.$userImgName);

    echo json_encode(array("image" => $userImgName));

?>