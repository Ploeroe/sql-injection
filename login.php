<?php
if (session_id() == '') {
	session_start();
}

if (isset($_POST["submit"])) {

	global $connect;

	if ($_POST["captcha"] != $_SESSION["code"]) {
		$error1 = "Captcha salah";
	} else {

		$username = mysqli_real_escape_string($connect, $_POST['username']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);

		$result = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if (password_verify($password, $row['password'])) {

				$resultverified = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");

				$data = mysqli_fetch_array($resultverified);

				$_SESSION["userid"] = $data['id'];
				$_SESSION["userfirst"] = $data['first'];
				$_SESSION["userlast"] = $data['last'];
				$_SESSION["useremail"] = $data['email'];
				$_SESSION["userusername"] = $data['username'];
				$_SESSION["userpassword"] = $data['password'];
				$_SESSION["usertanggalLahir"] = $data['tanggalLahir'];
				$_SESSION["usergender"] = $data['gender'];
				$_SESSION["usergambar"] = $data['gambar'];

				echo '<meta http-equiv="REFRESH" content="0;url=./?open=default" />';
			} else {
				$error2 = "Password salah";
			}
		} else {
			$error3 = "Username tidak ditemukan";
		}
	}
}
?>

<?php
if (empty($_SESSION["loginuser"])) {
?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="./assets/login.css">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="assets/animate.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	</head>

	<body>

		<div class="main">
			<div class="container ">
				<div class="title mx-auto wow fadeInUp ">
					<img src="image/title.png" class="imgtitle">
				</div>
				<hr>
				<div class="box mx-auto mb-5 wow fadeInUp " data-wow-delay="0.4s">
					<div class="d-flex pe-3 pt-3">
						<a href="?open=default" class="ms-auto icon"><i class="bi bi-x-square"></i></a>
					</div>
					<form action="" method="POST" class="py-2 px-5">
						<div class="d-flex">
							<h1 class="title pb-3 mx-auto">Login</h1>
						</div>
						<div class="user">
							<label>Username</label><br>
							<input id="username" type="text" name="username" placeholder="Username" class="kotakinput" required>
						</div> <br>


						<div class="user">
							<label>Password</label><br>
							<input id="password" type="password" name="password" placeholder="Password" class="kotakinput" required>
						</div> <br>


						<div class="user">
							<label>Captcha</label> <br>
							<img src="./controller/captcha.php" alt="gambar" class="mt-3"> <br>
							<input id="captcha" type="text" name="captcha" placeholder="Input Captcha (Case Sensitive)" class="kotakinput mt-3" required>
						</div>

						<p>Don't have an account? <a href="?open=signup">Sign Up Here!</a></p>

						<?php
						if (isset($error1)) {
						?>
							<p style="color: red; font-style:italic;"><?php echo $error1; ?> !</p>
						<?php
						} elseif (isset($error2)) {
						?>
							<p style="color: red; font-style:italic;"><?php echo $error2; ?> !</p>
						<?php
						} elseif (isset($error3)) {
						?>
							<p style="color: red; font-style:italic;"><?php echo $error3; ?> !</p>
						<?php
						}
						?>

						<input type="submit" name="submit" class="btnlogin mt-3">
					</form>
				</div>
			</div>
		</div>
		<script>
			window.onscroll = function() {
				scrollFunction()
			};

			function scrollFunction() {
				if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
					document.getElementById("nav").style.padding = "0px";
				} else {
					document.getElementById("nav").style.padding = "5px";
				}
			}
		</script>
		<script src="./controller/wow.min.js"></script>
		<script>
			new WOW().init();
		</script>
	</body>

	</html>
<?php
	exit;
}
?>