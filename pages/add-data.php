<?php
include_once 'dbconfig1.php';
//include_once 'dbconfig1.php';
if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>
<?php
if (isset($_POST['btn-save'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $contact = $_POST['phone'];
    $homeadd = $_POST['homeadd'];
    $carpalt = $_POST['carplat'];

    if ($user->create2($carpalt, $fname, $lname, $contact, $homeadd)) {
        header("Location: add-data.php?inserted&varname=add-data");
    } else {
        header("Location: add-data.php?failure&varname=add-data");
    }
}
?>
<?php include "./resource.php"; ?>
<div class="clearfix"></div>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "./navigstaff.php"; ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add New Driver</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="clearfix"></div>


        <?php
        if (isset($_GET['inserted'])) {
            ?>
            <div class="container">
                <div class="alert alert-info">
                    <strong> Record was inserted successfully</strong> <a href="manageUser.php?varname=manageUser">HOME</a>!
                </div>
            </div>
            <?php
        } else if (isset($_GET['failure'])) {
            ?>
            <div class="container">
                <div class="alert alert-warning">
                    <strong>SORRY!</strong> ERROR while inserting record !
                </div>
            </div>
            <?php
        }
        ?>
        <div class="clearfix"></div><br />

        <div class="container3">


            <form method='post'>

                <table class='table table-bordered'>
                    <tr>
                        <td>Car-Plate Number</td>
                        <td><input type='tel' name='carplat' class='form-control' required></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><input type='text' name='firstname' class='form-control' required></td>
                    </tr>

                    <tr>
                        <td>Last Name</td>
                        <td><input type='text' name='lastname' class='form-control' required></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><input type='tel' name='phone' class='form-control' required></td>
                    </tr>

                    <tr>
                        <td>Home Address</td>
                        <td><textarea type='text' name='homeadd' class='form-control' required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary" name="btn-save">
                                <span class="glyphicon glyphicon-plus"></span> Add Driver
                            </button>  
                            <a href="manageUser.php?varname=manageUser" class="btn btn-large btn-success" style="margin-left: 80px;"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back</a>
                        </td>
                    </tr>

                </table>
            </form>


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
