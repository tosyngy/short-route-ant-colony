<?php
include_once 'dbconfig1.php';
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
                    <h1 class="page-header">Full FRSC Offence List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="clearfix"></div>
            <!--
                        <div class="container">
                            <a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
                        </div>-->

            <div class="clearfix"></div><br />

            <div class="container2">
                <table id="tbadjt" class='table table-bordered table-responsive'>
                    <tr>
                        <th>S/N</th>
                        <th style="width: 30%;">Offence Desc</th>
                        <th>Offence Code</th>
                        <th>Penalty</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM offencelist";
                    $records_per_page = 3;
                    $newquery = $user->paging($query, $records_per_page);
                    $user->dataview($newquery);
                    ?>
                    <tr>
                        <td colspan="7" align="center">
                            <div class="pagination-wrap">
                                <?php $user->paginglink($query, $records_per_page); ?>
                            </div>
                        </td>
                    </tr>

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

</body>

</html>
