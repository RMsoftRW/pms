


    <!-- Header-->
    <?php require_once 'includes/top_nav.php'; ?>
    <!-- Header-->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header text-center" style="position: relative;top: 20px;margin-right: 10%;">


                <h2>
                    LIST OF <?php echo $title; ?>

                </h2>
            </div><br>
            <div class="pull-right" style="margin-bottom: 20px;">
                <form>
                    <div style="display: inline;">
                        <i class="fa fa-search pull-right" style="position:absolute;margin-left: 18%;margin-top: 10px;"></i>
                        <input class="form-control pull-right" placeholder="Search ... " maxlength="20" id="search" aria-label="Search" type="text" name="search" style="border: none;border-bottom: 1px solid #095C7E;background: transparent;box-shadow: none;color: #095C7E">
                    </div>
                </form>
            </div>
            <div class="search_data pull-right" style="position: absolute;z-index: 9999;"></div>
        </div>

        <!-- Basic Examples -->
        <div class="row clearfix">
        </div>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"></strong>
                            </div>
                            <div class="card-body">
                                <div class="content ">
                                    <div class="animated">
                                        <div class="table-wrapper">
                                            <div class="table-title">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <h2>Diplomats <b>Details</b></h2>
                                                    </div>

                                                </div>
                                            </div>
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Telephone</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $id=$Hash->decrypt($_GET['id']);
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
                                                    echo '<tr><td colspan="3"><center><h2>No data Available</h2></center></td></tr>';
                                                }
                                                else{
                                                    while($rowdip = $database->fetch_array($st4)){
                                                        if ($rowdip['type']!="5") {
                                                            $pat="diplomat-details";
                                                        }
                                                        else{
                                                            $pat="displayperson";
                                                        }
                                                        $valuev['id']= $rowdip['id'];
                                                        echo '
                                        
                                        <tr>
                                            <td>'.$rowdip['given_names'].'</td>
                                            <td>'.$rowdip['telephone'].'</td>
                                            <td>'.$rowdip['email'].'</td>
                                            <td><a href="'.$pat.'?id='.$Hash->encrypt($valuev['id']).'"><button class="btn btn-primary">view more</button></a></td>
                                        </tr>';
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div><!-- .animated -->
            </div>


        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        } );
    </script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <script type="text/javascript">
        $('#search').keyup(function(){
            $(".search_data").html('');
            $.ajax({
                url : 'searchdip.php',
                type : 'POST',
                data : {
                    'search' : $(this).val(),
                },
                success : function(data){
                    $(".search_data").append(data);
                    console.log(data);
                }
            });
        });
    </script>
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