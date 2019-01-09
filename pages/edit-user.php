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

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Update Record</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="clearfix"></div>
        <?php
        if (isset($_POST['btn-update'])) {
            $id = $_GET['edit_id'];
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $contact = $_POST['phone'];
            $email = $_POST['emailadd'];
            $password = $_POST['password'];
            $password2 = $_POST['conpassword'];
            if ($password == $password2) {

                if ($user->update($id, $fname, $lname, $contact, $email, $password)) {
                    $msg = "<div class='alert alert-info'>
				<strong> Record was updated successfully <a href='manageUser.php?varname=manageUser'>HOME</a>!</strong>
				</div>";
                } else {
                    $msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
                }
            } else {
                $msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> Password And Confirm Password Error!
				</div>";
            }
        }

        if (isset($_GET['edit_id'])) {
            $id = $_GET['edit_id'];
            extract($user->getID($id));
        }
        ?>
        <div class="container">
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
        </div>

        <div class="clearfix"></div><br />

        <div class="container">

            <form method='post'>

                <table class='table table-bordered'>
                    <tr>
                        <td>Plate Number</td>
                        <td><input type='text' name='firstname' class='form-control' disabled="true" value="<?php echo $plat_num; ?>"></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><input type='text' name='firstname' class='form-control' required value="<?php echo $firstname; ?>"></td>
                    </tr>

                    <tr>
                        <td>Last Name</td>
                        <td><input type='text' name='lastname' class='form-control' required value="<?php echo $lastname; ?>"></td>
                    </tr>

                    <tr>
                        <td>Phone Number</td>
                        <td><input type='number' name='phone' class='form-control' required value="<?php echo $phone; ?>"></td>
                    </tr>

                    <tr>
                        <td>Home Address</td>
                        <td><textarea type='text' name='homeadd' class='form-control' required value="<"><?php echo $homeadd; ?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary" name="btn-update">
                                <span class="glyphicon glyphicon-edit"></span>  Update this Record
                            </button>
                            <a href="manageUser.php?varname=manageUser" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                        </td>
                    </tr>

                </table>
            </form>

        </div>
    </div>
</div>
<script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<!--<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<!--<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>-->
<script src="../js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>