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

	$sql = "DELETE FROM `userData` WHERE `userId` ='". $_POST['userId']."' ";

	$result = $connect->query($sql);
	if ($result) {
			echo 'Pomyślnie usunięto użytkownika!';
		}else {
			echo 'Nie można usunąć użytkownika...';
		}	
}
$connect->close();