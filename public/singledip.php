<?php require_once("includes/validate_credentials.php");
require_once '../web-config/config.php';
require_once '../web-config/database.php';

if (!isset($_GET['id']))
    header("location:javascript://history.go(-1)");
//?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php require_once("includes/head.php"); ?>
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/table.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/perfect-scrollbar.css">

</head>
<body>

<?php require_once 'includes/left_nav.php'; ?>

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <?php require_once 'includes/top_nav.php'; ?>
    <div class="section">
        <div class="container">
            <?php
            $id=$Hash->decrypt($_GET['id']);
            if ($id== 1) {
                $title = "ALL DIPLOMATS";
            }
            if ($id== 2) {
                $title = "ALL AMBASSADORS";
            }
            if ($id== 3) {
                $title = "ALL FOREIGN DIPLOMATS";
            }
            if ($id== 4) {
                $title = "ALL RWANDAN DIPLOMATS";
            }
            if ($id== 5) {
                $title = "ALL VISITORS";
            }

            ?>
            <h2 style="font-family: 'Gill Sans MT Condensed';position:relative;top: 20px;" class="text-center"><?=$title?></h2>
            <div class="pull-right" style="margin-bottom: 20px;" id="sss">
                <div class="input-group" id="igroup">
                    <span class="input-group-addon" style="border: none;background: transparent"><i class="fa fa-search"></i></span>
                    <input id="search" type="text" autocomplete="off" onkeyup="search()" class="form-control" placeholder="Search&hellip;" data-id="<?=$database->get_item('institution','Id',$Hash->decrypt($_GET['id']),'Id')?>">
                </div>
            </div>

            <table class="table">
                <thead style="background: #e7663c !important;color: #fff">
                <tr id="header">
                    <th>Name</th>
                    <th>Location</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="table-body">
                <?php $id = $Hash->decrypt($_GET['id']);
                if ($id== 1) {
                    $st4 = $database->query("SELECT * FROM diplomats");
                }
                if ($id== 2) {
                    $st4 = $database->query("SELECT * FROM diplomats WHERE type='2' ");
                }
                if ($id== 3) {
                    $st4 = $database->query("SELECT * FROM diplomats WHERE type='3'");
                }
                if ($id== 4) {
                    $st4 = $database->query("SELECT * FROM diplomats WHERE type='4'");
                }
                if ($id== 5) {
                    $st4 = $database->query("SELECT * FROM diplomats WHERE type='5'");
                }
                $numh=$database->num_rows($st4);
                if ($numh==0) {
                    echo '<tr><td colspan="4"><center><h2>No data Available</h2></center></td></tr>';
                }
                else{

                foreach ($st4 as $key => $value) {
                    if ($value['type']!="5") {
                    $pat="diplomat-details";
                    }
                    else{
                    $pat="displayperson";
                    }
                    $valuev['id']= $value['id'];?>
                    <tr>
                        <td><?=$value['given_names']?></td>
                        <td><?=$value['telephone']?></td>
                        <td><?=$value['email']?></td>
                        <td><a href="<?=$pat?>?id=<?=$Hash->encrypt($valuev['id'])?>"><span class="read"> View More<i class="fa fa-arrow-right"></i> </span></a></td>
                    </tr>
                <?php } }?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <script>
        function search() {
            $.ajax({
                url: "searchdip",
                type : "POST",
                data :  {
                    id : $("#search").data("id"),
                    keyword : $("#search").val()
                },
                success : function (data) {
                    $("#table-body").html(data);
                }

            });
        }
    </script>
