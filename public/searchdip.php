<?php
require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';

$search = $database->escape_value($_POST['keyword']);
$id = $database->escape_value($_POST['id']);
if ($search!=="") {

    if ($id == 1){
        $sql = "SELECT * FROM diplomats WHERE (telephone LIKE '%$search%'
   											 OR given_names  LIKE '%$search%'
   											 OR family_names LIKE '%$search%'
   											 OR type LIKE '%$search%')";
    }
    else
        $sql = "SELECT * FROM diplomats WHERE (telephone LIKE '%$search%'
   											 OR given_names  LIKE '%$search%'
   											 OR family_names LIKE '%$search%'
   											 OR type LIKE '%$search%') AND type=$id";

    }
    else {
        if ($id == 1){
            $sql = "SELECT * FROM diplomats";
        }
        else
            $sql = "SELECT * FROM diplomats WHERE type =$id ";
    }
    $res = $database->query($sql);
    if ($database->num_rows($res) > 0)
        while ($row = mysqli_fetch_assoc($res)) { if ($row['type'] != 5) $url = "diplomat-details";else $url="displayperson"; ?>

            <tr class="row100 body">
                <td class="cell100 column1"><?= $row['given_names'] ?></td>
                <td class="cell100 column2"><?= $row['telephone'] ?></td>
                <td class="cell100 column3"><?= $row['email'] ?></td>
                <td class="cell100 column5"><a href="<?=$url?>?id='<?= $Hash->encrypt($row['id']) ?>"> <span class="read"> View More<i
                                    class="fa fa-arrow-right"></i> </span></a></td>
            </tr>
        <?php }
    else {
        ?>
        <tr class="row100 body">
            <td colspan="4"><tr><td colspan="4"><center><h3>No results Found</h3></center></td>

        </tr>

    <?php } ?>