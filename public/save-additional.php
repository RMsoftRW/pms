<?php require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';


if (isset($_POST['save'])) {
    $date = $_POST['date'];
    $benefits = $database->escape_value($_POST['benefits']);
    $meeting = $database->escape_value($_POST['meeting']);
    $animal = $database->escape_value($_POST['animal']);
    $responsible_ministry = $database->escape_value($_POST['responsible_ministry']);

    $id = $_POST['id'];


    if ($_FILES['attachment']['name'] != ""){
        $target_file = basename($_FILES["attachment"]["name"]);
        $upload_dir = UPLOAD_DIR . $target_file;
        if (move_uploaded_file($_FILES["attachment"]['tmp_name'], $upload_dir)) {
            $database->query("UPDATE institution_details SET attachment='$target_file',payment_date='$date',benefits='$benefits',meeting='$meeting',anual_contribution='$animal',responsible_ministry='$responsible_ministry' WHERE id=$id");
            $id = $Hash->encrypt($id);
            header("location:display?id=$id");
        } else "error occured while uploading " . $target_file." <a href='register-ngo?id=$id'> Go back</a>";
    } else {
        $sql ="UPDATE institution_details SET payment_date='$date',benefits='$benefits',meeting='$meeting',anual_contribution='$animal',responsible_ministry='$responsible_ministry' WHERE id=$id";
        if ($database->query($sql)){
            $id = $Hash->encrypt($id);
            header("location:display?id=$id");
        }else echo $sql;

    }
}
