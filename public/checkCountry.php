<?php
require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';

$country = $_POST['country'];
$id = $_POST['id'];

$res =$database->query("SELECT * FROM institution_details WHERE country=$country AND id_institution=$id");
if ($database->num_rows($res) > 0)
    echo "already Registred";
else
    return "true";

