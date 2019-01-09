<?php

class user {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($fname, $lname, $contact, $email, $password) {

        try {
            $stmt = $this->db->prepare("INSERT INTO admin(firstname,lastname,phone,emailadd,password) VALUES(:fname, :lname, :contact, :email, :password)");
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":contact", $contact);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $password);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function login($emailadd, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM admin WHERE emailadd=:email LIMIT 1");
            $stmt->execute(array(':email' => $emailadd));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $userRow['password'])) {
                    $_SESSION['user_session'] = $userRow['id'];
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
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

    public function getID($id) {
        $var_value = $_GET['varname'];
        if ($var_value == "homepage") {
            $stmt = $this->db->prepare("SELECT * FROM homepage WHERE id=:id");
            $stmt->execute(array(":id" => $id));
            $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
//        print_r($editRow);
            return $editRow;
        } elseif ($var_value == "abtus") {
            $stmt = $this->db->prepare("SELECT * FROM AboutUs WHERE id=:id");
            $stmt->execute(array(":id" => $id));
            $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
//        print_r($editRow);
            return $editRow;
        } elseif ($var_value == "services") {
            $stmt = $this->db->prepare("SELECT * FROM services WHERE id=:id");
            $stmt->execute(array(":id" => $id));
            $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
//        print_r($editRow);
            return $editRow;
        } elseif ($var_value == "contactus") {
            $stmt = $this->db->prepare("SELECT * FROM contactus WHERE id=:id");
            $stmt->execute(array(":id" => $id));
            $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
//        print_r($editRow);
            return $editRow;
        } else {
            $stmt = $this->db->prepare("SELECT * FROM admin WHERE id=:id");
            $stmt->execute(array(":id" => $id));
            $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
//        print_r($editRow);
            return $editRow;
        }
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
        try {
            $stmt = $this->db->prepare("UPDATE " . $dbtable . " SET headerInfo=:headerInfo, 
		                                               headerCont=:headerCont
                                                               WHERE id=:id ");
            $stmt->bindparam(":headerCont", $headerCont);
            $stmt->bindparam(":headerInfo", $headerInfo);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $fname, $lname, $contact, $email, $password) {

        try {
            $stmt = $this->db->prepare("UPDATE admin SET firstname=:fname, 
                                                         lastname=:lname, 
                                                         phone=:contact, 
                                                         emailadd=:email,
                                                         password=:password
                                                         WHERE id=:id ");
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":contact", $contact);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $password);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM admin WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }

    public function delete2($id, $var_value) {
        if ($var_value == "homepage") {
            $tbvalue = "homepage";
        } elseif ($var_value == "abtus") {
            $tbvalue = "AboutUs";
        }
        $stmt = $this->db->prepare("DELETE FROM " . $tbvalue . " WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }

    /* paging */

    public function dataview($query) {
        $var_value = $_GET['varname'];
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        if ($var_value == "homepage" || $var_value == "abtus" || $var_value == "services" || $var_value == "contactus") {
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['headerInfo']); ?></td>
                        <td><?php print($row['headerCont']); ?></td>
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
                ?>
                <tr>
                    <td>Nothing here...</td>
                </tr>
                <?php
            }
        } else {

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?> 	 	 	 	 
                    <tr>
                        <td><?php print($row['id']); ?></td>
                        <td><?php print($row['firstname']); ?></td>
                        <td><?php print($row['lastname']); ?></td>
                        <td><?php print($row['phone']); ?></td>
                        <td><?php print($row['emailadd']); ?></td>
                        <td align="center">
                            <a href="edit-user.php?varname=edituser&edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                        </td>
                        <td align="center">
                            <a href="delete.php?varname=deleteuser&delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        </td>
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
//        $var_value = $_GET['varname'];
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        if ($var_value == "homepage") {
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
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

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

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
