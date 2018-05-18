<?php
require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';

$search = $database->escape_value($_POST['keyword']);
$id = $_POST['id'];
if ($search!=="")
    $sql = "SELECT * FROM institution_details WHERE (telephone LIKE '%$search%'
   											 OR name  LIKE '%$search%'
   											 OR contact_person LIKE '%$search%'
   											 OR comments LIKE '%$search%') AND id_institution =$id";
else
    $sql = "SELECT * FROM institution_details WHERE id_institution =$id";

$res = $database->query($sql);
if ($database->num_rows($res) > 0)
while ($row = mysqli_fetch_assoc($res)) {?>
    <tr class="row100 body">
        <td class="cell100 column1"><?=$row['name']?></td>
        <td class="cell100 column2"><?=$row['location']?></td>
        <td class="cell100 column3"><?=$row['email']?></td>
        <td class="cell100 column5"><a href="display?id=<?=$Hash->encrypt($row['id'])?>"> <span class="read"> View More<i class="fa fa-arrow-right"></i> </span></a></td>
    </tr>
<?php }
else{?>
    <tr class="row100 body">
        <td colspan="4"><tr><td colspan="4"><center><h3>No results Found</h3></center></td>

    </tr>
<?php }

?>