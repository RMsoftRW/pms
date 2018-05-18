<?php require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';
if (isset($_POST['save1'])) {
$name = $database->escape_value($_POST['name']);
$institution = $database->escape_value($_POST['institution']);
$phone = $database->escape_value($_POST['phone']);
$contact_person = $database->escape_value($_POST['contact_name']);
$contact_phone = $database->escape_value($_POST['contact_phone']);
$location = $database->escape_value($_POST['location']);
$country = $database->escape_value($_POST['country']);
$email = $database->escape_value($_POST['email']);
$res =$database->query("SELECT * FROM institution_details WHERE country=$country AND id_institution=$institution");

if (!isset($_POST['id'])){
    $sql= "INSERT INTO institution_details(name,id_institution,telephone,contact_person,location,country_loc,contact_phone,email) VALUES('$name',$institution,'$phone','$contact_person','$location','$country','$contact_phone','$email')";
    if ($database->query($sql)) {
        $id=$Hash->encrypt($database->inset_id());
        header("location:register-ngo-step2?id=$id");
    }}
else{$id =$_POST['id'];
    $sql = "UPDATE institution_details SET name='$name',id_institution=$institution,telephone='$phone',contact_person='$contact_person',location='$location',country_loc='$country',contact_phone='$contact_phone',email='$email' WHERE id=$id";
    if ($database->query($sql)) {
        $id=$Hash->encrypt($id);
        header("location:register-ngo-step2?id=$id");
    }
}
}
