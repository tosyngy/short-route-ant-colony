<?php
include_once 'dbconfig1.php';
include "./resource.php";
//include_once 'dbconfig1.php';
if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "./navigstaff.php"; ?>
    <div class="container"></div>	
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add New Offence</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="clearfix"></div>

        <div class="container">
            <?php
            if (isset($_GET['view_id'])) {
                $idd = $_GET['view_id'];
                $stmt = mysql_query("SELECT * FROM drivers WHERE id='$idd'");
                $row = mysql_fetch_assoc($stmt);
            }
            ?>
        </div>

        <div class="clearfix"></div><br/>

        <div class="container3">

            <form method='post'>

                <table class='table table-bordered'>

                    <tr>
                        <td>Car Plate number</td>
                        <td>
                            <input type='text' name='' class='form-control' value="<?php echo $row['plat_num']; ?>" required="true" disabled="true">
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" class="form-control" name="offence" disabled="true" value="<?php echo $row['lastname']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input type='text' name='' class='form-control' disabled="true" required="true" value="<?php echo $row['phone'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Home Address</td>
                        <td><textarea class="form-control" maxlength="1000" cols="25" rows="3" disabled="true"><?php echo $row['homeadd']; ?></textarea></td>

                    </tr>
    <!--                <tr>
                        <td>Location</td>
                        <td><input  type='text' name='location' class='form-control' value="" required="true"></td>
                    </tr>-->
                </table>
            </form>    

        </div>
    </div>
</div>
<script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../js/index.js"></script>