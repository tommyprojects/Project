<?php
session_start();

if ((!isset($_POST['username'])) || (!isset($_POST['password']))){
	header('Location: index.php');
	exit();
}

require_once "connect.php";

$connect = mysqli_connect($host, $user, $pass, $db);


if (!$connect) {
	
}else {
	$username = htmlentities($_POST['username'], ENT_QUOTES, "UTF-8");
	$password  = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");

	$adminLogin = sprintf("SELECT * FROM adminData WHERE adminName = '%s' AND adminPassword = '%s'",
	mysqli_real_escape_string($connect, $username),
	mysqli_real_escape_string($connect, $password));

	$result = $connect->query($adminLogin);
	if ($result) {
		$numRows = $result->num_rows;
		if ($numRows>0){
			$assoc = $result->fetch_assoc();
			$_SESSION['admin'] = $assoc['adminName'];
			$_SESSION['isLogged'] = true;
			$_SESSION['idAdmin'] = $assoc['id'];
			unset($_SESSION['error']);
			$result->close();
			header('Location: panel.php');
		}else {
			$_SESSION['error'] = '<span style="color:red;">Błędny login lub hasło...</span>';
			header('Location: index.php');
		}	
	}
}
$connect->close();
?>