<?php
session_start();
if(!isset($_SESSION['isLogged'])){
	header('Location: index.php');
	exit();
}

require_once "connect.php";

$connect = mysqli_connect($host, $user, $pass, $db);

$sql = "SELECT * FROM userData WHERE userId = ". $_POST['id'] ."";
$fetchUser = $connect->query($sql);
if($fetchUser){
	$numUser = $fetchUser->num_rows;
	if ($numUser>0){
		$user = mysqli_fetch_row($fetchUser);
		$_SESSION['user'] = $user;
	} else{
		
	}
}
$connect->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include_once('head.php'); ?>
	<title>Kambu - Edytuj użytkownika</title>
</head>
<body>
	<p>[<a href="panel.php">Wróć do głównego panelu</a>]</p>
	<div class="col-md-12 col-md-offset-3 edit-form">
		<form action="editUser.php" method="POST">
				<div class="col-md-6 col-sm-12">
		                <input type="number" id="userId" placeholder="Identyfikator użytkownika" name="userId" value="<?php echo $_SESSION['user'][0]; ?>" required="" autofocus="" hidden>
					<div class="edit-group input-group">
					    <span class="input-group-addon edit-addon">Imię</span>
		                <input type="text" id="firstName" placeholder="Imię" name="firstName" value="<?php echo $_SESSION['user'][1]; ?>" required="" autofocus="">
		            </div>
		            <div class="edit-group input-group">
		            	<span class="input-group-addon edit-addon">Nazwisko</span>
		                <input type="text" id="lastName" placeholder="Naziwsko" name="lastName" value="<?php echo $_SESSION['user'][2]; ?>" required="" autofocus="">
		            </div>
		            <div class="edit-group input-group">
		            	<span class="input-group-addon edit-addon">Adres</span>
		                <input type="text" id="address" placeholder="Adres" name="address" value="<?php echo $_SESSION['user'][3]; ?>" required="" autofocus="">
		            </div>
					<div class="edit-group input-group">
						<span class="input-group-addon edit-addon">Nazwa użytkownika</span>
		                <input type="text" id="username" placeholder="Nazwa Użytkownika" name="username" value="<?php echo $_SESSION['user'][4]; ?>" required="" autofocus="">
		            </div>
		            <div class="edit-group input-group">
		            	<span class="input-group-addon edit-addon">Hasło</span>
		                <input type="password" id="password" name="password" placeholder="Hasło" required="" value="<?php echo $_SESSION['user'][5]; ?>">
	              	</div>
	              	<div class="edit-group input-group">
	              		<span class="input-group-addon edit-addon">Email</span>
		                <input type="email" id="email" name="email" placeholder="Email" required="" value="<?php echo $_SESSION['user'][6]; ?>">
	              	</div>
	              	<?php 
						if (isset($_SESSION['updateError'])){
							echo $_SESSION['updateError']; 
						}
					?>
	              <button class="btn btn-md btn-primary btn-block" type="submit">Edytuj</button>
	            </div>
		</form>
	</div>
</body>
</html>