<?php

	session_start();
	require_once('database-config.php');

	if (isset($_SESSION) && !empty($_SESSION)) {
		if ($_SESSION['loggedIn'] == 1) {
		header('location:index.php');
		exit;
	}
	}

	$err = "";
	if (isset($_POST) && !empty($_POST)) {
		

		if (!empty($_POST['email']) && !empty($_POST['password'])) {

			$email = $_POST['email'];
			$hashedPassword = trim(md5($_POST['password']));
			
			
			$sql = "SELECT id, email,password FROM user WHERE email='$email' AND password ='$hashedPassword' AND status='Active'";
			
			
			if ($mysqli->query($sql)->num_rows == 1) {
				$_SESSION['email'] = $email;
				$_SESSION['loggedIn'] = true;
				header('location:index.php');
				exit;
				
			}else{
				$err = "Invalid Email or Password";
			}
		}else{
			$err = "Please complete the details";
		}

	}

?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="assets/css/login.css">
			<title>Login</title>
		</head>
		<body>
			<div class="content-wrapper">
				<section id="login_page">
					<div class="container">
						<div class="row">
							<div class="content">
								<h2 class="text-center">Welcome Back</h2>
								<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
									<span class="error" style="color: #ff0000;">
										<?=$err?>
									</span>
									<div class="form-group">
										<input class="form-control py-4" type="text" placeholder="email" name="email">
									</div>
									<div class="form-group">
										<input class="form-control py-4" type="password" placeholder="password" name="password">
									</div>
									<div class="form-group">
										<div class="form-check-inline">
										    <input type="checkbox" class="form-check-input" id="keepSignedIn" name="" value="">
										    <label class="form-check-label custom-check" for="keepSignedIn"> Remember me</label>
										</div>
										<a class="float-right forgetPwd" href="#">Forget Password</a>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block btn-login py-2" type="submit">Login</button>
									</div>
									<p class="text-center">Not a member yet? <a class="signUp" href="#">Register</a></p>
								</form>
							</div>
						</div>
					</div>
				</section>
			</div>
		</body>
	</html>

