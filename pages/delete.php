<?php
include_once 'dbconfig1.php';
//include_once 'dbconfig1.php';
if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>
<?php
include "./resource.php";
if (isset($_POST['btn-del'])) {
    $id = $_GET['delete_id'];
    $var_value = $_GET['varname'];
    if ($var_value == "homepage" || $var_value == "abtus") {
        $user->delete2($id, $var_value);
    } else {
        $user->delete($id);
    }
    header("Location: delete.php?deleted&varname=delete");
}
?>
<div class="clearfix"></div>

<div class="container">

    <?php
    if (isset($_GET['deleted'])) {
        ?>
        <div class="alert alert-success">
            <strong>Success!</strong> record was deleted... 
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger">
            <strong>Sure !</strong> to remove the following record ? 
        </div>
        <?php
    }
    ?>	
</div>

<div class="clearfix"></div>

<div class="container">

    <?php
    if (isset($_GET['delete_id'])) {
        $var_value = $_GET['varname'];
        if ($var_value == "homepage") {
            $tbvalue = "homepage";
            ?>
            <table class='table table-bordered'>
                <tr>
                    <th>S/N</th>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
                <?php
                $stmt = $DB_con->prepare("SELECT * FROM " . $tbvalue . " WHERE id=:id");
                $stmt->execute(array(":id" => $_GET['delete_id']));
                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                    ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['headerInfo']); ?></td>
                        <td><?php print($row['headerCont']); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } 
        elseif ($var_value == "abtus") {
            $tbvalue = "AboutUs";
            ?>
            <table class='table table-bordered'>
                <tr>
                    <th>S/N</th>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
                <?php
                $stmt = $DB_con->prepare("SELECT * FROM " . $tbvalue . " WHERE id=:id");
                $stmt->execute(array(":id" => $_GET['delete_id']));
                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                    ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['headerInfo']); ?></td>
                        <td><?php print($row['headerCont']); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
        else {
            
            ?>
            <table class='table table-bordered'>
                <tr>
                    <th>S/N</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>E - mail Address</th>
                </tr>
                <?php
                $idd = $_GET['delete_id'];
                $stmt = mysql_query("SELECT * FROM admin WHERE id='$idd'");

                while ($row = mysql_fetch_assoc($stmt)) {
                    ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['firstname']); ?></td>
                        <td><?php print($row['lastname']); ?></td>
                        <td><?php print($row['phone']); ?></td>
                        <td><?php print($row['emailadd']); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
    }
    ?>
</div>

<div class="container">
    <p>
        <?php
        if (isset($_GET['delete_id'])) {
            ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
            <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
            <a href="manageUser.php?varname=manageUser" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
        </form>  
        <?php
    } else {
        ?>
        <a href="manageUser.php?varname=manageUser" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to User Page</a>
        <?php
    }
    ?>
</p>
</div>	