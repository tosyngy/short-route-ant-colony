<?php
include_once 'dbconfig1.php';
include "./resource.php";
if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$query = "SELECT * FROM admin WHERE id='$user_id'";
$st = mysql_query($query);
$userRow = mysql_fetch_assoc($st);
$_SESSION['user_session'] = $userRow['id'];
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "./navigstaff.php"; ?>

        <div id="page-wrapper">
<!--            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">HomePage</h1>
                </div>
                 /.col-lg-12 
            </div>-->
            <!-- /.row -->
            <div class="row">
                <?php
//                $page_title = 'Logged In!';
                echo "<h1 class='welcome'> Welcome! <strong>" . $userRow['firstname'] . "</strong> </h1><br/>";
                ?>
                <div id="imgdiv">
                    <img id="imgset" src="../images/frsc-logo1.jpg">
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-car fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!--<div class="huge">26</div>-->
                                    <div class="huge">Manage Drivers</div>
                                </div>
                            </div>
                        </div>
                        <a href="manageUser.php?varname=manageUser">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x" style="margin-left: -9px;"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!--<div class="huge">12</div>-->
                                    <div class="huge">Offender's List</div>
                                </div>
                            </div>
                        </div>
                        <a href="HomePage.php?varname=homepage">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-warning fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!--<div class="huge">13</div>-->
                                    <div class="huge">Offence List</div>
                                </div>
                            </div>
                        </div>
                        <a href="AbtUs.php?varname=abtus">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">

                    <!-- /.panel -->

                    <!-- /.panel -->
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->

                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <!--<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <!--<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>-->
    <script src="../js/metisMenu.min.js"></script>


    <!-- DataTables JavaScript -->
    <!--<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>-->
    <script src="../js/jquery.dataTables.min.js"></script>
    <!--<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>-->
    <script src="../js/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>