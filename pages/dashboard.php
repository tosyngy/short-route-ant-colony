<?php
//include_once 'dbconfig1.php';
include "./resource.php";
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "./navigstaff.php"; ?>

        <div id="page-wrapper">
            <!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>-->
           <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
           <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
           <script src="../js/alcoalgorithm.js"></script>
        
            <table id="tbadjt" class='table table-bordered table-responsive' border="0" cellpadding="0" cellspacing="3">
                <tr>
                    
                    Source:
                <input class='form-control' type="text" id="txtSource" value="Yaba College Of Technology, Lagos Mainland, Lagos, Nigeria"style="width: 315px; margin-left: -24px;" />
                &nbsp; Destination:
                <input class='form-control' type="text" id="txtDestination" value="Andheri, Mumbai, India" style="width: 315px; margin-left: -24px;" />
                <br />
                <input class="btn btn-large btn-info" type="button" value="Get Route" onclick="GetRoute()" style="width: 180px; margin-left: 35px;" />
                <hr />
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div id="dvDistance">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="map-canvas" style="width:100%;"></div>
  <div class="hr vpad"></div>
                    </td>
                    
                </tr>
            </table>
            <div id="dvPanel" style="width: 100%; direction: ltr; overflow-y: scroll;">
            </div>
            <br />
            <!-- /.row -->
        </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!--<script src="../js/jquery.min.js"></script>-->

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