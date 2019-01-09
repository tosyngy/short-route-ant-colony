<?php

class test {

    public function dataview2($query, $submenu) {
        if (!isset($_GET['varname'])) {
            $var_value = "homepage";
        } else {
            $var_value = $_GET['varname'];
        }
//        $var_value = $_GET['varname'];
        $stmt = mysql_query($query);
        if ($var_value == "homepage") {
            if (mysql_num_rows($stmt) > 0) {
                $row = mysql_fetch_assoc($stmt);
                if ($submenu == "head") {
                    ?>
                    <h3><?php print($row['headerInfo']); ?></h3>
                    <?php print($row['headerCont']); ?>
                    <?php
                } elseif ($submenu == "menu") {
                    ?>
                    <h5><?php print($row['headerInfo']); ?></h5>
                    <p><?php print($row['headerCont']); ?></p>
                    <?php
                }
            }
        } elseif ($var_value == "abtus") {
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($submenu == "head") {
                    ?>
                    <h3><?php print($row['headerInfo']); ?></h3>
                    <h5><?php print($row['headerCont']); ?></h5>
                    <?php
                } elseif ($submenu == "menu1") {
                    ?>
                    <h3 style="font-size: 20px; margin-top: 15px;margin-bottom: -12px"><?php print($row['headerInfo']); ?></h3>
                    <h5><?php print($row['headerCont']); ?></h5>
                    <?php
                } elseif ($submenu == "menu2") {
                    ?>

                    <h3 style="color: rgb(194, 109, 27); margin-top: 19px;"><?php print($row['headerInfo']); ?></h3>
                    <p><?php print($row['headerCont']); ?></p>
                    <?php
                } elseif ($submenu == "menu3") {
                    ?>
                    <h3 style="font-size: 20px; margin-top: 8px;color: rgb(194, 109, 27);margin-bottom: 0px"><?php print($row['headerInfo']); ?></h3>
                    <p><?php print($row['headerCont']); ?></p>
                    <?php
                }
            }
        } elseif ($var_value == "services") {
            if (mysql_num_rows($stmt) > 0) {
                $row = mysql_fetch_assoc($stmt);
                if ($submenu == "head") {
                    ?>
                    <h3 class="wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;"><?php print($row['headerInfo']); ?></h3>
                    <h5 class="wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;"><span><?php print($row['headerCont']); ?></span></h5><br>
                    <?php
                } elseif ($submenu == "menu1") {
                    ?>
                    <h4><?php print($row['headerInfo']); ?></h4>
                    <p><?php print($row['headerCont']); ?></p>
                    <?php
                } elseif ($submenu == "menu2") {
                    ?>
                    <h4><?php print($row['headerInfo']); ?></h4>
                    <p><?php print($row['headerCont']); ?></p>
                    <?php
                } elseif ($submenu == "menu3") {
                    ?>
                    <h4><?php print($row['headerInfo']); ?></h4>
                    <ul><?php print($row['headerCont']); ?></ul>
                    <?php
                } elseif ($submenu == "menu4") {
                    ?>
                    <h4><?php print($row['headerInfo']); ?></h4>
                    <ul><?php print($row['headerCont']); ?></ul>
                    <?php
                } elseif ($submenu == "menu5") {
                    ?>
                    <h4><?php print($row['headerInfo']); ?></h4>
                    <p><?php print($row['headerCont']); ?></p>
                    <?php
                }
            }
        } elseif ($var_value == "contactus") {
            if (mysql_num_rows($stmt) > 0) {
                $row = mysql_fetch_assoc($stmt);
                if ($submenu == "head") {
                    ?>
                    <p>
                    <h4><?php print($row['headerInfo']); ?></h4></p>
                    <p><?php print($row['headerCont']); ?></p>
                    <?php
                } elseif ($submenu == "menu") {
                    ?>
                    <h4><?php print($row['headerInfo']); ?></h4>
                    <p><?php print($row['headerCont']); ?></p>
                    <?php
                }
            }
        }
    }

    public function datavieww($query) {
        $var_value = $_GET['varname'];
        $st = mysql_query($query);
        $stmt = mysql_fetch_row($st);
//        print_r($stmt);
        if ($var_value == "homepage" || $var_value == "abtus" || $var_value == "services" || $var_value == "contactus") {

            if (!empty($stmt)) {
                $row = $stmt;
                while ($row = mysql_fetch_row($st)) {
                    ?>
                    <tr>
                        <td><?php print($row[0]); ?></td>
                        <td><?php print($row[1]); ?></td>
                        <td><?php print($row[2]); ?></td>
                        <td align="center">
                            <a href="edit-data.php?edit_id=<?php print($row['id']) . "&varname=" . $var_value; ?>"><i class="glyphicon glyphicon-edit"></i></a>
                        </td>
                    <!--                        <td align="center">
                            <a href="delete.php?delete_id=<?php print($row['id']) . "&varname=" . $var_value; ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        </td>-->
                    </tr>
                    <?php
                }
            } else {
                while ($row = mysql_fetch_row($st)) {
                    ?> 	 	 	 	 
                    <tr>

                        <td><?php print($row[0]); ?></td>
                        <td><?php print($row[1]); ?></td>
                        <td><?php print($row[2]); ?></td>
                        <td><?php print($row[3]); ?></td>
                        <td><?php print($row[4]); ?></td>
                        <td align="center">
                            <a href="edit-user.php?varname=edituser&edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                        </td>
                        <td align="center">
                            <a href="delete.php?varname=deleteuser&delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        </td>
                    </tr>
                    <?php
                }
//            } else {
//                
                ?>
                <tr>
                    <td>Nothing here...</td>
                </tr>
                //<?php
//            }
            }
        } else {
            ?>
            <tr>
                <td>Nothing here...  ggh</td>
            </tr>
            <?php
        }
    }

}
