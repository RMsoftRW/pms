<?php require_once("includes/validate_credentials.php"); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
<?php require_once("includes/head.php"); ?>
</head>
<body>
<?php 
                $id=$Hash->decrypt($_GET['id']);
                $stmt = $database->query("SELECT *  FROM diplomats WHERE id = '$id'");
                $row = $database->fetch_array($stmt);
                $user= $_SESSION['username'];
                $stmtu = $database->query("SELECT *  FROM user WHERE username = '$user'");
                $rowu = $database->fetch_array($stmtu);
    
      // add a comment
     if(isset($_POST['send'])){
        $user_id= $rowu['id'];
        $_POST = array_map( 'stripslashes', $_POST );

        //collect form data
        extract($_POST);

        

        if(!isset($error)){

            try {

                $owner = $row['id'];
                $cmt = $database->escape_value($comment);
                //insert into database
                $stmtca = $database->query("INSERT INTO comments (user,comment,attachment,owner,owner_type)
                 VALUES ('$user_id', '$cmt', '$attachment', '$owner','2')") ;
                

                   
                //redirect to displayperson page
                $valuered['id']=$row['id'];
                header('Location: displayperson?id='.$Hash->encrypt($valuered['id']).'');
                exit;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }
   
    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="error">'.$error.'</p>';
        }
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
        <!-- displaypersoning institution basic info -->
        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                <?php 
                                   
                                      if ($row['type']== 2) {
                                        $title = "Ambassador";
                                      }
                                      if ($row['type']== 3) {
                                         $title = "Foreign Diplomat";
                                      }
                                      if ($row['type']== 4) {
                                         $title = "Rwandan Diplomat";
                                      }
                                      if ($row['type']== 5) {
                                         $title = "Visitor";
                                      }

                                 ?>
                                  <h4><?php echo $title; ?>'s Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="default-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="basic-info-tab" data-toggle="tab" href="#basic-info" role="tab" aria-controls="basic-info" aria-selected="true">Basic Information</a>
                                                <a class="nav-item nav-link" id="visit-tab" data-toggle="tab" href="#visit" role="tab" aria-controls="visit" aria-selected="false">Visit Details</a>
                                                <a class="nav-item nav-link" id="comp-tab" data-toggle="tab" href="#comp" role="tab" aria-controls="comp" aria-selected="false">Companions</a>
                                     
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                        <!-- basic info tab -->
                                            <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                                              <ul class="list-group list-group-flush">
                                                     <?php 
                                                         $nob = $database->get_item('countries','id' , $row['nob'],'nicename');
                                                         $nop = $database->get_item('countries','id' , $row['nop'],'nicename');
                                                         $fnat = $database->get_item('countries','id' , $row['father_nat'],'nicename');
                                                         $mnat = $database->get_item('countries','id' , $row['mother_nat'],'nicename');

                                                          $value['id']= $row['id'];
                                                          $pob=$row['pob'];
                                                          $im=$row['photo'];
                                                              if ($row['photo']=="" || !file_exists("uploads/'.$im.'")) {
                                                                $ipath="images/";
                                                                $img="default_profile.png";
                                                              }
                                                              else{
                                                                $ipath="uploads/";
                                                                $img=$row['photo'];
                                                              }
                                                            echo '
                                                                  <li class="list-group-item">
                                                                      <div style="border: 1px solid black;width:160px;height:160px;margin-bottom:10px;">
                                                                        <img src="'.$ipath.''.$img.'" style="width:160px;height:160px;">

                                                                      </div>
                                                                      <a href="editvisitor?id='.$Hash->encrypt($value['id']).'" class="btn btn-secondary">Edit Photo</a>
                                                                  </li>
                                                               <li class="list-group-item"><b>Given Names:</b> '.$row['given_names'].'</li>
                                                                       <li class="list-group-item"><b>Family Names:</b> '.$row['family_names'].'</li>
                                                                       <li class="list-group-item"><b>Other Names:</b> '.$row['other_names'].'</li>
                                                                       <li class="list-group-item"><b>Gender:</b> '.$row['gender'].'</li>
                                                                       <li class="list-group-item"><b>Date of birth:</b> '.$row['dob'].'</li>
                                                                       <li class="list-group-item"><b>Place of birth:</b> '.$row['pob'].'</li>
                                                                       <li class="list-group-item"><b>Nationality of birth:</b> '.$nob.'</li>
                                                                       <li class="list-group-item"><b>Email:</b> '.$row['email'].'</li>
                                                                       <li class="list-group-item"><b>Telephone:</b> '.$row['telephone'].'</li>
                                                                       <li class="list-group-item"><b>Passport Number:</b> '.$row['pass_no'].'</li>
                                                                       <li class="list-group-item"><b>Nationality on Passport:</b> '.$nop.'</li>
                                                                       <li class="list-group-item"><b>Date of Issue of Passport:</b> '.$row['doi'].'</li>
                                                                       <li class="list-group-item"><b>Date of Expiry of Passport:</b> '.$row['doe'].'</li>
                                                                       <li class="list-group-item"><b>Profession:</b> '.$row['profession'].'</li>
                                                                       <li class="list-group-item"><b>Occupation:</b> '.$row['occupation'].'</li>
                                                                       <li class="list-group-item"><b>Employer:</b> '.$row['employer'].'</li>
                                                                       <li class="list-group-item"><b>Father\'s Name:</b> '.$row['father_name'].'</li>
                                                                       <li class="list-group-item"><b>Father\'s Nationality:</b> '.$fnat.'</li>
                                                                       <li class="list-group-item"><b>Mother\'s Name:</b> '.$row['mother_name'].'</li>
                                                                       <li class="list-group-item"><b>Mother\'s Nationality:</b> '.$mnat.'</li>
                                                                       <li class="list-group-item"><b>Marital Status:</b> '.$row['marital_status'].'</li>
                                                                       
                                                                  ';
                                                                  if ($row['marital_status']== "Married") {
                                                                    echo '<li class="list-group-item"><b>Spouse:</b> '.$row['spouse'].'</li>
                                                                       ';
                                                                  }
                                                                  echo '<li class="list-group-item"><a href="register-visitor?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                     <button type="button" class="btn btn-secondary">Edit</button></a></li>';
                                                         
                                              ?>
                                              </ul>
                                            </div>
                                            
                                            <!-- visit details -->
                                             <div class="tab-pane fade" id="visit" role="tabpanel" aria-labelledby="vist-tab">
                                                      <ul class="list-group list-group-flush">
                                                          <?php  
                                                               
                                                                $v_id= $row['visit_details'];
                                                                $stmtv = $database->query("SELECT * FROM visit WHERE id = '$v_id' ");
                                                                $num=$database->num_rows($stmtv);
                                                                $rowv = $database->fetch_array($stmtv);
                                                                $em= $rowv['id_embassy'];
                                                                $stmtem = $database->query("SELECT * FROM institution_details WHERE id = '$em' ");
                                                                $rowem = $database->fetch_array($stmtem);
                                                                if ($num != 0) {
                                                                 
                                                                        echo '

                                                                                 <li class="list-group-item"><b>Reson:</b> '.$rowv['reason'].'</li>
                                                                                 <li class="list-group-item"><b>Host Person:</b> '.$rowv['host_person'].'</li>
                                                                                 <li class="list-group-item"><b>Arrival Date:</b> '.$rowv['arrival'].'</li>
                                                                                 <li class="list-group-item"><b>Depature Date:</b> '.$rowv['departure'].'</li>
                                                                                 <li class="list-group-item"><b>Embassy:</b> '.$rowem['name'].'</li>
                                                                                 <li class="list-group-item"><b>Protocol:</b> '.$rowv['protocol'].'</li>
                                                                                 <li class="list-group-item"><a href="register-visitor-step2?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                               <button type="button" class="btn btn-secondary">Edit</button></a></li>

                                                                            ';
                                                                           
                                                                    
                                                                }
                                                                else{
                                                                    
                                                                    echo "<b>No Details</b>";
                                                                }
                                                             
                                                               
                                                   ?>
                                                </ul>
                                              </div>
                                              <!-- companion details -->
                                              <div class="tab-pane fade" id="comp" role="tabpanel" aria-labelledby="comp-tab">
                                                      <ul class="list-group list-group-flush">
                                                          <?php  
                                                               
                                                                $vc_id= $row['id'];
                                                                $stmtvc = $database->query("SELECT * FROM companion WHERE visitor = '$vc_id' ");
                                                                $numc=$database->num_rows($stmtvc);
                                                                $cntc=1;
                                                                if ($num != 0) {
                                                                  while ($rowvc = $database->fetch_array($stmtvc)){
                                                                            $value['id']=$rowvc['id'];
                                                                        echo '
                                                                                 <li class="list-group-item">Person'.$cntc.'.</li>
                                                                                 <li class="list-group-item"><b>Names:</b> '.$rowvc['names'].'</li>
                                                                                 <li class="list-group-item"><b>Gender:</b> '.$rowvc['gender'].'</li>
                                                                                 <li class="list-group-item"><b>Date of Birth:</b> '.$rowvc['dob'].'</li>
                                                                                 <li class="list-group-item"><a href="editcompanion?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                                 <button type="button" class="btn btn-secondary">Edit</button></a></li>

                                                                            ';
                                                                            $cntc=$cntc+1;
                                                                           }
                                                                           echo '';
                                                                    
                                                                }
                                                                else{
                                                                    
                                                                    echo "<b>No Details</b>";
                                                                }
                                                             
                                                               
                                                   ?>
                                                </ul>
                                              </div>  
                                       
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                      <!-- Comments section -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Comments</h4>
                                </div>
                                <div class="card-body">
                                  <form action='' method='post' name="form">
                                 <div class="form-line">
                                 <div class="form-group">
                                <label >Comment</label>
                                <textarea class="form-control" name='comment' cols='10' rows='5'><?php if(isset($error)){ echo $_POST['comment'];}?></textarea>
                                </div>
                                </div>
                                <label >Attachment</label>
                                <div class="form-group">
                                        <div class="form-line">
                                            <input type='file' class="form-control" name="attachment" />
                                        </div>
                                    </div>
                                <input type='submit' name='send' value='Send' class="btn btn-primary ">
                            </form>
                            <!--  comments -->
                            <ul class="list-group list-group-flush card-body">
                              <?php 
                                                
                                                 $cmnt_id= $Hash->decrypt($_GET['id']);
                                                 $stmtc = $database->query("SELECT * FROM comments WHERE owner = '$cmnt_id' AND status ='1' AND owner_type = '2' ");
                                                 $nums=$database->num_rows($stmtc);

                                                 if ($nums != 0) {
                                                      
                                                      while ($rowcmnt = $database->fetch_array($stmtc)) {
                                                      $usernm = $database->get_item('user','id' , $rowcmnt['user'],'username');
                                                      $valuecmnt['id']=$rowcmnt['id'];
                                                      
                                                      echo '

                                                              <li class="list-group-item"><b>User:</b> '.$usernm.'<br/>
                                                             <b>Comment:</b> '.$rowcmnt['comment'].'<br/>
                                                             
                                                            

                                                              ';
                                                              if ($user==$usernm) {
                                                                echo ' <a href="editcomment?id='.$Hash->encrypt($valuecmnt['id']).'">Edit</a>';
                                                              }
                                                              echo ' </li>';
                                                              
                                                          }
                                                          
                                                      }
                                                      else{
                                                          
                                                          echo "<b>No Comments</b>";
                                                      }
                                                 
                                                    
                                                 ?>
                                          </ul>
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
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script class="jsbin" src="assets/js/vendor/jquery-1.9.1.js"></script>
    <script class="jsbin" src="js/jquery-ui.min.js"></script>
    

</body>
</html>
