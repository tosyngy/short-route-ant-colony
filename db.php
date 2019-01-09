 <?php
 $antcolony="antcolony";
$link = mysqli_connect('akudrawsecretscom.ipagemysql.com', 'antcolony', 'antcolony'); 
if (!$link) { 
    die('Could not connect: ' . mysqli_error()); 
} 
//echo 'Connected successfully'; 
mysqli_select_db($link,$antcolony); 
?> 