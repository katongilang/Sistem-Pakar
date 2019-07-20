<?php
session_start();
if(!isset($_SESSION["admin"])){
	header("Location: loginpakar.php");
}

unset($_SESSION['admin']);
header('location:loginpakar.php'); //direct ke index.php

?>