<?php
require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';

$search = $_POST['search'];
if ($search!=="") {
	
$sql = "SELECT * FROM diplomats WHERE telephone LIKE '%$search%'
   											 OR given_names  LIKE '%$search%'
   											 OR family_names LIKE '%$search%'
   											 OR type LIKE '%$search%'";
$res = $database->query($sql);  											 

while ($row = mysqli_fetch_assoc($res)) {?>
<a href="displayperson?id=<?=$Hash->encrypt($row['id']);?>">
		<div class="itemH">
			<div class="itemB">
				<span class="headerName"> <?=$row['given_names']?></span>
			</div>
			<div class="itemB">
				<span>tel: </span>
				<span class="value"> <?=$row['telephone']?></span>
			</div class="itemB">
		</div>
</a>
<?php }}
?>