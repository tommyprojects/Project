<?php
	session_start();
	if (isset($_SESSION['isLogged']) && ($_SESSION['isLogged'] == true)){
		header('Location: panel.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include_once('head.php'); ?>
	<title>Kambu - Projekt</title>
</head>
<body>
	<div class="col-md-6 col-md-offset-3 login-form">
		<form action="login.php" method="POST">
				<div class="col-md-4 col-md-offset-4 col-sm-12">
					<div class="input-group" id="username-group">
		                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
		                <input type="text" id="username" placeholder="Nazwa Użytkownika" name="username" value="" required="" autofocus="">
		            </div>
		            <div class="input-group" id="password-group">
		                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
		                <input type="password" id="password" name="password" placeholder="Hasło" required="">
	              	</div>
	              	<?php 
						if (isset($_SESSION['error'])){
							echo $_SESSION['error']; 
						}
					?>
	              <button class="btn btn-md btn-primary btn-block" type="submit">Zaloguj się</button>
	            </div>
		</form>
	</div>
</body>
</html>