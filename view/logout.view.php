<?php
session_start();

$_SESSION['users'] = null;
session_destroy();
header("location: index.view.php");
