<?php
include '../db.php';
$arr=array();
$query = "select * from road_update";
$rez = mysqli_query($link,$query);
//print_r($rez);
while($myrow=mysqli_fetch_array($rez)){
    array_push($arr, $myrow);
}
echo json_encode($arr);
?>
