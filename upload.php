<?php

session_start();


if(!isset($_SESSION['id'])) {
    if(isset($_SERVER['HTTP_REFERER'])) {
        header($_SERVER['HTTP_REFERER']);
    } else {
        header('location: index.php');
    }
    die();
}


    $pb = $_FILES["pb"];

    if($pb["size"] > 5000000) { //5 MB
         exit("Sorry, your uploaded image is too large!");
    }

    if(strtolower($pb["type"]) != "image/jpeg" && strtolower($pb["type"]) != "image/png") {
        exit("Sorry, Please only upload jpeg/png Files!");
    } 


    $path = 'upload/' . $_SESSION['id'];
    if(file_exists($path) == FALSE) {
        mkdir($path,0777,true);
    }

    if(move_uploaded_file($_FILES['pb']['tmp_name'],$path . '/pb.jpg')){
        echo "You file was successfully uploaded!";
    } else {
        echo "There was a error while uploading your file!";
    };
    




?>