<?php
include 'config/connection.php';

$message = $_GET['message'];

$gotoPage = $_GET['goto_page'];

$_SESSION['message'] = $message;

header("location:$gotoPage?'message'=$message");

?>