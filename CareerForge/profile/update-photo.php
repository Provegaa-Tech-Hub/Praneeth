<?php

session_start();

require_once("../database/db.php");


if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");
    exit();

}


$userId = $_SESSION['user_id'];



if(!isset($_FILES['profile_image'])){

    die("No image received");

}



$image = $_FILES['profile_image'];



if($image['error'] != 0){

    die("Upload error");

}



$ext = strtolower(
    pathinfo($image['name'], PATHINFO_EXTENSION)
);



$allowed = [
    "jpg",
    "jpeg",
    "png",
    "webp"
];


if(!in_array($ext,$allowed)){


    die("Invalid image format");


}



$newName = "profile_".$userId."_".time().".".$ext;



$folder = "../assets/images/profile/";



if(!is_dir($folder)){

    mkdir($folder,0777,true);

}



$target = $folder.$newName;



if(move_uploaded_file($image['tmp_name'],$target)){



    $update = mysqli_query(
        $conn,
        "UPDATE users 
         SET profile_photo='$newName'
         WHERE id='$userId'"
    );



    if($update){


        header("Location: profile.php?success=photo");

        exit();


    }
    else{


        die("Database Error : ".mysqli_error($conn));


    }



}
else{


    die("Image moving failed");


}


?>