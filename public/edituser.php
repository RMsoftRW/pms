<?php
require_once("includes/validate_credentials.php");
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
                            <li><a href="users">Users</a></li>
                            <li class="active">Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['id'])){
        $id = $Hash->decrypt($_GET['id']);
        $stmt = $database->query("SELECT *  FROM user WHERE id = '$id' AND status='1'");
        $row = $database->fetch_array($stmt);
        ?>
        <div class="content mt-3">

            <div class="animated fadeIn">


                <div class="row">
                  <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Update</strong>
                        </div>
                        <div class="card-body">
                          <div id="register_div">
                              <div class="card-body">
                                  <div class="card-title">
                                      <h3 class="text-center">User information</h3>
                                  </div>
                                  <hr>

                                  <form id="updatefrm"   onsubmit="return false" method="post" novalidate="novalidate" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <label class="form-label">First Name<span class="required-mark">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter First name" autocomplete="off" minlength="2" name="firstname" id="firstname"  required value="<?php echo $row['fname']; ?>">

                                            </div>
                                    <div class="form-group">
                                        <label class="form-label">Middle name</label>
                                            <input type="text" class="form-control" placeholder="Enter Middle name" name="middlename" autocomplete="off" id="middlename"   value="<?php echo $row['mname']; ?>">


                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last Name<span class="required-mark">*</span></label>
                                            <input type="text" class="form-control" name="lastname" placeholder="Enter Last name" minlength="2" autocomplete="off" id="lastname" required value="<?php echo $row['lname']; ?>">

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email<span class="required-mark">*</span></label>
                                            <input type="email" class="form-control" placeholder="Enter email"  name="email" id="email" autocomplete="off" required   value="<?php echo $row['email']; ?>">


                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Access Level<span class="required-mark">*</span></label>


                                            <select class="form-control" id="level" name="level" required>
                                                <option value="">--Please Choose--</option>
                                                <?php
                                                $query= "SELECT * FROM `level`";
                                                $result1 = $database->query($query);
                                                while ($level=$database->fetch_array($result1)) {
                                                    if($level["id"]==$row['level']){ ?>
                                                        <option selected value="<?php echo $level["id"]; ?>"><?php echo $level["name"]; ?></option>
                                                   <?php }
                                                   else{
                                                        ?>
                                                <option value="<?php echo $level["id"]; ?>"><?php echo $level["name"]; ?></option>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </select>
                                    </div>
                                    <div class="form-group ">
                                        <label class="form-label">Institution<span class="required-mark">*</span></label>

                                            <select class="form-control show-tick" id="institution" name="institution" required>
                                                <option value="">--Please Choose--</option>
                                                <?php if($row["institution"]==0){?>
                                                <option selected value="0">MOFA</option>
                                                <?php }else { ?>
                                                    <option value="0">MOFA</option>
                                                <?php } ?>
                                                <?php


                                                $q= "SELECT * FROM institution_details WHERE id_institution=3";
                                                $rlt = $database->query($q);
                                                while ($inst=$database->fetch_array($rlt)) {
                                                    if($inst["id"]==$row['institution']){ ?>
                                                    <option selected value="<?php echo $inst["id"]; ?>"><?php echo $inst["name"]; ?></option>
                                                <?php }
                                                else{
                                                    ?>
                                                    <option value="<?php echo $inst["id"]; ?>"><?php echo $inst["name"]; ?></option>
                                                    <?php
                                                }
                                                }
                                                ?>
                                            </select>

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Username<span class="required-mark">*</span></label>
                                            <input type="text" class="form-control" minlength="4"  name="username"  placeholder="Enter username" autocomplete="off" id="username" onblur="check_username_update(<?php echo $id; ?>)"  value="<?php echo $row['username']; ?>">
                                        <span  id="username_status"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                            <input type="text" class="form-control"  minlength="4" placeholder="Enter password" autocomplete="off" name="password"  id="password"   value="">

                                    </div>
                                            <span id="status"></span>
                                     <div>
                        <button type="submit" id="updatebtn" class="btn btn-primary btn-sm" onclick="editUser(<?php echo $id; ?>)">
                          <i class="fa fa-dot-circle-o"></i> Update
                        </button>
                        <a href="users" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Cancel
                        </a>
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
<?php } ?>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/vendor/jquery-1.11.3.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/user.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

    </body>
</html>
