<?php require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';
if (isset($_POST['save1'])) {
    $given = $database->escape_value($_POST['given_names']);
    $fnames = $database->escape_value($_POST['family_names']);
    $other = $database->escape_value($_POST['other_names']);
    $gender = $database->escape_value($_POST['gender']);
    $dob = $_POST['dob'];
    $pob = $database->escape_value($_POST['pob']);
    $nob = $_POST['nob'];
    $nop = $_POST['nop'];
    $doi = $_POST['doi'];
    $doe = $_POST['doe'];
    $email = $database->escape_value($_POST['email']);
    $telephone = $database->escape_value($_POST['telephone']);
    $pass_no = $database->escape_value($_POST['pass_no']);
    $profession = $database->escape_value($_POST['profession']);
    $occupation = $database->escape_value($_POST['occupation']);
    $employer = $database->escape_value($_POST['employer']);
    $father_name = $database->escape_value($_POST['father_name']);
    $father_nat = $database->escape_value($_POST['father_nat']);
    $mother_name = $database->escape_value($_POST['mother_name']);
    $mother_nat = $database->escape_value($_POST['mother_nat']);
    $marital_status = $database->escape_value($_POST['marital_status']);

    if (isset($_POST['update'])){
        $update_id = $_POST['update'];
        $sql = "UPDATE diplomats SET given_names='$given',family_names='$fnames',other_names='$other',gender='$gender',dob='$dob',pob='$pob',nob='$nop',email='$email',telephone='$telephone',pass_no='$pass_no',nop='$nop',doi='$doi',doe='$doe',profession='$profession',occupation='$occupation',employer='$employer',father_name='$father_name',father_nat='$father_nat',mother_name='$mother_name',mother_nat='$mother_nat',marital_status='$marital_status' WHERE id=$update_id";
        if ($database->query($sql)) {
            $id=$Hash->encrypt($update_id);
            header("location:diplomat-details?id=$id");
        }
    }


    $sql= "INSERT INTO diplomats(given_names,family_names,other_names,gender,dob,pob,nob,email,telephone,pass_no,nop,doi,doe,profession,occupation,employer,father_name,father_nat,mother_name,mother_nat,marital_status,type) VALUES('$given','$fnames','$other','$gender','$dob','$pob','$nob','$email','$telephone','$pass_no','$nop','$doi','$doe','$profession','$occupation','$employer','$father_name','$father_nat','$mother_name','$mother_nat','$marital_status','3')";

    if ($database->query($sql)) {
        $id=$Hash->encrypt($database->inset_id());
        header("location:diplomat-details?id=$id");
    }


}