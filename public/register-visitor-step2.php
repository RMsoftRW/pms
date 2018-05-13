<?php require_once("includes/validate_credentials.php");
require_once '../web-config/config.php';
require_once '../web-config/database.php';
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php require_once("includes/head.php");
    if (!isset($_GET['id'])) {
        header("location:register-visitor");
    }
    $id = $Hash->decrypt($_GET['id']);
    $id_hash = $_GET['id'];

 function check_if($value){
        $Hash = new Encryption();
        $database = new mysqldatabase(DB_NAME);
        if (isset($_GET['id'])) {
            $id = $Hash->decrypt($_GET['id']);
            $id = $database->get_item("visit",'visitor',$id,'id');
            $val = $database->get_item('visit','id',$id,$value);
            return $val;
        }
        else return "";
 }
    ?>
</head>
<body>
<style type="text/css">
    .form-control:focus {
        border-color: inherit;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
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
                        <li id="active"><a href="<?=$_SERVER['REQUEST_URI']?>">Visit details</a></li>
                        <li><a href="register-visitor-step3?id=<?=$id_hash?>">Companions</a></li>
                    </ul>
                </div>
                <div class="tab-content-body">
                    <legend>Registration Form - Step II</legend>
                    <form action="save-visitors.php" method="POST"  id="form">
                        <input type="hidden" name="visit" value="<?=check_if("visit",'visitor',$id,'id')?>">
                        <div class="form-group">
                            <label for="name">Reason For Visiting</label>
                            <input type="text" class="form-control" name="reason" value="<?=check_if("reason")?>"  placeholder="Reason For Visiting">
                        </div>
                        <div class="form-group">
                            <label for="name">Proposed Person/instutition to visit</label>
                            <input type="text" class="form-control" value="<?=check_if("host_person")?>" name="host_person" id="animal" placeholder="Proposed Person/instutition to visit">
                        </div>
                        <input type="hidden" name="visitor" value="<?=$id;?>">
                        <div class="form-group">
                            <label for="name">Date of Arrival</label>
                            <input type="date" class="form-control" value="<?=check_if("arrival")?>" name="arrival" id="arrival" placeholder="Date of Arrival">
                        </div>
                        <div class="form-group">
                            <label for="name">Departure date</label>
                            <input type="date" class="form-control" value="<?=check_if("departure")?>" id="departure" name="departure" placeholder="Departure date">
                        </div>
                        <div class="form-group">
                            <label for="name">Embassy</label>
                            <select class="form-control" id="country" name="embassy">
                                <option id="option"  value="0">No Embassy</option>
                                <?php $st2 = $database->query("SELECT * FROM institution_details WHERE id_institution=2");
                                foreach ($st2 as $key => $value) {?>
                                    <option id="option" <?=check_if("id_embassy")===$value['id']?" selected":""?>  value="<?=$value['id']?>"><?=$value['name']?></option><?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Protocol</label>
                            <input type="text" class="form-control" value="<?=check_if("protocol")?>" name="protocol" placeholder="Protocol">
                        </div>

                        <div class="pull-right">
                            <a class="btn" href="register-visitor?id=<?=$id_hash?>" style="color: white">Previous</a>
                            <button class="btn" type="submit" name="save2">Save and Continue</button>
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
    $("#country option[value=178]").prop('selected', true);
    $(function() {
        $("#form").validate({
            rules: {

                responsible_ministry: "required",
                animal: "required",
                date: "required",
                meeting: "required",
                contact_name: "required",
                benefits: "required",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>