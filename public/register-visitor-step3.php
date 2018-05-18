<?php require_once("includes/validate_credentials.php");
require_once '../web-config/config.php';
require_once '../web-config/database.php';

if (!isset($_GET['id'])) {
    header("location:register-visitor-step2");
}?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php require_once("includes/head.php");

    $id = $Hash->decrypt($_GET['id']);
    $id_hash = $_GET['id'];
    $visit = $database->get_item("visit",'visitor',$id,'id');
    function check_if($value){
        $Hash = new Encryption();
        $database = new mysqldatabase(DB_NAME);
        if (isset($_GET['id'])) {
            $id = $Hash->decrypt($_GET['id']);
            $id = $database->get_item("companion",'visitor',$id,'id');
            $val = $database->get_item('companion','id',$id,$value);
            return $val;
        }
        else return "";
    }

    ?>
</head>
<body>
<style type="text/css">
    select {
        background-color: #F5F5F5;
        border: 1px double #15a6c7;
        color: #1d93d1;
        font-family: Georgia;
        font-weight: bold;
        font-size: 14px;
        height: 39px;
        padding: 7px 8px;
        width: 250px;
        outline: none;
        margin: 10px 0 10px 0;
    }
    select option, .form-control{
        font-family: Georgia;
        font-size: 14px;
    }

    label{
        font-weight: bold;
        font-family: serif;
    }


    .tab-container{
        background: #fff;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        padding-bottom: 20px;
    }
    .tab-container nav{
        background: transparent;
        border: none;
    }
    .tab-content{
        padding: 0px 40px;
    }
    .tab-content legend{
        margin-bottom: 20px;
        margin-top:40px;
        text-align: center;
        color: #272c33;
        font-family: georgia;
    }
    .tab-content-body{
        margin: 0 auto;
        width: 80%;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
    }
    .btn ,.btn-primary{background: #272c33;color: #fff}
    #nav-tab{width: 80%;margin:0 auto;}
    #nav-tab ul
    {
        margin: 0;
        background: #000;
        padding: 0;
        list-style-type: none;
        text-align: center;
    }

    #nav-tab ul li { display: inline;float: left;padding: 15px 10%;background:#272c33;border-right: 1px solid grey }
    #nav-tab ul li a{
        color: #fff;
    }
    #nav-tab ul li#active{background: #E74C3C !important}
</style>
<?php require_once 'includes/left_nav.php'; ?>

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <?php require_once 'includes/top_nav.php'; ?>
    <div class="container">
        <div class="tab-container">
            <div class="tab-content" id="nav-tabContent">
                <div id="nav-tab">
                    <ul>
                        <li><a href="register-visitor?id=<?=$id_hash?>">Visit Form</a></li>
                        <li><a href="register-visitor-step2?id=<?=$id_hash?>">Visit Details</a></li>
                        <li id="active"><a href="<?=$_SERVER['REQUEST_URI']?>">Companions</a></li>
                    </ul>
                </div>
                <div class="tab-content-body">
                    <legend>Registration Form - Step III </legend>
                    <div style="margin-bottom: 70px;">
                    <a href="displayperson?id=<?=$id_hash?>"><button class="btn  pull-right" style="padding-right: 50px;padding-left: 50px;"> Skip this Step  <span style="color: #E74C3C;margin-left: 12%"> <i class="fa fa-arrow-right"></i> </span> </button> </a>
                    </div>
                        <form action="save-visitors.php" method="POST" id="form">
                        <input type="hidden" value="<?=$visit?>" name="visit">
                        <div class="form-group">
                            <label for="name">Names<span class="required-mark">*</span></label>
                            <input type="text" class="form-control"  id="names" name="names" placeholder="Names">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender<span class="required-mark">*</span></label>
                            <select name="gender" class="form-control" id="gender">
                                <option value="0">SELECT GENDER</option>
                                <option value="Male">Male</option>
                                <option value="Male">Female</option>
                            </select>

                        </div>
                        <input type="hidden" name="visitor" value="<?=$Hash->decrypt($_GET['id'])?>">
                        <div class="form-group">
                            <label for="name">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth">
                        </div>
                        <div class="form-group">
                            <input type="checkbox"  name="checked" id="checked" style="font-size: 20px;-ms-transform: scale(2); /
                              -moz-transform: scale(2);
                              -webkit-transform: scale(2);
                              -o-transform: scale(2);
                              padding: 6px;">
                            <span style="margin-left: 5%;font-size: 14px;color:#272C33;font-weight: bold">Finish adding Companions</span>
                        </div>
                        <div class="pull-right">
                            <a class="btn" href="register-visitor-step2?id=<?=$id_hash?>" style="color: white">Previous</a>
                            <button class="btn" type="submit" name="save3">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="assets/js/vendor/jquery-1.9.1.js"></script>
<script src="assets/js/vendor/jquery-validate.min.js"></script>
<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
<script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
<script type="text/javascript">
    $(function() {
        $.validator.addMethod("validCountry", function (value, element, arg) {
            return arg !== value;
        }, "Select a Valid Country");
        $("#form").validate({
            rules: {
                gender: {validCountry : "0"},
                names: "required",
                insurance: "required"
            },
            messages: {gender: "Please select A Valid Gender"},
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>