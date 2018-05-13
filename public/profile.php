<?php require_once("includes/validate_credentials.php"); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php require_once("includes/head.php"); ?>
    <style type="text/css">
        .user-box {
            width: 200px;
            border-radius: 0 0 3px 3px;
            padding: 10px;
            position: relative;
        }
        .user-box .name {
            word-break: break-all;
            padding: 10px 10px 10px 10px;
            background: #EEEEEE;
            text-align: center;
            font-size: 20px;
        }
        .user-box form{display: inline;}
        .user-box .name h4{margin: 0;}
        .user-box img#imagePreview{width: 100%;}

        .editLink {
            position:absolute;
            top:28px;
            right:10px;
            opacity:0;
            transition: all 0.3s ease-in-out 0s;
            -mox-transition: all 0.3s ease-in-out 0s;
            -webkit-transition: all 0.3s ease-in-out 0s;
            background:rgba(255,255,255,0.2);
        }
        .img-relative:hover .editLink{opacity:1;}
        .overlay{
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
            background: rgba(255,255,255,0.7);
        }
        .overlay-content {
            position: absolute;
            transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            top: 50%;
            left: 0;
            right: 0;
            text-align: center;
            color: #555;
        }
        .uploadProcess img{
            max-width: 207px;
            border: none;
            box-shadow: none;
            -webkit-border-radius: 0;
            display: inline;
        }
    </style>
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
                        <li><a href="">Users</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">

        <div class="animated fadeIn">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Your Profile</strong>
                        </div>
                        <?php
                        $sql = "SELECT * FROM user WHERE username ='{$_SESSION["username"]}' AND id='{$_SESSION["id"]}' AND active='1' LIMIT 1";
                        $query = $database->query($sql);
                        $user=$database->fetch_array($query);
                        $u=$_SESSION["username"];
                        $avatar=$user["avatar"];

                        if( $avatar== NULL || !file_exists("../uploads/users/$u/$avatar")){
                            $profile_pic = "images/default_profile.png";
                        }
                        else{
                            $profile_pic = '../uploads/users/'.$u.'/'.$avatar.'" alt="'.$u;
                        }
                        ?>
                        <div class="card-body">
                            <div id="register_div">
                                <div class="card-body">

                                    <form id="profile"   onsubmit="return false" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <div class="row form-group">
                                                    <div class=" col-md-3">
                                                        <label class="form-label">First Name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static" name="firstname" id="firstname"><?php echo $user["fname"]; ?></p>

                                                    </div>
                                                </div>
                                                <?php if($user["mname"] !="") {?>
                                                    <div class=" row form-group">
                                                        <div class=" col-md-3">
                                                            <label class="form-label">Middle name</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static" name="middlename" id="middlename"><?php echo $user["mname"]; ?></p>

                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="row form-group">
                                                    <div class=" col-md-3">
                                                        <label class="form-label">Last Name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static" name="lastname" id="lastname"><?php echo $user["lname"]; ?></p>

                                                    </div>


                                                </div>
                                                <div class="row form-group">
                                                    <div class=" col-md-3">
                                                        <label class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static"   name="email" id="email" ><?php echo $user["email"]; ?></p>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class=" col-md-3">
                                                        <label class="form-label">Username</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p type="text" class="form-control-static"   name="username"  id="username"><?php echo $user["username"]; ?></p>
                                                    </div>

                                                </div>
                                                <span id="status"></span>
                                                <div>
                                                    <a class="btn btn-md btn-info" href="update-profile" name="update_profile" id="update_profile" role="button">Update your profile</a>
                                                    <button id="passwrdbtn" type="submit" class="btn btn-md btn-info" data-toggle="modal" data-target="#changepass">
                                                        Change Password
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-4">

                                                    <div class="user-box">
                                                        <div class="img-relative">
                                                            <!-- Loading image -->
                                                            <div class="overlay uploadProcess" style="display: none;">
                                                                <div class="overlay-content"><img src="images/loading.gif"/></div>
                                                            </div>
                                                            <!-- Hidden upload form -->
                                                            <form method="post" onsubmit="return false" enctype="multipart/form-data" id="picUploadForm" target="uploadTarget">
                                                                <input type="file" name="picture" id="fileInput"  style="display:none"/>
                                                            </form>
                                                            <iframe id="uploadTarget" name="uploadTarget" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                                                            <!-- Image update link -->
                                                            <a class="editLink" href="javascript:void(0);"><img src="images/edit.png"/></a>
                                                            <!-- Profile image -->
                                                            <img src="<?php echo $profile_pic; ?>" id="imagePreview">
                                                        </div>

                                                    </div>
                                                                                       </div>



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
    <div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Change password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return false" method='post' name="form">
                        <label >Current password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="cpass" class="form-control" name="cpass" autocomplete="off">
                            </div>
                        </div>
                        <label >New password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="p1" class="form-control" name="p1" autocomplete="off">
                            </div>
                        </div>
                        <label >Confirm New password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="p2" class="form-control" name="p2" autocomplete="off">
                            </div>
                        </div>

                    </form>
                    <span id="error"></span>
                </div>
                <div class="modal-footer">
                    <button type='submit' class="btn btn-primary " onclick="password(<?php echo $_SESSION["id"]; ?> )">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>

</div><!-- /#right-panel -->

<!-- Right Panel -->


<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script src="js/ajax.js"></script>
<script src="assets/js/vendor/jquery-1.11.3.min.js"></script>
<script>
    function toggleElement(x){
        var x = _(x);
        if(x.style.display == 'block'){
            x.style.display = 'none';
        }else{
            x.style.display = 'block';
        }
    }

    function password(id) {
        var p=_("cpass").value;
        var p1=_("p1").value;
        var p2=_("p2").value;
        if(p1!=p2){
            _('error').innerHTML="<span style='color: red'>Password don't march!</span>";
        }
        else if(p=="" || p2=="" || p1==""){
            _('error').innerHTML="<span style='color: red'>Fill all Field</span>";
        }
        else{
            var ajax = ajaxObj("POST", "addUser.php");
            ajax.onreadystatechange = function() {
                if(ajaxReturn(ajax) == true) {
                    if(ajax.responseText == "invalid"){
                        _('error').innerHTML="<span style='color: red'>Invalid current password</span>";
                    } else if(ajax.responseText == "updated") {
                        _('error').innerHTML="<span style='color: green'>Updated!</span>";
                        _("changepass").modal("hide");

                    }
                }
            };
            ajax.send("p="+p+"&p1="+p1+"&id="+id+"&change=password");


        }


    }
    $(document).ready(function () {
        //If image edit link is clicked
        $(".editLink").on('click', function(e){
            e.preventDefault();
            $("#fileInput:hidden").trigger('click');
        });

        //On select file to upload
        $("#fileInput").on('change', function(){
            var image = $('#fileInput').val();
            var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            //validate file type
            if(!img_ex.exec(image)){
                alert('Please upload only .jpg/.jpeg/.png/.gif file.');
                $('#fileInput').val('');
                return false;
            }else{
                // $('.uploadProcess').show();
                $('#uploadForm').hide();
                //$( "#picUploadForm" ).submit();
                var file_data = $('#fileInput').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajax({
                    url: "upload.php",
                    type: "POST",
                    data : form_data,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.uploadProcess').show();
                    },
                    success: function(data){

                        $('#imagePreview').attr("src", "");
                        $('#imagePreview').attr("src", data);
                        $('#fileInput').attr("value", data);
                        $('.uploadProcess').hide();


                    },

                });

            }
        });

    });

    //After completion of image upload process
    function completeUpload(fileName) {

        $('#imagePreview').attr("src", "");
        $('#imagePreview').attr("src", fileName);
        $('#fileInput').attr("value", fileName);
        $('.uploadProcess').hide();
        return true;
    }
</script>


</body>
</html>