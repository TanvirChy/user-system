<?php
session_start();
$userDetails = $_SESSION['users'];
$userInfo = $userDetails[0];

if(!$userInfo) {
    header('location: login.view.php');
}

var_dump($userInfo['name']);


?>

<a href="logout.view.php">Logout</a>
<h1>Wellcome to our User System. </h1>