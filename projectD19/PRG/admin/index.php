<?php session_start(); ?>
<?php
	if(isset($_SESSION['user_login'])){
		header("Location: panel.php");
	}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>BK Base Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/my.css">
</head>
<body>

	<?php

		if(isset($_POST["login"])){
			$email  	=   mb_strtolower($_POST['email']);
			$password   =   $_POST['password'];

			require("../inc/connection.php");
			
			$authReq 	= 	$mysqli->query("SELECT * FROM users WHERE users.email = '".$email."' AND users.password = '".$password."'");
			$authNum    =	$authReq->num_rows;

			$mysqli->close();

			if($authNum !=  0){
				while($row = $authReq->fetch_assoc()){
					$userEmail    =   $row['email'];
					$userPass     =   $row['password'];
				}
				if($email   ==  $userEmail && $password   ==  $userPass){
					$_SESSION['user_login']	= $email;
					header("Location: panel.php");

					//echo "Its ok"; 
				}
			} else {
				?>
					<div style="position:absolute; background-color: #fff; padding: 15px; width:100%; left:0; z-index: 99999; text-align:center;">
						<p style="margin:0px;" class="intro">Неверное имя пользоватля или пароль!</p>
					</div>
				<?php
			}
		} 

		


	?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="index.php" method="post">
					<span class="login100-form-title p-b-26">
						BK Base Admin
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Email формата: a@b.c">
						<input class="input100" type="text" name="email" require>
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Введите пароль">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" require>
						<span class="focus-input100" data-placeholder="Пароль"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="login">
								Вход
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>
</html>