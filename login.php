<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>-->

	<link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/font-face.css" rel="stylesheet" media="all">
    
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg.png');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
                    Login
				</span>
                
                <form method="post" action="module/user/check_login.php" class="login100-form validate-form p-b-33 p-t-5">

					<div class="wrap-input100 validate-input " data-validate = "Enter username">
						<input class="input100 " type="text" name="username" placeholder="User name" required>
						<span class="focus-input100 " data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<input type="submit" name="Login" value="Login" class="login100-form-btn">
					</div>

				</form>
			</div>
		</div>
	</div>

	
<!--===============================================================================================-->
</body>
</html>