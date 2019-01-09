<?php

class USER {

    function __construct() {
        
    }

    public function create($fname, $lname, $contact, $email, $password) {
        $query = "INSERT INTO admin(firstname,lastname,phone,emailadd,password) VALUES('$fname','$lname','$contact','$email','$password')";
        mysql_query($query)or die("insertion failed.  Error returned if any: " . mysql_error());

        return true;
    }

    public function create2($platnum, $fname, $lname, $contact, $homeadd) {
        $query = "INSERT INTO drivers(plat_num,firstname,lastname,phone,homeadd) VALUES('$platnum','$fname','$lname','$contact','$homeadd')";
        mysql_query($query)or die("insertion failed.  Error returned if any: " . mysql_error());

        return true;
    }

    public function createoff($platnum, $offdescp, $offpen, $comment, $location) {
        if ($offdescp == "Select Offence") {
            return false;
        } else {
            $date_time = date('Y-m-d H:i:s');
            $query = "INSERT INTO offence_tbl(plat_num,offence,penalty,offcoment,location,dat_time) VALUES('$platnum','$offdescp','$offpen','$comment','$location','$date_time')";
            mysql_query($query)or die("insertion failed.  Error returned if any: " . mysql_error());

            return true;
        }
    }

    public function login($emailadd, $password) {
//        try {
        $query = "SELECT * FROM admin WHERE emailadd='$emailadd' LIMIT 1";
        $result = mysql_query($query) or die("checkPass fatal error: " . mysql_error());
        if (mysql_num_rows($result) == 1) {
            $row = mysql_fetch_array($result);
            if ($password == $row['password']) {
                $_SESSION['user_session'] = $row['id'];
                $_SESSION['user_session2'] = "staff";
                return true;
            } else {
                return false;
            }
        }
    }

