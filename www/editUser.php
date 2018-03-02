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

	$sql = "UPDATE `userData` SET `firstName`='". $_POST['firstName'] ."',`lastName`='". $_POST['lastName'] ."',`address`='". $_POST['address'] ."',`username`='". $_POST['username'] ."',`password`='". $_POST['password'] ."',`email`='". $_POST['email'] ."' WHERE `userId` ='". $_POST['userId'] ."' ";

	$result = $connect->query($sql);
	if ($result) {
		unset($_SESSION['updateError']);
		header('Location: panel.php');
		$result->close();
	}else {
		$_SESSION['updateError'] = "<span style='color:red;'>W bazie istnieje już użytkownik o tej samej nazwie lub tym samym adresie email...</span>";
		header('Location: editUserPanel.php');
	}	
}
$connect->close();