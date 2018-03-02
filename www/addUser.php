<?php 
session_start();
if(!isset($_SESSION['isLogged'])){
	header('Location: index.php');
	exit();
}

require_once "connect.php";

$connect = mysqli_connect($host, $user, $pass, $db);

if (!$connect) {
	
}else {
	$sql = "INSERT INTO `userData`( `firstName`, `lastName`, `address`, `username`, `password`, `email`) VALUES ('".$_POST['firstName'] ."','".$_POST['lastName']."','". $_POST['address'] ."','". $_POST['username']. "','". $_POST['password'] ."','" .$_POST['email']."')";
	
	$result = $connect->query($sql);
	if ($result) {
			unset($_SESSION['addError']);
			header('Location: panel.php');
			$result->close();
		}else {
			$_SESSION['addError'] = "<span style='color:red;'>W bazie istnieje już użytkownik o tej samej nazwie lub tym samym adresie email...</span>";
			header('Location: addUserPanel.php');
		}	
}
$connect->close();