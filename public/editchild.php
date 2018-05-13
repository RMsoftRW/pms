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
                 $stmt = $database->query("SELECT *  FROM children WHERE id = '$id'");
                 $row = $database->fetch_array($stmt);
                 $addid= $row['id'];
                 $pic = $row['photo'];
                 $stmtadd = $database->query("SELECT *  FROM add_info_amb WHERE id_ambassador = '$addid'");
                 $rowadd = $database->fetch_array($stmtadd);
                 $emid= $rowadd['id_embassy'];
                 $stmtiem = $database->query("SELECT *  FROM institution_details WHERE id = '$emid'");
                 $rowiem = $database->fetch_array($stmtiem);
                 $nab=$row['nob'];
                 $nap=$row['nop'];
                 $stmnab = $database->query("SELECT *  FROM countries WHERE id = '$nab' ");
                 $rownab = $database->fetch_array($stmnab);
                 $stmnap = $database->query("SELECT *  FROM countries WHERE id = '$nap' ");
                 $rownap = $database->fetch_array($stmnap);
                 
                 
             ?>
             <?php 
                    if(isset($_POST['submit'])){
                        $given_names = $_POST['given_names'];
                        $family_names = $_POST['family_names'];
                        $other_names = $_POST['other_names'];
                        $gender = $_POST['gender'];
                        $dob = $_POST['dob'];
                        $pob = $_POST['pob'];
                        $nob = $_POST['nob'];
                        $email = $_POST['email'];
                        $telephone = $_POST['telephone'];
                        $pass_no = $_POST['pass_no'];
                        $nop = $_POST['nop'];
                        $doi = $_POST['doi'];
                        $doe = $_POST['doe'];
                        $profession = $_POST['profession'];
                        $occupation = $_POST['occupation'];
                        $employer = $_POST['employer'];
                        $school = $_POST['school'];
                       
            $stmts = $database->query("UPDATE children SET 
                given_names = '$given_names', 
                family_names = '$family_names', 
                other_names = '$other_names', 
                gender = '$gender',
                dob = '$dob',
                pob = '$pob', 
                nob = '$nob',
                email = '$email',
                telephone = '$telephone',
                pass_no = '$pass_no',
                nop = '$nop',
                doi = '$doi',
                doe = '$doe',
                profession = '$profession',
                occupation = '$occupation',
                employer = '$employer',
                school = '$school'
               
                WHERE id = '$id'") ;
                $value['id']= $row['parent'];
                header('Location: displayperson?id='.$Hash->encrypt($value['id']).'');
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
                                <strong class="card-title">EDIT Child Information</strong>
                                        <?php  
                                             $values['id']= $row['parent'];
                                             echo '<a href="displayperson?id='.$Hash->encrypt($values['id']).'"  style="color:black;" class="pull-right">Back </a>';
                                        ?>
                            </div>
                            <div class="card-body">
                             <div class="default-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="basic-info-tab" data-toggle="tab" href="#basic-info" role="tab" aria-controls="basic-info" aria-selected="true">Basic Information</a>
                                              
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                        <!-- basic info tab -->
                                            <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                        
                                               
                                                   <form action='' method='post' name="form">
                                                        <label for="name">Given Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="given_names" 
                                                                    class="form-control" name="given_names" value='<?php echo $row['given_names'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Family Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="family_names" 
                                                                    class="form-control" name="family_names" value='<?php echo $row['family_names'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Other Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="other_names" 
                                                                    class="form-control" name="other_names" value='<?php echo $row['other_names'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Gender</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="gender">
                                                                            <?php 
                                                                                echo'<option value='.$row['gender'].'>'.$row['gender'].'</option>';
                                                                             ?>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="dob" 
                                                                    class="form-control" name="dob" value='<?php echo $row['dob'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Place of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="pob" 
                                                                    class="form-control" name="pob" value='<?php echo $row['pob'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Nationality of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="nob">
                                                                           <?php 
                                                                              $stmtcntry = $database->query("SELECT * FROM countries");
                                                                              echo'<option value='.$rownab['id'].'>'.$rownab['nicename'].'</option>';
                                                                              while ($rowcntry = $database->fetch_array($stmtcntry)) {
                                                                              echo ' <option value='.$rowcntry['id'].'>'.$rowcntry['nicename'].'</option>';

                                                                               }
                                                                           ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <label for="name">Email</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="email" 
                                                                    class="form-control" name="email" value='<?php echo $row['email'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Telphone</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="telephone" 
                                                                    class="form-control" name="telephone" value='<?php echo $row['telephone'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Passport Number</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="pass_no" 
                                                                    class="form-control" name="pass_no" value='<?php echo $row['pass_no'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Nationality on Passport</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="nop">
                                                                           <?php 
                                                                              $stmtcntryl = $database->query("SELECT * FROM countries");
                                                                              echo'<option value='.$rownap['id'].'>'.$rownap['nicename'].'</option>';
                                                                              while ($rowcntryl = $database->fetch_array($stmtcntryl)) {
                                                                              echo ' <option value='.$rowcntryl['id'].'>'.$rowcntryl['nicename'].'</option>';

                                                                              }
                                                                           ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Issue</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="doi" 
                                                                    class="form-control" name="doi" value='<?php echo $row['doi'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Expiry</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="doe" 
                                                                    class="form-control" name="doe" value='<?php echo $row['doe'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Profession</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="profession" 
                                                                    class="form-control" name="profession" value='<?php echo $row['profession'];?>'>
                                                                </div>
                                                            </div>

                                                            <label for="name">School</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="school" 
                                                                    class="form-control" name="school" value='<?php echo $row['school'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Job title</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="occupation" 
                                                                    class="form-control" name="occupation" value='<?php echo $row['occupation'];?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Company/organization</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="employer" 
                                                                    class="form-control" name="employer" value='<?php echo $row['employer'];?>'>
                                                                </div>
                                                            </div>

                                                       

                                                        <div class="form-group">
                                                                    <div class="form-line">
                                                                      <input type='submit' name='submit' value='Update' class="btn btn-primary ">
                                                                    </div>
                                                            </div>
                                                    </form>
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
