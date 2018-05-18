<?php require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';

$name = $database->escape_value($_POST['name']);
$institution = $database->escape_value($_POST['institution']);
$phone = $database->escape_value($_POST['phone']);
$contact_person = $database->escape_value($_POST['contact_name']);
$contact_phone = $database->escape_value($_POST['contact_phone']);
$location = $database->escape_value($_POST['location']);
$country = $database->escape_value($_POST['country']);
$email = $database->escape_value($_POST['email']);

if (isset($_POST['save1'])) {

    if (isset($_POST['id'])){
        $ids = $_POST['id'];
        $sql= "UPDATE institution_details SET name='$name',telephone='$phone',contact_person='$contact_person',location='$location',country=$country,contact_phone='$contact_phone',email='$email' WHERE id=$ids";
        if ($database->query($sql))
            $id = $Hash->encrypt($ids);
            header("location:display?id=$id");

    }
    else {
            if ($database->num_rows($database->query("SELECT * FROM institution_details WHERE country=$country AND id_institution=$institution")) >0)
                header("location:dfs");

            else {

            $sql= "INSERT INTO institution_details(name,id_institution,telephone,contact_person,location,country,contact_phone,email) VALUES('$name',$institution,'$phone','$contact_person','$location','$country','$contact_phone','$email')";

                if ($database->query($sql)) {
                    $id=$Hash->encrypt($database->inset_id());
                    header("location:display?id=$id");
                }
            }
        }
}



if (isset($_POST['save2'])) {

    $country_loc = $database->escape_value($_POST['country_loc']);

    if (isset($_POST['id'])){
        $ids =$_POST['id'];
        $sql= "UPDATE institution_details SET name='$name',telephone='$phone',contact_person='$contact_person',location='$location',country=$country,country_loc=$country_loc,contact_phone='$contact_phone',email='$email' WHERE id=$ids";
        if ($database->query($sql)){
            $id=$Hash->encrypt($ids);
            header("location:display?id=$id");
        }

    }
    else {
            if ($database->num_rows($database->query("SELECT * FROM institution_details WHERE country=$country AND id_institution=$institution")) > 0)
                header("location:dfs");
            else {

            $sql= "INSERT INTO institution_details(name,id_institution,telephone,contact_person,location,country,country_loc,contact_phone,email) VALUES('$name',$institution,'$phone','$contact_person','$location','$country','$country_loc','$contact_phone','$email')";
		
            if ($database->query($sql)) {
                $id=$Hash->encrypt($database->inset_id());
                header("location:display?id=$id");
            }
                 echo $sql;

            }
        }
}