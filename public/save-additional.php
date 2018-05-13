<?php require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';
$upload_dir = "uploads/";

if (isset($_POST['save'])) {
    $date = $_POST['date'];
    $benefits = $database->escape_value($_POST['benefits']);
    $meeting = $database->escape_value($_POST['meeting']);
    $animal = $database->escape_value($_POST['animal']);
    $responsible_ministry = $database->escape_value($_POST['responsible_ministry']);

    $id = $_POST['id'];


    if (isset($_POST['attachment'])) {
        $target_file = basename($_FILES["attachment"]["name"]);
        if (move_uploaded_file($_FILES["attachment"]['tmp_name'], $target_file)) {
            $database->query("UPDATE institution_details SET attachment='$target_file',payment_date='$date',benefits='$benefits',meeting='$meeting',animal_contribution='$animal',responsible_ministry='$responsible_ministry' WHERE id=$id");
            $id = $Hash->encrypt($id);
            header("location:display?id=$id");
        } else "error occured while uploading " . $target_file;
    } else {
        $database->query("UPDATE institution_details SET payment_date='$date',benefits='$benefits',meeting='$meeting',animal_contribution='$animal',responsible_ministry='$responsible_ministry' WHERE id=$id");
        $id = $Hash->encrypt($id);
        header("location:display?id=$id");
    }
}
