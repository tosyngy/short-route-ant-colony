<?php
include_once 'dbconfig1.php';
//include_once 'dbconfig1.php';
if (!$user->is_loggedin()) {
    redirect('index.php');
}
?>
<?php
include "./resource.php";
if (isset($_POST['btn-update'])) {
    $id = $_GET['edit_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
//	$email = $_POST['email_id'];
//	$contact = $_POST['contact_no'];

    if ($user->update2($id, $fname, $lname)) {
        $varname = $_GET['varname'];
        if ($varname == "homepage") {
            $msg = "<div class='alert alert-info'>
				<strong>WOW!</strong> Record was updated successfully <a href='HomePage.php?varname=homepage'>Home Page</a>!
				</div>";
        } elseif ($varname == "abtus") {
            $msg = "<div class='alert alert-info'>
				<strong> Record was updated successfully <a href='AbtUs.php?varname=abtus'>About Us</a>!</strong>
				</div>";
        } elseif ($varname == "services") {
            $msg = "<div class='alert alert-info'>
				<strong> Record was updated successfully <a href='Services.php?varname=services'>Services</a>!</strong>
				</div>";
        } elseif ($varname == "contactus") {
            $msg = "<div class='alert alert-info'>
				<strong> Record was updated successfully <a href='ContactUs.php?varname=contactus'>Contact Us</a>!</strong>
				</div>";
        }
    } else {
        $msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
    }
}

if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    extract($user->getID($id));
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

        <div class="container">
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
        </div>

        <div class="clearfix"></div><br/>

        <div class="container3">

            <form method='post'>

                <table class='table table-bordered'>

                    <tr>
                        <td>Plate Number</td>
                        <td><input type='text' name='first_name' class='form-control' value="<?php echo $plat_num; ?>" required disabled="true"></td>
                    </tr>
                    <tr>
                        <td>Offence Description</td>
                        <td><select id="offCombo" class="form-control" required="true" name="offence" contenteditable="false" onchange="pickval()"></select></td>
                    </tr>
                    <tr>
                        <td>Penalty</td>
                        <td><input type='text' name='penalty' class='form-control' value="" required disabled="true"></td>
                    </tr>
                    <tr>
                        <td>Officer's Comment</td>
                        <td><textarea class="form-control" name="last_name" required=""  maxlength="1000" cols="25" rows="3"><?php echo $offence; ?></textarea></td>

                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary" name="btn-update">
                                <span class="glyphicon glyphicon-edit"></span>  Update this Record
                            </button>
                            <?php
                            $varname = $_GET['varname'];
                            if ($varname == "homepage") {
                                echo "<a href='HomePage.php?varname=homepage' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; CANCEL</a>";
                            } elseif ($varname == "abtus") {
                                echo "<a href='AbtUs.php?varname=abtus' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; CANCEL</a>";
                            } elseif ($varname == "services") {
                                echo "<a href='Services.php?varname=services' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; CANCEL</a>";
                            } elseif ($varname == "contactus") {
                                echo "<a href='ContactUs.php?varname=contactus' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; CANCEL</a>";
                            }
                            ?>

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
<script src="../js/index.js"></script>