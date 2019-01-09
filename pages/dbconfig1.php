<?php
session_start();
$link = mysql_connect('localhost', 'root', 'DAMIlola2020', 'frscdb');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("frscdb", $link);
if (!isset($_GET['varname'])) {
    $var_value = "homepage";
} else {
    $var_value = $_GET['varname'];
}
include_once 'class.user.php';
$user = new USER();