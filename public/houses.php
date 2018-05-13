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
        $house_id= $Hash->decrypt($_GET['id']);
        $stmth = $database->query("SELECT * FROM houses WHERE id = '$house_id' AND status = '1' ");
        $rowh = $database->fetch_array($stmth);

         if ($rowh['owner_type']== 1) {
               $display= "display";
            }
            elseif ($rowh['owner_type']== 2) {
               $display= "displayperson";
            }
        // deleting a House
        if(isset($_POST['del'])){
                        
                $stmts = $database->query("UPDATE houses SET status= '0' WHERE  id = '$house_id'") ;
                $values['id']= $rowh['owner'];
                header('Location: '.$display.'?id='.$Hash->encrypt($values['id']).'');
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
        
                        <!-- displaying Cars -->
                        <div class="col-lg-8 col-md-6">
                        <aside class="profile-nav alt">
                            <section class="card">
                                <div class="card-header user-header alt bg-dark">
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="text-light display-6"> <?php echo $rowh['type'];?> 
                                            </h4>
                                        </div>
                                    </div>
                                </div>


                                <ul class="list-group list-group-flush">
                                  <?php
                                
                                        $valueho['id']=$rowh['id'];
                                        $valueh['id']=$rowh['owner'];
                                        echo '
                       
                                                <li class="list-group-item active bg-cyan">
                                                    <a href="edithouse?id='.$Hash->encrypt($valueho['id']).'"  style="color:white;">Edit</a>
                                                    <a href="'.$display.'?id='.$Hash->encrypt($valueh['id']).'"  style="color:white;" class="pull-right">Back</a>
                                                </li>
                                                <li class="list-group-item"><b>Type of House:</b> '.$rowh['type'].'</li>
                                                <li class="list-group-item"><b>location:</b> '.$rowh['location'].'</li>
                                                <li class="list-group-item">
                                                <form action="" method="post" name="form" >
                                                <input type="submit" clas="pull-right" name="del" value="Delete" class="btn btn-primary ">
                                                </form>
                                                </li>
                                            ';
                                           
                               
                                    
                                 ?>
                                  </ul>
                                  </section>
                        </aside>
                    </div>
                    <!-- displaying houses -->
                     

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
    

</body>
</html>
