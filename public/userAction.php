<?php
require_once("../web-config/config.php");
require_once ("../web-config/database.php");
include ("includes/encryption.php");

if(isset($_POST["add"])){

    $username = $_POST['username'];


    $hash_pass=md5($_POST['password']);
    $userData = array(
        'fname' => $database->escape_value($_POST['firstname']),
        'mname' => $database->escape_value($_POST['middlename']),
        'lname' => $database->escape_value($_POST['lastname']),
        'username' => $database->escape_value($_POST['username']),
        'password' => $_POST['password'],
        'level' => $_POST['level'],
        'email' => $database->escape_value($_POST['email']),
        'password' => $hash_pass,
        'id_institution' => $_POST['institution'],
        'avatar'=>"",


    );
    $insert = $database->insert("user",$userData);

    if($insert)
    {
        if (!file_exists("../uploads/users/$username")) {
            mkdir("../uploads/users/$username", 0755);
            echo "success";
        }

    }


}

//check if username exist
if(isset($_POST["username_check"])){
    $username =$database->escape_value( $_POST['username']);

    $sql = "SELECT * FROM user WHERE username='$username' AND status='active'";
    $results=$database->query($sql);
    $n = $database->num_rows($results);
        if($n >0){
        echo "taken";
}
else{
    echo "not_taken";

}}

if(isset($_POST["username_update"])){
    $username =$database->escape_value( $_POST['username']);
    $id=$_POST["id"];
    $sql = "SELECT * FROM user WHERE username='$username' AND id !=$id AND status='active'";
    $results=$database->query($sql);
    $n = $database->num_rows($results);
    if($n >0){
        echo "taken";
    }
    else{
        echo "not_taken";

    }}
if (isset($_POST["change"])){

    $id=$_POST["id"];
    $p=$_POST["p"];
    $pnew=$_POST["p1"];
    $sql = "SELECT * FROM user WHERE id='$id'";
    $results=$database->query($sql);
    $row=$database->fetch_array($results);
    $hash_p=md5($p);
    $hash_pnew=md5($pnew);
    if($p!=$row["password"]){
        echo "Invalid";
    }
    else{

        $stmts = $database->query("UPDATE user SET password='$hash_pnew' WHERE id = '$id'") ;
        $res=$database->affected_rows($stmts);
        if($res==1){
            echo "updated";
        }

    }

}

if(isset($_POST["edit"])){

    if(!empty($_POST['id'])){
        $id=$_POST['id'];
        $fn =$database->escape_value($_POST['firstname']);
        $mn = $database->escape_value($_POST['middlename']);
        $ln = $database->escape_value($_POST['lastname']);
        $u =$database->escape_value($_POST['username']);
        $level = $_POST['level'];
        $email = $database->escape_value($_POST['email']);
        $id_institution = $_POST['institution'];
        $password=$_POST['password'];
        $rn=0;
        if($password==""){
            $stmts = $database->query("UPDATE user SET fname = '$fn', lname='$ln', mname='$mn', email='$email', username='$u', level='$level', id_institution='$id_institution' WHERE id = '$id'") ;
            $rn=$database->affected_rows($stmts);
        }
        else{
            $hash=md5($password);
            $stmts = $database->query("UPDATE user SET fname = '$fn', lname='$ln', mname='$mn', email='$email',password='$hash', username='$u', level='$level', id_institution='$id_institution' WHERE id = '$id'") ;
            $rn=$database->affected_rows($stmts);
        }


        if($rn==1){
            echo "updated";
        }
        else{
            echo " error";
        }
    }


}
if(isset($_POST['delete'])){
    if(!empty($_POST['id'])){
        $id = $_POST['id'];

        $query = "UPDATE user SET status='deleted' WHERE id=".$id;
        if($database->query($query)){
            echo "deleted";
        }



    }
}

if (isset($_POST["level"])){
    $level=$database->escape_value(trim($_POST["level"]));
    $keyword=strtolower($level);
    if($keyword==""){

        $st=$database->query("SELECT * FROM user WHERE status = 'active'");
    }
    else{
        $st =$database->query("SELECT * from user where lower (`fname`) LIKE '$keyword%' OR lower (`lname`) LIKE '$keyword%' OR lower (`mname`) LIKE '$keyword%' OR lower (`email`) LIKE '$keyword%' AND status='active'");

    }
    $html="";
    $count=1;

    while ($row=$database->fetch_array($st)) {
        $fname=$row["fname"];
        $lname=$row["lname"];
        $mname=$row["mname"];
        $email=$row["email"];
        $u=$row['username'];
        $level=$row["level"];
        $status=$row["active"];
        $avatar=$row["avatar"];
        $inst=$row['id_institution'];
        $id=$row["id"];
        $Hash=new Encryption();
        $id_hash=$Hash->encrypt($id);
        $show="<tr><td><span class='custom-checkbox'><input type='checkbox' id='.$id.' name='options[]' value=$id><label for='checkbox'></label></span></td>";
        $show.=" <td>$count</td>";
        if (file_exists("../uploads/user/".$u."/".$avatar)){
            $src="../uploads/user/".$u."/".$avatar;
        }
        else{
            $src="images/default_profile.png";
        }
        $show.="<td><img src='$src' class='avatar' alt='Avatar'> $fname $mname $lname</td>
                <td>$email</td>
                <td>$u</td>";
        if($status==0){
            $show.="<td><span class='status badge badge-danger'>Inactive</td>";}
        else if($status==1) {
            $show.="<td><span class='status badge badge-primary'>Active</td>";
        }

        if($row['id_institution']==0){
            $show.= "<td>MOFA</td>"; }
        else{
            $i=$database->get_item('institution_details','id',$row['id_institution'],'name');
            $show.="<td>$i</td>";
        }
        $i=$database->get_item("level","id",$row['level'],"name");
        $show.="<td>$i</td>
        <td><a href='edituser?id=$id_hash' class='edit'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
                                <a href='#deleteuserModal' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
                            </td>
        </tr>";
        $count++;
        $html.=$show;
    }
    if($html==""){
        echo "<tr>No user found</tr>";
    }
    else {
        echo $html;
    }
}
