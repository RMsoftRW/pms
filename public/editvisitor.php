<?php require_once("includes/validate_credentials.php"); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<link class="jsbin" href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
<head>
<?php require_once("includes/head.php"); ?>
</head>
<body>
        <?php 
                 $id=$Hash->decrypt($_GET['id']);
                 $stmt = $database->query("SELECT *  FROM diplomats WHERE id = '$id'");
                 $row = $database->fetch_array($stmt);
                  if ($row['photo']=="") {
                    $ipath="images/";
                    $img="default_profile.png";
                    $ad=$ipath.$img;
                  }
                  else{
                    $ipath=" uploads/";
                    $img=$row['photo'];
                    $ad=$ipath.$img;
                }
            
                 ?>
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
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

           
                 <div class="col-lg-9 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">EDIT PHOTO</strong>
                                        <?php  
                                             $values['id']= $row['id'];
                                             echo '<a href="displayperson?id='.$Hash->encrypt($values['id']).'"  style="color:black;" class="pull-right">Back </a>';
                                        ?>
                            </div>
                            <div class="card-body">
                             
                        
                                    <!-- Profile image -->
                                <div class="form-group">
                                   <img id="blah" src="<?php echo $ad; ?>" alt="your image" style="width:160px;height:160px;" /><br/>
                                </div>
                                   <div class="form-group">
                                        <div class="form-line">
                                            <input type='file' onchange="readURL(this,<?php echo $id; ?>);" class="form-control" />
                                        </div>
                                    </div>
                                                   
                            </div>
                        </div>
                    </div>
                </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

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
    <script class="jsbin" src="assets/js/vendor/jquery-1.9.1.js"></script>
    <script class="jsbin" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript">
        function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
            var file_data = input.files[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('id', id);
                $.ajax({
                    url: "changepic",
                    type: "POST",
                    data : form_data,
                    processData: false,
                    contentType: false,
                    
                    success: function(data){

                      alert(data);

                    },

                });
        }
    }
    </script>

</body>
</html>
