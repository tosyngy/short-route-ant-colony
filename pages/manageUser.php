<?php
include_once 'dbconfig1.php';
//include_once 'dbconfig1.php';
if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>
<?php
include "./resource.php";
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "./navigstaff.php"; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Driver Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="clearfix"></div>

            <div class="container2">
                <a href="add-data.php" class="btn btn-large btn-info" style="margin-left: -20px;"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
            </div>
            <div id="seacrdriv">
                <input type="search" class="form-control" data-table="table-bordered" placeholder="Search For Driver">
            </div>
            <div class="clearfix"></div><br />

            <div class="container2">
                <table id="tbadjt" class='table table-bordered table-responsive'>

                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th style="width: 30%;">Plate Number</th>
                            <th>Driver's Name</th>
                            <th>Phone Number</th>
                            <th colspan="3" align="center">Actions</th>
                        </tr>
                    </thead>
                    <?php
                    $query = "SELECT * FROM drivers";
                    $records_per_page = 3;
                    $newquery = $user->paging($query, $records_per_page);
                    $user->dataview($newquery);
                    ?>
                    <tbody>
                        <tr>
                            <td colspan="5" align="center">
                                <div class="pagination-wrap">
                                    <?php $user->paginglink($query, $records_per_page); ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/index.js"></script>
    
</body>

</html>