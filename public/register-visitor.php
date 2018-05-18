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

    function check_if($value){
      $Hash = new Encryption();
      $database = new mysqldatabase(DB_NAME);
        if (isset($_GET['id'])) {
            $id = $Hash->decrypt($_GET['id']);
            $val = $database->get_item('diplomats','id',$id,$value);
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
    .error{
      color: maroon;
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
#small{margin-left: 5%}

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
                        <li id="active"><a href="<?=$_SERVER['REQUEST_URI']?>">Visit Form</a></li>
                         <?php if (isset($_GET['id'])) { $id =$_GET['id'];?>
                        <li><a href="register-visitor-step2?id=<?=$id?>">Visit Details</a></li>
                             <li><a href="register-visitor-step3?id=<?=$id?>">Companions</a></li>
                        <?php } else{?>
                        <li><a href="register-visitor-step2">Visit Details</a></li>
                        <li><a href="register-visitor-step3">Companions</a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="tab-content-body">
                    <legend>Registration Form  for Visitors</legend>
                    <form action="save-visitors.php" method="POST" id="form">
                        <?php if (isset($_GET['id'])){$id = $Hash->decrypt($_GET['id']);?>
                            <input type="hidden" name="update" value="<?=$id?>"><?php }?>
                  <div class="form-group">
                    <label for="name">Given Names<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" id="gname" name="given_names" placeholder="Enter Given Names" minlength="4" value="<?=check_if('given_names');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Family Names<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" name="family_names" id="family" placeholder="Enter Family Names" minlength="4" value="<?=check_if('family_names');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Other Names</label>
                    <input type="text" class="form-control" name="other_names" id="other" placeholder="Enter Other Names" value="<?=check_if('other_names');?>">
                  </div>
                        <div class="form-group">
                            <label for="gender">Gender<span class="required-mark">*</span></label>
                            <select name="gender" class="form-control" id="gender">
                                <option value="0">SELECT GENDER</option>
                                <option value="Male" <?=check_if("marital_status")==="Male"?" selected":""?>>Male</option>
                                <option value="Female" <?=check_if("marital_status")==="Female"?" selected":""?>>Female</option>
                            </select>

                        </div>
                  <input type="hidden" name="institution" value="4">
                  <div class="form-group">
                    <label for="contact_phone">Date of Birth<span class="required-mark">*</span></label>
                    <input type="date" class="form-control" id="contact_phone" placeholder="Enter Date of Birth" name="dob" value="<?=check_if('dob');?>">
                  </div>


                  <div class="form-group">
                    <label for="contact_name">Place of Birth<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" id="pob" placeholder="Enter Place Of Birth" name="pob" value="<?=check_if('pob');?>">
                  </div>
                  <div class="form-group">
                    <label for="country">Nationality Of Birth<span class="required-mark">*</span></label>
                        <select class="form-control" id="country" name="nob">
                        <option value="0">SELECT NATIONALITY</option>
                    <?php $st2 = $database->query("SELECT * FROM countries"); 
                    foreach ($st2 as $key => $value) {?>
                        <option id="option" value="<?=$value['id']?>" <?=check_if("nob")===$value['id']?" selected":""?>><?=$value['name']?></option><?php } ?>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="location"> Email<span class="required-mark">*</span></label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?=check_if('email');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Telephone</label>
                    <input type="text" class="form-control" name="telephone" id="telephone" placeholder="telephone"  value="<?=check_if('telephone');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Passport No<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" name="pass_no" id="pass" placeholder="Enter passport No"  value="<?=check_if('pass_no');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Nationality of Passport<span class="required-mark">*</span></label>
                      <select class="form-control" id="country" name="nop">
                          <option value="0">SELECT NATIONALITY</option>
                          <?php $st2 = $database->query("SELECT * FROM countries");
                          foreach ($st2 as $key => $value) {?>
                              <option id="option" value="<?=$value['id']?>" <?=check_if("nop")===$value['id']?" selected":""?>><?=$value['name']?></option><?php } ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Date of Issue of Passport<span class="required-mark">*</span></label>
                    <input type="date" class="form-control" name="doi" id="doi" placeholder="Date of Issue of Transport"  value="<?=check_if('doi');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Expiry Date<span class="required-mark">*</span></label>
                    <input type="date" class="form-control" name="doe" id="doe" placeholder="Expiry date"  value="<?=check_if('doe');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Profession<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" name="profession" id="profession" placeholder="profession"  value="<?=check_if('profession');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">occupation<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" name="occupation" id="occupation" placeholder="occupation" value="<?=check_if('occupation');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Employer<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" name="employer" id="employer" placeholder="Employer"  value="<?=check_if('employer');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Father's Name<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" name="father_name" id="fathern" placeholder="Father's Name" minlength="4" value="<?=check_if('father_name');?>">
                  </div>
                  <div class="form-group">
                    <label for="name">Father's Nationality<span class="required-mark">*</span></label>
                      <select class="form-control" id="country" name="father_nat">
                          <option value="0">SELECT NATIONALITY</option>
                          <?php $st2 = $database->query("SELECT * FROM countries");
                          foreach ($st2 as $key => $value) {?>
                              <option id="option" value="<?=$value['id']?>" <?=check_if("father_nat")===$value['id']?" selected":""?> ><?=$value['name']?></option><?php } ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Mother's Names<span class="required-mark">*</span></label>
                    <input type="text" class="form-control" name="mother_name" id="fassmily" placeholder="Mother's Names" minlength="4" value="<?=check_if('mother_name');?>">
                  </div>
                        <div class="form-group">
                            <label for="name">Mother's Nationality<span class="required-mark">*</span></label>
                            <select class="form-control" id="country" name="mother_nat">
                                <option value="0">SELECT NATIONALITY</option>
                                <?php $st2 = $database->query("SELECT * FROM countries");
                                foreach ($st2 as $key => $value) {?>
                                    <option id="option" value="<?=$value['id']?>" <?=check_if("mother_nat")===$value['id']?" selected":""?>><?=$value['name']?></option><?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Malital Status<span class="required-mark">*</span></label>
                            <select class="form-control" id="mat" name="marital_status">
                                <option value="0">SELECT MALITAL STATUS</option>
                                <option id="option" value="Married" <?=check_if("marital_status")==="Married"?" selected":""?>>Married</option>
                                <option id="option" value="Single" <?=check_if("marital_status")==="Single"?" selected":""?>>Single</option>
                                <option id="option" value="Divorced" <?=check_if("marital_status")==="Divorced"?" selected":""?>>Divorced</option>
                            </select>
                        </div>
                  <div>
                    <button  type="submit" name="save1" class="btn pull-right">Save and Continue</button>
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
    // $("#country option[value=178]").prop('selected', true);
    $(function() {

        $.validator.addMethod("phoneCheck",function (value) {
            return /^\+?\d{10,13}$/.test(value) || value ==="";
        },' Enter a valid Phone number');
        $.validator.addMethod("validStatus", function (value,element,arg) {
            return arg !== value;
        }, "");
    $("#form").validate({
      rules: {
          given_names: "required",
          family_names:"required",
          dob: "required",
          gender : {validStatus: "0"},
          nop : {validStatus: "0"},
          nob : {validStatus: "0"},
          mother_nat:{validStatus: "0"},
          father_nat : {validStatus: "0"},
          pass_no: "required",
          pob: "required",
          telephone: {
              phoneCheck : true
          },
          mother_name: "required",
          father_name: "required",
          email: {
              required: true,
              email: true
          },
          pass_no:"required",
          doi:"required",
          doe:"required",
          father_name:"required",
          mather_name:"required",
          marital_status:{validStatus: "0"}
      },

      messages : {father_nat :"Please enter a valid Country",
                  nop :"Please enter a valid Country",
                  nob :"Please enter a valid Country",
                  mather_nat :"Please enter a valid Country",
                  gender : "Please select a Valid gender",
                  marital_status:"Please select a valid Status",
      },

      submitHandler: function(form) {
        form.submit();
      }
    });
    });
  
</script>
<script type="text/javascript">
    $(document.body).on('change',"#mat",function (e) {
        var optVal= $("#mat option:selected").val();
        if (optVal !== 'Married'){
            $('#spouse').hide();
            $('#lmat').hide();
            $('#spouse').val('');
        }
        else{
            $('#spouse').show();
            $('#lmat').show();
        }
    });
</script>