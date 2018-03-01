<?php
	session_start();
	if(!isset($_SESSION['isLogged'])){
		header('Location: index.php');
		exit();
	}
	require_once "connect.php";

	if(isset($_SESSION['isLogged'])){
		$conn = mysqli_connect($host, $user, $pass, $db);

		$sql = "SELECT * FROM userData";
		$fetchUsers = $conn->query($sql);
		if($fetchUsers){
			$numUsers = $fetchUsers->num_rows;
			if ($numUsers>0){
				$allUsers[] = mysqli_fetch_all ($fetchUsers, MYSQLI_ASSOC);
				$_SESSION['allUsers'] = $allUsers;
				unset($_SESSION['usersError']);
			} else{
				$_SESSION['usersError'] = "Brak użytkowników w bazie...";
			}
		}
		$conn->close();
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include_once('head.php'); ?>
	<title>Kambu - Panel Administratora</title>
	<script type="text/javascript" src="js/panel.js"></script>
</head>
<body>
	<?php 
	echo "<p>Hello ".$_SESSION['admin'].'! [<a href="logout.php">Wyloguj</a>]</p>'; 
	if (isset($_SESSION['usersError'])){
		echo $_SESSION['usersError'];
	}else{
		echo "<table class='table' border='1'>
        <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Adres</th>
        <th>Nazwa użytkownika</th>
        <th>Hasło</th>
        <th>Email</th>
        <th>Edytuj/Usuń</th>
        </tr>";
		foreach ($_SESSION['allUsers']  as $value) {
			foreach ($value as $user) {
				echo "<td>" . $user['firstName'] . "</td>";
				echo "<td>" . $user['lastName'] . "</td>";
				echo "<td>" . $user['address'] . "</td>";
				echo "<td>" . $user['username'] . "</td>";
				echo "<td>" . $user['password'] . "</td>";
				echo "<td>" . $user['email'] . "</td>";
				echo "<td>
					<form method='POST' action='editUserPanel.php'>
					    <input type='hidden' name='id' value='". $user['userId'] ."' readonly />
						<button class='btn btn-success edit' userId='". $user['userId'] ."' type='submit'>Edytuj</button>
					</form>
					<button class='btn btn-danger delete' type='button' userId='". $user['userId'] . "'>Usuń</button></td>";
				echo '</tr>';
			}
		}
		echo "</table>";
	}
	?>

</body>
</html>