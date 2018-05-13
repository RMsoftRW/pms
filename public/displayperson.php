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
            // save new car

                if(isset($_POST['savec'])){

                  $_POST = array_map( 'stripslashes', $_POST );

                  //collect form data
                  extract($_POST);

                  

                  if(!isset($error)){

                      try {

                          $plt = $database->escape_value($plate_nber);
                          $mdl = $database->escape_value($model);
                          $insc = $database->escape_value($insurance_camp);

                          $owner = $row['id'];

                          //insert into database
                          $stmtca = $database->query("INSERT INTO cars (plate_nber,model,insurance_camp,owner,owner_type)
                          VALUES ('$plt', '$mdl', '$insc', '$owner', '2')") ;
                          

                             
                          //redirect to display page
                          $values['id']=$row['id'];
                          header('Location: displayperson?id='. $Hash->encrypt($values['id']).'');
                          exit;

                      } catch(PDOException $e) {
                          echo $e->getMessage();
                      }

                  }

            }
    // save new house
    if(isset($_POST['saveh'])){

        $_POST = array_map( 'stripslashes', $_POST );

        //collect form data
        extract($_POST);

        

        if(!isset($error)){
          $tp = $database->escape_value($type);
          $loc = $database->escape_value($location);

            try {
                $owner = $row['id'];
                //insert into database
                $stmtca = $database->query("INSERT INTO houses (type,owner,location, owner_type) VALUES ('$tp', '$owner', '$loc', '2')");
             
                //redirect to displayperson page
                $values['id']=$row['id'];
                header('Location: displayperson?id='. $Hash->encrypt($values['id']).'');
                exit;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }
    
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
                 VALUES ('$user_id', '$cmt', $attachment, '$owner','2')") ;
                

                   
                //redirect to displayperson page
                $valuered['id']=$row['id'];
                header('Location: displayperson?id='.$Hash->encrypt($valuered['id']).'');
                exit;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }

    }
    // save spouse
    if(isset($_POST['spouse'])){
                        $patner= $Hash->decrypt($_GET['id']);
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
                        $father_name = $_POST['father_name'];
                        $father_nat = $_POST['father_nat'];
                        $mother_name = $_POST['mother_name'];
                        $mother_nat = $_POST['mother_nat'];
                        $marital_status = $_POST['marital_status'];
                        $spouse = $_POST['spouse'];
            $stmts = $database->query("INSERT INTO spouse (  
                given_names, 
                family_names, 
                other_names, 
                gender,
                dob,
                pob, 
                nob,
                email,
                telephone,
                pass_no,
                nop,
                doi,
                doe,
                profession,
                occupation,
                employer,
                father_name,
                father_nat,
                mother_name,
                mother_nat,
                patner
                )
            VALUES ('$given_names', 
                '$family_names', 
                '$other_names', 
                '$gender',
                '$dob',
                '$pob', 
                '$nob',
                '$email',
                '$telephone',
                '$pass_no',
                '$nop',
                '$doi',
                '$doe',
                '$profession',
                '$occupation',
                '$employer',
                '$father_name',
                '$father_nat',
                '$mother_name',
                '$mother_nat',
                '$patner'
               )
                ") ;
                $value['id']= $id;
                header('Location: displayperson?id='.$Hash->encrypt($value['id']).'');
            }
    // save child
    if(isset($_POST['child'])){
                        $parent= $Hash->decrypt($_GET['id']);
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
            $stmts = $database->query("INSERT INTO children (  
                given_names, 
                family_names, 
                other_names, 
                gender,
                dob,
                pob, 
                nob,
                email,
                telephone,
                pass_no,
                nop,
                doi,
                doe,
                profession,
                occupation,
                employer,
                parent,
                school
                )
            VALUES ('$given_names', 
                '$family_names', 
                '$other_names', 
                '$gender',
                '$dob',
                '$pob', 
                '$nob',
                '$email',
                '$telephone',
                '$pass_no',
                '$nop',
                '$doi',
                '$doe',
                '$profession',
                '$occupation',
                '$employer',
                '$parent'.
                '$school'
               )
                ") ;
                $value['id']= $id;
                header('Location: displayperson?id='.$Hash->encrypt($value['id']).'');
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
                                    <h4><?php echo $row['type']; ?>'s Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="default-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="basic-info-tab" data-toggle="tab" href="#basic-info" role="tab" aria-controls="basic-info" aria-selected="true">Basic Information</a>
                                                <?php 
                                                  if ($row['type']!= "visitor") {
                                                    if ($row['type']== "ambassador") {
                                                       if ($row['marital_status']!= "single"){
                                                              echo '
                                                                <a class="nav-item nav-link" id="spouse-tab" data-toggle="tab" href="#spouse" role="tab" aria-controls="spouse" aria-selected="false">Spouse</a>
                                                          ';
                                                       }
                                                         echo '
                                                                <a class="nav-item nav-link" id="children-tab" data-toggle="tab" href="#children" role="tab" aria-controls="children" aria-selected="false">Children</a>
                                                                <a class="nav-item nav-link" id="add_info-tab" data-toggle="tab" href="#add_info" role="tab" aria-controls="add_info" aria-selected="false">Additional Details</a>
                                                          ';
                                                        }
                                                    echo '
                                                          <a class="nav-item nav-link" id="cars-tab" data-toggle="tab" href="#cars" role="tab" aria-controls="cars" aria-selected="false">Cars</a>
                                                          <a class="nav-item nav-link" id="houses-tab" data-toggle="tab" href="#houses" role="tab" aria-controls="houses" aria-selected="false">Houses</a>
                                                    ';

                                                  }
                                                  elseif ($row['type']== "visitor") {
                                                   echo '
                                                          <a class="nav-item nav-link" id="visit-tab" data-toggle="tab" href="#visit" role="tab" aria-controls="visit" aria-selected="false">Visit Details</a>
                                                          <a class="nav-item nav-link" id="comp-tab" data-toggle="tab" href="#comp" role="tab" aria-controls="comp" aria-selected="false">Companions</a>
                                                    ';
                                                  }
                                                  
                                                 ?>
                                               

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
                                                          if ($row['type']== "visitor" || $row['type']== "foreign diplomat") {
                                                              if ($row['photo']=="") {
                                                                $ipath="images/";
                                                                $img="default_profile.png";
                                                              }
                                                              else{
                                                                $ipath=" uploads/";
                                                                $img=$row['photo'];
                                                              }
                                                            echo '
                                                                  <li class="list-group-item">
                                                                      <div style="border: 1px solid black;width:160px;height:160px;margin-bottom:10px;">
                                                                        <img src="'.$ipath.'/'.$img.'" style="width:160px;height:160px;">

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
                                                                       <li class="list-group-item"><b>Spouse:</b> '.$row['spouse'].'</li>
                                                                       <li class="list-group-item"><a href="register-visitor?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                     <button type="button" class="btn btn-secondary">Edit</button></a></li>
                                                                  ';
                                                          }
                                                          if ($row['type']== "ambassador"){
                                                           
                                                            if ($row['photo']=="") {
                                                                $ipath="images/";
                                                                $img="default_profile.png";
                                                              }
                                                              else{
                                                                $ipath=" uploads/";
                                                                $img=$row['photo'];
                                                              }
                                                            echo '
                                                                  <li class="list-group-item">
                                                                      <div style="border: 1px solid black;width:160px;height:160px;margin-bottom:10px;">
                                                                        <img src="'.$ipath.'/'.$img.'" style="width:160px;height:160px;">

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
                                                                       <li class="list-group-item"><b>Father\'s Name:</b> '.$row['father_name'].'</li>
                                                                       <li class="list-group-item"><b>Father\'s Nationality:</b> '.$fnat.'</li>
                                                                       <li class="list-group-item"><b>Mother\'s Name:</b> '.$row['mother_name'].'</li>
                                                                       <li class="list-group-item"><b>Mother\'s Nationality:</b> '.$mnat.'</li>
                                                                       <li class="list-group-item"><b>Marital Status:</b> '.$row['marital_status'].'</li>
                                                                       <li class="list-group-item"><a href="register-ambassador?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                     <button type="button" class="btn btn-secondary">Edit</button></a></li>
                                                                  ';
                                                                }
                                                          
                                                              
                                              ?>
                                              </ul>
                                            </div>
                                            <!-- additonal info -->
                                            <div class="tab-pane fade" id="add_info" role="tabpanel" aria-labelledby="vist-tab">
                                                      <ul class="list-group list-group-flush">
                                                <?php  
                                                     
                                                      $a_id= $row['id'];
                                                      $stmta = $database->query("SELECT * FROM add_info_amb WHERE id_ambassador = '$a_id' ");
                                                      $numa=$database->num_rows($stmta);
                                                      $rowa = $database->fetch_array($stmta);
                                                      $emb= $rowa['id_embassy'];
                                                      $stmtemb = $database->query("SELECT * FROM institution_details WHERE id = '$emb' ");
                                                      $rowemb = $database->fetch_array($stmtemb);
                                                      if ($numa != 0) {
                                                       
                                                              echo '

                                                                       <li class="list-group-item"><b>Request Date:</b> '.$rowa['request_date'].'</li>
                                                                       <li class="list-group-item"><b>Arrival Date:</b> '.$rowa['arrival'].'</li>
                                                                       <li class="list-group-item"><b>Depature Date:</b> '.$rowa['departure'].'</li>
                                                                       <li class="list-group-item"><b>Presentation Date:</b> '.$rowa['presentation_date'].'</li>
                                                                       <li class="list-group-item"><b>Embassy:</b> '.$rowemb['name'].'</li>
                                                                       <li class="list-group-item"><a href="editambassador?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                     <button type="button" class="btn btn-secondary">Edit</button></a></li>

                                                                  ';
                                                                 
                                                          
                                                      }
                                                      else{
                                                          
                                                          echo "<b>No Details</b>";
                                                      }
                                                   
                                                     
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
                                                                                 <li class="list-group-item"><a href="register-visitor?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
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
                                                                 
                                                                        echo '
                                                                                 <li class="list-group-item">Person'.$cntc.'.</li>
                                                                                 <li class="list-group-item"><b>Names:</b> '.$rowvc['names'].'</li>
                                                                                 <li class="list-group-item"><b>Gender:</b> '.$rowvc['gender'].'</li>
                                                                                 <li class="list-group-item"><b>Date of Birth:</b> '.$rowvc['dob'].'</li>
                                                                                 

                                                                            ';
                                                                            $cntc=$cntc+1;
                                                                           }
                                                                           echo '<li class="list-group-item"><a href="register-visitor?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                               <button type="button" class="btn btn-secondary">Edit</button></a></li>';
                                                                    
                                                                }
                                                                else{
                                                                    
                                                                    echo "<b>No Details</b>";
                                                                }
                                                             
                                                               
                                                   ?>
                                                </ul>
                                              </div>  
                                            <!-- add car tab -->
                                           
                                          <?php 
                                            if ($row['type']!= "visitor") {
                                                echo '
                                                   <div class="tab-pane fade" id="cars" role="tabpanel" aria-labelledby="cars-tab">
                                                      <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#addcar">
                                                               Add Car
                                                              </button>
                                                          </li>

                                                              ';
                                                     
                                                      $car_id= $Hash->decrypt($_GET['id']);
                                                      $stmtc = $database->query("SELECT * FROM cars WHERE owner = '$car_id' AND status='1' AND owner_type = '2' ");
                                                      $num=$database->num_rows($stmtc);
                                                      if ($num != 0) {
                                                          $c=1;
                                                          while ($rowi = $database->fetch_array($stmtc)) {
                                                            $value['id']=$rowi['id'];
                                                              echo '

                                                                  <li class="list-group-item">
                                                                  <a href="cars.php?id='.$Hash->encrypt($value['id']).'">
                                                                  <b>Car'.$c.' Plate Number:</b> '.$rowi['plate_nber'].'
                                                                  </a>
                                                                 </li>

                                                                  ';
                                                                  $c=$c+1;
                                                          }
                                                          
                                                      }
                                                      else{
                                                          
                                                          echo "<b>No cars</b>";
                                                      }
                                                     echo '</ul>
                                                        </div>';
                                                    } 
                                         ?>
                                                  
                                            <!-- add house tab -->
                                            
                                      <?php 
                                        if ($row['type']!= "visitor") {
                                            echo '
                                                    <div class="tab-pane fade" id="houses" role="tabpanel" aria-labelledby="houses-tab">
                                                      <ul class="list-group list-group-flush">
                                                       <li class="list-group-item">
                                                         <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#addhouse">
                                                          Add House
                                                         </button>
                                                       </li>

                                                  ';
                                                    $house_id= $Hash->decrypt($_GET['id']);
                                                    $stmth = $database->query("SELECT * FROM houses WHERE owner = '$house_id' AND status='1' AND owner_type = '2' ");
                                                    $numh=$database->num_rows($stmth);
                                                    if ($numh != 0) {
                                                      
                                                        $n=1;
                                                         while ($rowh = $database->fetch_array($stmth)) {

                                                                $valueho['id']=$rowh['id'];
                                                                 echo ' 
                                                                      
                                                                     <li class="list-group-item">
                                                                     <a href="houses.php?id='.$Hash->encrypt($valueho['id']).'">
                                                                     <div>
                                                                    <b>Type of House number '.$n.':</b> '.$rowh['type'].'<br/>
                                                                     <b>Location:</b> '.$rowh['location'].'
                                                                     </div>
                                                                     </a>
                                                                     </li>
                                                                    
                                                                   
                                                                 ';
                                                                 $n=$n+1;
                                                             }
                                                        
                                                    }
                                                    else{
                                                        echo "<b>No houses</b>";   
                                                             }
                                                             echo ' </ul>
                                                                  </div>';
                                               }   
                                       ?>
                                      <!-- spouse tab -->
                                      <?php 
                                            if ($row['type']== "ambassador" && $row['marital_status']!= "single" ) {
                                                echo '
                                                   <div class="tab-pane fade" id="spouse" role="tabpanel" aria-labelledby="spouse-tab">
                                                      <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#addspouse">
                                                               Add Spouse
                                                              </button>
                                                          </li>

                                                              ';
                                                     
                                                      $sp= $Hash->decrypt($_GET['id']);
                                                      $stmtsp = $database->query("SELECT * FROM spouse WHERE patner = '$sp'");
                                                      $num=$database->num_rows($stmtsp);
                                                      if ($num != 0) {
                                                          $c=1;
                                                          while ($rowsp = $database->fetch_array($stmtsp)) {
                                                            $value['id']=$rowsp['id'];
                                                              if ($rowsp['photo']=="") {
                                                                $ipath="images/";
                                                                $img="default_profile.png";
                                                              }
                                                              else{
                                                                $ipath=" uploads/";
                                                                $img=$row['photo'];
                                                              }
                                                            echo '
                                                                  
                                                               <li class="list-group-item"><b>Given Names:</b> '.$rowsp['given_names'].'</li>
                                                                       <li class="list-group-item"><b>Family Names:</b> '.$rowsp['family_names'].'</li>
                                                                       <li class="list-group-item"><b>Other Names:</b> '.$rowsp['other_names'].'</li>
                                                                       <li class="list-group-item"><b>Gender:</b> '.$rowsp['gender'].'</li>
                                                                       <li class="list-group-item"><b>Date of birth:</b> '.$rowsp['dob'].'</li>
                                                                       <li class="list-group-item"><b>Place of birth:</b> '.$rowsp['pob'].'</li>
                                                                       <li class="list-group-item"><b>Nationality of birth:</b> '.$nob.'</li>
                                                                       <li class="list-group-item"><b>Email:</b> '.$rowsp['email'].'</li>
                                                                       <li class="list-group-item"><b>Telephone:</b> '.$rowsp['telephone'].'</li>
                                                                       <li class="list-group-item"><b>Passport Number:</b> '.$rowsp['pass_no'].'</li>
                                                                       <li class="list-group-item"><b>Nationality on Passport:</b> '.$nop.'</li>
                                                                       <li class="list-group-item"><b>Date of Issue of Passport:</b> '.$rowsp['doi'].'</li>
                                                                       <li class="list-group-item"><b>Date of Expiry of Passport:</b> '.$rowsp['doe'].'</li>
                                                                       <li class="list-group-item"><b>Profession:</b> '.$rowsp['profession'].'</li>
                                                                       <li class="list-group-item"><b>Job title:</b> '.$rowsp['occupation'].'</li>
                                                                       <li class="list-group-item"><b>Company/Organization:</b> '.$rowsp['employer'].'</li>
                                                                       <li class="list-group-item"><b>Father\'s Name:</b> '.$rowsp['father_name'].'</li>
                                                                       <li class="list-group-item"><b>Father\'s Nationality:</b> '.$fnat.'</li>
                                                                       <li class="list-group-item"><b>Mother\'s Name:</b> '.$rowsp['mother_name'].'</li>
                                                                       <li class="list-group-item"><b>Mother\'s Nationality:</b> '.$mnat.'</li>
                                                                       <li class="list-group-item"><a href="editspouse?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                     <button type="button" class="btn btn-secondary">Edit</button></a></li>
                                                                  ';
                                                                  $c=$c+1;
                                                          }
                                                          
                                                      }
                                                      else{
                                                          
                                                          echo "<b>No spouse</b>";
                                                      }
                                                     echo '</ul>
                                                        </div>';
                                                    } 
                                         ?>

                                         <!-- children tab -->
                                         <?php 
                                            if ($row['type']== "ambassador") {
                                                echo '
                                                   <div class="tab-pane fade" id="children" role="tabpanel" aria-labelledby="children-tab">
                                                      <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#addchild">
                                                               Add Child
                                                              </button>
                                                          </li>

                                                              ';
                                                     
                                                      $parent= $Hash->decrypt($_GET['id']);
                                                      $stmtcld = $database->query("SELECT * FROM children WHERE parent = '$parent'");
                                                      $num=$database->num_rows($stmtcld);
                                                      if ($num != 0) {
                                                          $c=1;
                                                          while ($rowcld = $database->fetch_array($stmtcld)) {
                                                            $value['id']=$rowcld['id'];
                                                              if ($rowcld['photo']=="") {
                                                                $ipath="images/";
                                                                $img="default_profile.png";
                                                              }
                                                              else{
                                                                $ipath=" uploads/";
                                                                $img=$row['photo'];
                                                              }
                                                            echo '
                                                                  
                                                               <li class="list-group-item"><b>Given Names:</b> '.$rowcld['given_names'].'</li>
                                                                       <li class="list-group-item"><b>Family Names:</b> '.$rowcld['family_names'].'</li>
                                                                       <li class="list-group-item"><b>Other Names:</b> '.$rowcld['other_names'].'</li>
                                                                       
                                                                       <li class="list-group-item"><a href="editchild?id='.$Hash->encrypt($value['id']).'" style="font_size:30px;" >
                                                                     <button type="button" class="btn btn-secondary">Edit</button></a></li>
                                                                  ';
                                                                  $c=$c+1;
                                                          }
                                                          
                                                      }
                                                      else{
                                                          
                                                          echo "<b>No children</b>";
                                                      }
                                                     echo '</ul>
                                                        </div>';
                                                    } 
                                         ?>
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
                                            <input type='file' onchange="readURL(this,<?php echo $id; ?>,<?php echo $owner_type; ?>);" class="form-control" />
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
        <!-- inserting modals -->
        
                <!-- add car -->
     <div class="modal fade" id="addcar" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Add Car</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                          <div class="modal-body">
                            <form action='' method='post' name="form">
                                <label >Plate Number</label>
                                  <div class="form-group">
                                    <div class="form-line">
                                      <input type="text" id="plot_nber" class="form-control" name="plate_nber" value='<?php if(isset($error)){ echo $_POST['plate_nber'];}?>' required>
                                    </div>
                                  </div>

                                <label >Model</label>
                                  <div class="form-group">
                                    <div class="form-line">
                                      <input type="text" id="model" class="form-control" name="model" value='<?php if(isset($error)){ echo $_POST['model'];}?>' required>
                                    </div>
                                  </div>
                               
                                <label >Insurance</label>
                                  <div class="form-group">
                                    <div class="form-line">
                                      <input type="text" id="insurance_camp" class="form-control" name="insurance_camp" value='<?php if(isset($error)){ echo $_POST['insurance_camp'];}?>' required>
                                    </div>
                                  </div>

                                <input type='submit' name='savec' value='Save' class="btn btn-primary ">
                            </form>
                          </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add child -->
                <div class="modal fade" id="addchild" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Add Child</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                          <div class="modal-body">
                            <form action='' method='post' name="form">
                                                        <label for="name">Given Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="given_names" 
                                                                    class="form-control" name="given_names" value='<?php if(isset($error)){ echo $_POST['given_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Family Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="family_names" 
                                                                    class="form-control" name="family_names" value='<?php if(isset($error)){ echo $_POST['family_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Other Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="other_names" 
                                                                    class="form-control" name="other_names" value='<?php if(isset($error)){ echo $_POST['other_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Gender</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="gender">
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="dob" 
                                                                    class="form-control" name="dob" value='<?php if(isset($error)){ echo $_POST['dob'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Place of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="pob" 
                                                                    class="form-control" name="pob" value='<?php if(isset($error)){ echo $_POST['pob'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Nationality of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="nob">
                                                                           <?php 
                                                                              $stmtcntry = $database->query("SELECT * FROM countries");
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
                                                                    class="form-control" name="email" value='<?php if(isset($error)){ echo $_POST['email'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Telphone</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="telephone" 
                                                                    class="form-control" name="telephone" value='<?php if(isset($error)){ echo $_POST['telephone'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Passport Number</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="pass_no" 
                                                                    class="form-control" name="pass_no" value='<?php if(isset($error)){ echo $_POST['pass_no'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Nationality on Passport</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="nop">
                                                                           <?php 
                                                                              $stmtcntryl = $database->query("SELECT * FROM countries");
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
                                                                    class="form-control" name="doi" value='<?php if(isset($error)){ echo $_POST['doi'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Expiry</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="doe" 
                                                                    class="form-control" name="doe" value='<?php if(isset($error)){ echo $_POST['doe'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Profession</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="profession" 
                                                                    class="form-control" name="profession" value='<?php if(isset($error)){ echo $_POST['profession'];}?>'>
                                                                </div>
                                                            </div>

                                                            <label for="name">School</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="school" 
                                                                    class="form-control" name="school" value='<?php if(isset($error)){ echo $_POST['school'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Job title</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="occupation" 
                                                                    class="form-control" name="occupation" value='<?php if(isset($error)){ echo $_POST['occupation'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Company/Organization</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="employer" 
                                                                    class="form-control" name="employer" value='<?php if(isset($error)){ echo $_POST['employer'];}?>'>
                                                                </div>
                                                            </div>

                                                        

                                                        <div class="form-group">
                                                                    <div class="form-line">
                                                                      <input type='submit' name='child' value='Update' class="btn btn-primary ">
                                                                    </div>
                                                            </div>
                                                    </form>
                          </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- spouse modal -->
                <div class="modal fade" id="addspouse" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Add Spouse</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                          <div class="modal-body">
                            <form action='' method='post' name="form">
                                                        <label for="name">Given Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="given_names" 
                                                                    class="form-control" name="given_names" value='<?php if(isset($error)){ echo $_POST['given_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Family Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="family_names" 
                                                                    class="form-control" name="family_names" value='<?php if(isset($error)){ echo $_POST['family_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Other Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="other_names" 
                                                                    class="form-control" name="other_names" value='<?php if(isset($error)){ echo $_POST['other_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Gender</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="gender">
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="dob" 
                                                                    class="form-control" name="dob" value='<?php if(isset($error)){ echo $_POST['dob'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Place of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="pob" 
                                                                    class="form-control" name="pob" value='<?php if(isset($error)){ echo $_POST['pob'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Nationality of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="nob">
                                                                           <?php 
                                                                              $stmtcntry = $database->query("SELECT * FROM countries");
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
                                                                    class="form-control" name="email" value='<?php if(isset($error)){ echo $_POST['email'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Telphone</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="telephone" 
                                                                    class="form-control" name="telephone" value='<?php if(isset($error)){ echo $_POST['telephone'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Passport Number</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="pass_no" 
                                                                    class="form-control" name="pass_no" value='<?php if(isset($error)){ echo $_POST['pass_no'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Nationality on Passport</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="nop">
                                                                           <?php 
                                                                              $stmtcntryl = $database->query("SELECT * FROM countries");
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
                                                                    class="form-control" name="doi" value='<?php if(isset($error)){ echo $_POST['doi'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Expiry</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="doe" 
                                                                    class="form-control" name="doe" value='<?php if(isset($error)){ echo $_POST['doe'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Profession</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="profession" 
                                                                    class="form-control" name="profession" value='<?php if(isset($error)){ echo $_POST['profession'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Job title</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="occupation" 
                                                                    class="form-control" name="occupation" value='<?php if(isset($error)){ echo $_POST['occupation'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Company/Organization</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="employer" 
                                                                    class="form-control" name="employer" value='<?php if(isset($error)){ echo $_POST['employer'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Father's Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="father_name" 
                                                                    class="form-control" name="father_name" value='<?php if(isset($error)){ echo $_POST['father_name'];}?>'>
                                                                </div>
                                                            </div>

                                                         <label for="name">Father's Nationality</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="father_nat">
                                                                           <?php 
                                                                              $stmtcntryl = $database->query("SELECT * FROM countries");
                                                                              while ($rowcntryl = $database->fetch_array($stmtcntryl)) {
                                                                              echo ' <option value='.$rowcntryl['id'].'>'.$rowcntryl['nicename'].'</option>';

                                                                              }
                                                                           ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <label for="name">Mother's Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="mother_name" 
                                                                    class="form-control" name="mother_name" value='<?php if(isset($error)){ echo $_POST['mother_name'];}?>'>
                                                                </div>
                                                            </div>

                                                         <label for="name">Mother's Nationality</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="mother_nat">
                                                                           <?php 
                                                                              $stmtcntryl = $database->query("SELECT * FROM countries");
                                                                              while ($rowcntryl = $database->fetch_array($stmtcntryl)) {
                                                                              echo ' <option value='.$rowcntryl['id'].'>'.$rowcntryl['nicename'].'</option>';

                                                                              }
                                                                           ?>
                                                                    </select>
                                                                </div>
                                                            </di>

                                                        <div class="form-group">
                                                                    <div class="form-line">
                                                                      <input type='submit' name='spouse' value='Update' class="btn btn-primary ">
                                                                    </div>
                                                            </div>
                                                    </form>
                          </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add house -->
     <div class="modal fade" id="addhouse" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Add House</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                          <div class="modal-body">
                            <form action='' method='post' name="form">
                                <label >Type of House</label>
                                  <div class="form-group">
                                    <div class="form-line">
                                      <input type="text" id="type" class="form-control" name="type" value='<?php if(isset($error)){ echo $_POST['type'];}?>' required>
                                    </div>
                                  </div>
                               
                                <label >Location</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                          <input type="text" id="location" class="form-control" name="location" value='<?php if(isset($error)){ echo $_POST['location'];}?>' required>
                                        </div>
                                    </div>
                       
                                <input type='submit' name='saveh' value='Save' class="btn btn-primary ">
                            </form>
                          </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- spouse modal -->
                <div class="modal fade" id="addspouse" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">Add House</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                          <div class="modal-body">
                            <form action='' method='post' name="form">
                                                        <label for="name">Given Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="given_names" 
                                                                    class="form-control" name="given_names" value='<?php if(isset($error)){ echo $_POST['given_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Family Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="family_names" 
                                                                    class="form-control" name="family_names" value='<?php if(isset($error)){ echo $_POST['family_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Other Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="other_names" 
                                                                    class="form-control" name="other_names" value='<?php if(isset($error)){ echo $_POST['other_names'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Gender</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="gender">
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="dob" 
                                                                    class="form-control" name="dob" value='<?php if(isset($error)){ echo $_POST['dob'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Place of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="pob" 
                                                                    class="form-control" name="pob" value='<?php if(isset($error)){ echo $_POST['pob'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Nationality of Birth</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="nob">
                                                                           <?php 
                                                                              $stmtcntry = $database->query("SELECT * FROM countries");
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
                                                                    class="form-control" name="email" value='<?php if(isset($error)){ echo $_POST['email'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Telphone</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="telephone" 
                                                                    class="form-control" name="telephone" value='<?php if(isset($error)){ echo $_POST['telephone'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Passport Number</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="pass_no" 
                                                                    class="form-control" name="pass_no" value='<?php if(isset($error)){ echo $_POST['pass_no'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Nationality on Passport</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="nop">
                                                                           <?php 
                                                                              $stmtcntryl = $database->query("SELECT * FROM countries");
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
                                                                    class="form-control" name="doi" value='<?php if(isset($error)){ echo $_POST['doi'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Date of Expiry</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="doe" 
                                                                    class="form-control" name="doe" value='<?php if(isset($error)){ echo $_POST['doe'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Profession</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="profession" 
                                                                    class="form-control" name="profession" value='<?php if(isset($error)){ echo $_POST['profession'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Job title</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="occupation" 
                                                                    class="form-control" name="occupation" value='<?php if(isset($error)){ echo $_POST['occupation'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Company/Organization</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="employer" 
                                                                    class="form-control" name="employer" value='<?php if(isset($error)){ echo $_POST['employer'];}?>'>
                                                                </div>
                                                            </div>

                                                        <label for="name">Father's Names</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="father_name" 
                                                                    class="form-control" name="father_name" value='<?php if(isset($error)){ echo $_POST['father_name'];}?>'>
                                                                </div>
                                                            </div>

                                                         <label for="name">Father's Nationality</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="father_nat">
                                                                           <?php 
                                                                              $stmtcntryl = $database->query("SELECT * FROM countries");
                                                                              while ($rowcntryl = $database->fetch_array($stmtcntryl)) {
                                                                              echo ' <option value='.$rowcntryl['id'].'>'.$rowcntryl['nicename'].'</option>';

                                                                              }
                                                                           ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <label for="name">Mother's Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="mother_name" 
                                                                    class="form-control" name="mother_name" value='<?php if(isset($error)){ echo $_POST['mother_name'];}?>'>
                                                                </div>
                                                            </div>

                                                         <label for="name">Mother's Nationality</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="mother_nat">
                                                                           <?php 
                                                                              $stmtcntryl = $database->query("SELECT * FROM countries");
                                                                              while ($rowcntryl = $database->fetch_array($stmtcntryl)) {
                                                                              echo ' <option value='.$rowcntryl['id'].'>'.$rowcntryl['nicename'].'</option>';

                                                                              }
                                                                           ?>
                                                                    </select>
                                                                </div>
                                                            </di>

                                                        <div class="form-group">
                                                                    <div class="form-line">
                                                                      <input type='submit' name='spouse' value='Update' class="btn btn-primary ">
                                                                    </div>
                                                            </div>
                                                    </form>
                          </div>
                            <div class="modal-footer">
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


   
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script class="jsbin" src="assets/js/vendor/jquery-1.9.1.js"></script>
    <script class="jsbin" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript">
        function readURL(input,id,owner_type) {
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
                    url: "add-attach",
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
