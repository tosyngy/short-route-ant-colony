<?php
require_once 'dbconfig1.php';

if($_SESSION['user_session']!="")
{
	$user->redirect('home.php');
}
if(isset($_GET['logout']) && $_GET['logout']=="true")
{
	$user->logout();
	$user->redirect('../index.html');
}
if(!isset($_SESSION['user_session']))
{
	$user->redirect('../index.html');
}

?>
