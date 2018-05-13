<?php
include_once "../web-config/grobals.php";
if(!empty($_FILES['file']['name'])){


    //File uplaod configuration
   
    $img=$_FILES['file']['name'];
    $fileTmpLoc = $_FILES["file"]["tmp_name"];
    $phid=$_POST['id'];
    $owner_type=$_POST['owner_type'];
    $uploadDir = "uploads/";
    $fileName = basename($_FILES['file']['name']);
    

    if (!file_exists("uploads/")) {
        mkdir("uploads/", 0755);
    }

    
    $moveResult = move_uploaded_file($fileTmpLoc, "uploads/$fileName");
    if ($moveResult != true) {
        echo "error";
    }
    
    
    $sql = "UPDATE comments SET attachment='$attachment' WHERE owner='$phid' AND owner_type='$owner_type' ";
    $update=$database->query($sql);
    if($update){
        echo "Upload successful";
    }
    else{
        echo "Not successful please try again";
    }

}
