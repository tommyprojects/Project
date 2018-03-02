<?php
session_start();
if(!isset($_SESSION['isLogged'])){
	header('Location: index.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include_once('head.php'); ?>
	<title>Kambu - Dodaj użytkownika</title>
</head>
<body>
	<p>[<a href="panel.php">Wróć do głównego panelu</a>]</p>
	<div class="col-md-12 col-md-offset-3 edit-form">
		<form action="addUser.php" method="POST">
				<div class="col-md-6 col-sm-12">
					<div class="edit-group input-group">
		                <input type="text" id="firstName" placeholder="Imię" name="firstName" required="" autofocus="">
		            </div>
		            <div class="edit-group input-group">
		                <input type="text" id="lastName" placeholder="Naziwsko" name="lastName" required="" autofocus="">
		            </div>
		            <div class="edit-group input-group">
		                <input type="text" id="address" placeholder="Adres" name="address" required="" autofocus="">
		            </div>
					<div class="edit-group input-group">
		                <input type="text" id="username" placeholder="Nazwa Użytkownika" name="username" required="" autofocus="">
		            </div>
		            <div class="edit-group input-group">
		                <input type="text" id="password" name="password" placeholder="Hasło" required="" >
	              	</div>
	              	<div class="edit-group input-group">
		                <input type="email" id="email" name="email" placeholder="Email" required="">
	              	</div>
	              	<?php 
						if (isset($_SESSION['addError'])){
							echo $_SESSION['addError']; 
						}
					?>
	              <button class="btn btn-md btn-primary btn-block" type="submit">Stwórz</button>
	            </div>
		</form>
	</div>
</body>
</html>