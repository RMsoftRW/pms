<?php
    require_once("includes/validate_credentials.php");

$sql = "SELECT * FROM user WHERE username ='{$_SESSION["username"]}' AND id='{$_SESSION["id"]}' AND active='1' LIMIT 1";
$query = $database->query($sql);
$user=$database->fetch_array($query);


if(isset($_POST['update'])){
    $fn = $database->escape_value($_POST['firstname']);
    $ln = $database->escape_value($_POST['lastname']);
    $mn = $database->escape_value($_POST['middlename']);
    $email = $database->escape_value($_POST['email']);
    $u = $database->escape_value($_POST['username']);
    if(!empty($fn) && !empty($ln) && !empty($email) && !empty($u)){
        $stmts = $database->query("UPDATE user SET fname = '$fn', lname='$ln', mname='$mn', email='$email', username='$u' WHERE id = '{$_SESSION["id"]}'") ;
        $res=$database->affected_rows($stmts);
        if($res==1){
            header('Location:profile ');
        }
    }


}

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php require_once("includes/head.php"); ?>
</head>
<body>
<!-- Left Panel -->
<?php require_once 'includes/left_nav.php'; ?>
<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <?php require_once 'includes/top_nav.php'; ?>
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="home">Dashboard</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">

        <div class="animated fadeIn">


            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Update Your Profile</strong>
                        </div>

                        <div class="card-body">
                            <div id="register_div">
                                <div class="card-body">

                                    <form id="profile"   action="" method="post" novalidate="novalidate" enctype="multipart/form-data">


                                                <div class="row form-group">
                                                    <div class=" col-md-3">
                                                        <label class="form-label">First Name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $user["fname"]; ?>">

                                                    </div>
                                                </div>

                                                    <div class=" row form-group">
                                                        <div class=" col-md-3">
                                                            <label class="form-label">Middle name</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="middlename" id="middlename" value="<?php echo $user["mname"]; ?>">

                                                        </div>
                                                    </div>

                                                <div class="row form-group">
                                                    <div class=" col-md-3">
                                                        <label class="form-label">Last Name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $user["lname"]; ?>">

                                                    </div>


                                                </div>
                                                <div class="row form-group">
                                                    <div class=" col-md-3">
                                                        <label class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control"   name="email" id="email" value="<?php echo $user["email"]; ?>"  >
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class=" col-md-3">
                                                        <label class="form-label">Username</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" autocomplete="off"   name="username"  id="username" value="<?php echo $user["username"]; ?>" onkeyup="check_username_update(<?php echo $_SESSION["id"]; ?>)">
                                                        <span id="username_status"></span>
                                                    </div>


                                                </div>
                                                <span id="status"></span>
                                                <div>
                                                    <button id="updatebtn" name="update" type="submit" class="btn btn-md btn-info">
                                                        Update
                                                    </button>
                                                </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div> <!-- .card -->

                </div><!--/.col-->



            </div>


        </div><!-- .animated -->
    </div><!-- .content -->


</div><!-- /#right-panel -->

<!-- Right Panel -->


<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script src="js/ajax.js"></script>
<script src="assets/js/vendor/jquery-1.11.3.min.js"></script>


</body>
</html>