    public function is_loggedin() {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function redirect($url) {
        header("Location: $url");
    }

    public function logout() {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

    public function update2($id, $headerInfo, $headerCont) {
        $var_value = $_GET['varname'];
        if ($var_value == "homepage") {
            $dbtable = "homepage";
        } elseif ($var_value == "abtus") {
            $dbtable = "AboutUs";
        } elseif ($var_value == "services") {
            $dbtable = "services";
        } elseif ($var_value == "contactus") {
            $dbtable = "contactus";
        }

        $stmt = "UPDATE " . $dbtable . " SET headerInfo='$headerInfo', 
                                             headerCont='$headerCont'
                                             WHERE id='$id' ";
        mysql_query($stmt);

        return true;
    }

    public function getID($id) {
        $var_value = $_GET['varname'];
        if ($var_value == "homepage") {
            $query = "SELECT * FROM offence_tbl WHERE id='$id'";
            $result = mysql_query($query) or die("checkPass fatal error: " . mysql_error());
            return mysql_fetch_assoc($result);
        } elseif ($var_value == "abtus") {
            $stmt = ("SELECT * FROM AboutUs WHERE id='$id'");
            $result = mysql_query($stmt) or die("checkPass fatal error: " . mysql_error());
            return mysql_fetch_assoc($result);
        } elseif ($var_value == "services") {
            $stmt = ("SELECT * FROM services WHERE id='$id'");
            $result = mysql_query($stmt) or die("checkPass fatal error: " . mysql_error());
            return mysql_fetch_assoc($result);
        } elseif ($var_value == "contactus") {
            $stmt = ("SELECT * FROM contactus WHERE id='$id'");
            $result = mysql_query($stmt) or die("checkPass fatal error: " . mysql_error());
            return mysql_fetch_assoc($result);
        } else {
            $stmt = ("SELECT * FROM drivers WHERE id='$id'");
            $result = mysql_query($stmt) or die("checkPass fatal error: " . mysql_error());
            return mysql_fetch_assoc($result);
        }
    }

    public function update($id, $fname, $lname, $contact, $email, $password) {
        $query = "UPDATE admin SET firstname='$fname',lastname='$lname',phone='$contact',emailadd='$email',password='$password' WHERE id='$id' ";
        mysql_query($query)or die("insertion failed.  Error returned if any: " . mysql_error());
        return true;
    }

    public function delete($id) {
        $stmt = "DELETE FROM admin WHERE id='$id'";
        mysql_query($stmt);
        return true;
    }

    public function delete2($id, $var_value) {
        if ($var_value == "homepage") {
            $tbvalue = "homepage";
        } elseif ($var_value == "abtus") {
            $tbvalue = "AboutUs";
        }
        $stmt = "DELETE FROM " . $tbvalue . " WHERE id='$id'";
        mysql_query($stmt);
//        $stmt = $this->db->prepare("DELETE FROM " . $tbvalue . " WHERE id=:id");
//        $stmt->bindparam(":id", $id);
//        $stmt->execute();
        return true;
    }

    public function dataview($query) {
        $var_value = $_GET['varname'];
        $stmt = mysql_query($query);
        if ($var_value == "homepage") {
            if (mysql_num_rows($stmt) > 0) {
                while ($row = mysql_fetch_assoc($stmt)) {
                    ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['plat_num']); ?></td>
                        <td><?php print($row['offence']); ?></td>
                        <td><?php print($row['location']); ?></td>
                        <td align="center">
                            <a href="add-offen.php?edit_id=<?php print($row['id']) . "&varname=" . $var_value; ?>" data-toggle="tooltip" title="add offence" onclick="offence()"><i class="glyphicon glyphicon-edit" onclick="offence()"></i></a>
                        </td>
                        <td align="center">
                            <a href="edit-data.php?edit_id=<?php print($row['id']) . "&varname=" . $var_value; ?>" data-toggle="tooltip" title="view offence"><i class="glyphicon glyphicon-envelope"></i></a>
                        </td>
                    </tr>
                    <?php
                }
            }
        } else if ($var_value == "abtus" || $var_value == "services" || $var_value == "contactus") {
            if (mysql_num_rows($stmt) > 0) {
                while ($row = mysql_fetch_assoc($stmt)) {
                    ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['offencedescp']); ?></td>
                        <td><?php print($row['offcode']); ?></td>
                        <td><?php print($row['penalty']); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td>Nothing here...</td>
                </tr>
                <?php
            }
        } else {

            if (mysql_num_rows($stmt) > 0) {
                while ($row = mysql_fetch_assoc($stmt)) {
                    ?> 	 	 	 	 
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['plat_num']); ?></td>
                        <td><?php print($row['firstname'] . " " . $row['lastname']); ?></td>
                        <td><?php print($row['phone']); ?></td>
                        <td align="center">
                            <a href="viewdrver.php?varname=deleteuser&view_id=<?php print($row['id']); ?>" data-toggle="tooltip" title="view"><i class="glyphicon glyphicon-file"></i></a>
                        </td>
                        <td align="center">
                            <a href="add-offen.php?edit_id=<?php print($row['id']) . "&varname=" . $var_value; ?>" data-toggle="tooltip" title="add offence" onclick="offence()"><i class="glyphicon glyphicon-edit" onclick="offence()"></i></a>
                        </td>
                                        <!--                        <td align="center">
                                                <a href="delete.php?varname=deleteuser&delete_id=<?php print($row['id']); ?>" data-toggle="tooltip" title="delete"><i class="glyphicon glyphicon-remove"></i></a>
                                            </td>-->

                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td>Nothing here...</td>
                </tr>
                <?php
            }
        }
    }

    public function dataview2($query, $submenu) {
        if (!isset($_GET['varname'])) {
            $var_value = "homepage";
        } else {
            $var_value = $_GET['varname'];
        }
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
            if (mysql_num_rows($stmt) > 0) {
                $row = mysql_fetch_assoc($stmt);
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

    public function paging($query, $records_per_page) {
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query, $records_per_page) {
        $var_value = $_GET['varname'];
        $self = $_SERVER['PHP_SELF'];
        $stmt = mysql_query($query);
//        $stmt = mysql_fetch_row($st);
        $total_no_of_records = mysql_num_rows($stmt);

        if ($total_no_of_records > 0) {
            ?><ul class="pagination"><?php
            $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
            $current_page = 1;
            if (isset($_GET["page_no"])) {
                $current_page = $_GET["page_no"];
            }
            if ($current_page != 1) {
                $previous = $current_page - 1;
                echo "<li><a href='" . $self . "?varname=" . $var_value . "&page_no=1'>First</a></li>";
                echo "<li><a href='" . $self . "?varname=" . $var_value . "&page_no=" . $previous . "'>Previous</a></li>";
            }
            for ($i = 1; $i <= $total_no_of_pages; $i++) {
                if ($i == $current_page) {
                    echo "<li><a href='" . $self . "?varname=" . $var_value . "&page_no=" . $i . "' style='color:red;'>" . $i . "</a></li>";
                } else {
                    echo "<li><a href='" . $self . "?varname=" . $var_value . "&page_no=" . $i . "'>" . $i . "</a></li>";
                }
            }
            if ($current_page != $total_no_of_pages) {
                $next = $current_page + 1;
                echo "<li><a href='" . $self . "?varname=" . $var_value . "&page_no=" . $next . "'>Next</a></li>";
                echo "<li><a href='" . $self . "?varname=" . $var_value . "&page_no=" . $total_no_of_pages . "'>Last</a></li>";
            }
            ?></ul><?php
            }
        }

    }
    ?>