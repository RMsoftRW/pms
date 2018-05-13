<?php
include_once "../web-config/grobals.php";
if(!empty($_FILES['file']['name'])){


    //File uplaod configuration
   
    $img=$_FILES['file']['name'];
    $fileTmpLoc = $_FILES["file"]["tmp_name"];
    $phid=$_POST['id'];
    $uploadDir = "uploads/";
    $fileName = basename($_FILES['file']['name']);
    

    if (!file_exists("uploads/")) {
        mkdir("uploads/", 0755);
    }

    
    $moveResult = move_uploaded_file($fileTmpLoc, "uploads/$fileName");
    if ($moveResult != true) {
        echo "error";
    }
    
    
    $sql = "UPDATE diplomats SET photo='$fileName' WHERE id='$phid'";
    $update=$database->query($sql);
    if($update){
        echo "Upload successful";
    }
    else{
        echo "Not successful please try again";
    }

}
