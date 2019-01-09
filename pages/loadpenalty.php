<?php

$new_id = $_POST['desc'];
include './dbconfig1.php';
$query = 'SELECT penalty FROM offencelist where offencedescp=' . "'{$new_id}'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
$valueis=$row['penalty'];
echo json_encode($valueis);
?>       