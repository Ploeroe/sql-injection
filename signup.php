<?php
// fitur debug yang dapat kita panggil
// contoh : debug_to_console($data);
function debug_to_console($data, $context = 'Debug in Console')
{

	// Buffering to solve problems frameworks, like header() in this and not a solid return.
	ob_start();

	$output  = 'console.info(\'' . $context . ':\');';
	$output .= 'console.log(' . json_encode($data) . ');';
	$output  = sprintf('<script>%s</script>', $output);

	echo $output;
}


if (isset($_POST['tambahuser'])) {
	if ($_POST["captcha"] == $_SESSION["code"]) {

		global $gambar;
		//cek apakah ada gambar
		if (!empty($_FILES['gambar']['name']) && ($_FILES['gambar']['error'] !== 4)) {
			$gambarfile_name = $_FILES['gambar']['name'];
			$gambarfile = $_FILES['gambar']['tmp_name'];
			$gambarsize = $_FILES['gambar']['size'];
			$gambarerror = $_FILES['gambar']['error'];
			$filetype = $_FILES['gambar']['type'];

			$fileExt = explode('.', $gambarfile_name);
			$fileActualExt = strtolower(end($fileExt));

			$allowtype = array('image/jpeg', 'image/jpg', 'image/png');

			if (!in_array($filetype, $allowtype)) {

				echo 'Invalid file type';
				exit;
			}

			$path = PATH_GAMBARUSER . '/';

			if (isset($gambarfile) && isset($gambarfile_name)) {

				$gambarbaru = uniqid('', true) . "." . $_POST['uid'];

				$dest1 = './' . $path . $gambarbaru . '.jpg';
				$dest2 = $path . $gambarbaru . '.jpg';

				move_uploaded_file($_FILES['gambar']['tmp_name'], $dest1);

				$gambar = $dest2;
			} else {

				$gambar = $_POST['gambar'];
			}
		}

		if (isset($_POST['first'], $_POST['last'], $_POST['uid'], $_POST['email'], $_POST['pwd'], $_POST['tanggalLahir'], $_POST['kelamin'])) {
			$first = strtolower(stripslashes(mysqli_real_escape_string($connect, $_POST['first'])));
			$last = strtolower(stripslashes(mysqli_real_escape_string($connect, $_POST['last'])));
			$uid = mysqli_real_escape_string($connect, $_POST['uid']);
			$email = mysqli_real_escape_string($connect, $_POST['email']);
			$pwd = mysqli_real_escape_string($connect, $_POST['pwd']);
			$date = mysqli_real_escape_string($connect, $_POST['tanggalLahir']);
			$gender = mysqli_real_escape_string($connect, $_POST['kelamin']);

			$password = password_hash($pwd, PASSWORD_DEFAULT);

			$sql = mysqli_query($connect, "SELECT * FROM user WHERE username='" . $uid . "' OR email ='" . $email . "' ");
			$hasil = mysqli_num_rows($sql);

			if ($hasil > 0) {

				$error1 = "Username dan email sudah pernah didaftarkan!";
			} else {

				$sql = mysqli_query($connect, "INSERT INTO user (first, last, username, email, password, tanggalLahir, gender, gambar) VALUES ('$first', '$last', '$uid', '$email', '$password', '$date', '$gender', '$gambar');");

				$berhasil = "Berhasil menambahkan user baru!";
			}
		} else {
			$error2 = "Data tidak lengkap tolong isi ulang!";
		}
	} else {
		$error3 = "Captcha tidak sesuai, Ulang lagi!";
	}
}

?>

<br>
<div class="title mx-auto wow fadeInUp">
	<img src="image/title.png" class="imgtitle">
</div>
<hr>
<div class="box mx-auto mb-5 px-5 wow fadeInUp" data-wow-delay="0.4s">
	<form action="./?open=signup" method="POST" enctype='multipart/form-data'>

		<input type="hidden" name="userid">
		<fieldset class="berita mx-auto p-3">

			<div class="d-flex pe-3 pt-3">
				<a href="?open=default" class="ms-auto icon"><i class="bi bi-x-square"></i></a>
			</div>

			<h3 class="title pb-3">Sign Up</h3>

			<div class="user">
				<label for='first'>Profile Picture:</label><br>
				<input class="kotakinput" type='file' name='gambar' required>
			</div>

			<div class="user d-flex">
				<div class="w-50 me-2">
					<label for='first'>Nama Depan:</label><br>
					<input class="kotakinput" type='text' name='first' placeholder='Nama Depan' id="input" required>
				</div>
				<div class="w-50">
					<label for='last'>Nama Belakang:</label><br>
					<input class="kotakinput" type='text' name='last' placeholder='Nama Belakang' id="input" required><br>
				</div>
			</div>

			<div class="user d-flex">
				<div class="w-50 me-2">
					<label for='email'>Email</label><br>
					<input class="kotakinput" class="kotakinput" type="email" name="email" placeholder="Email address" id="input" required>
				</div>
				<div class="w-50">
					<div class="user">
						<label for='uid'>Username:</label><br>
						<input class="kotakinput" type='text' name='uid' placeholder='Username' id="input" required><br>
					</div>
				</div>
			</div>
			<div class="user">
				<label for='pwd'>Password:</label><br>
				<input class="kotakinput" type='password' name='pwd' placeholder='Password' id="input" required><br>
			</div>

			<div class="user">
				<label for='birthday'>Tanggal Lahir:</label><br>
				<input class="kotakinput" type='date' name='tanggalLahir' placeholder='Tanggal Lahir' id="input" required><br>
			</div>

			<div class="user">
				<label for='gender'>Jenis Kelamin:</label required><br>
				<input class="radiogender" type='radio' id='pria' name='kelamin' value='pria' required>
				<label class="radiogender" for='pria'>Pria</label>
				<input class="radiogender" type='radio' id='perempuan' name='kelamin' value='perempuan'>
				<label class="radiogender" for='perempuan'>Perempuan</label><br>
			</div>

			<div class="user">
				<label>Captcha</label> <br>
				<div class="text-center">
					<img src="./controller/captcha.php" alt="gambar" class="mt-3"><br>
				</div>
				<input id="input" type="text" name="captcha" placeholder="Input Captcha (Case Sensitive)" class="kotakinput mt-3">
			</div>

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
			} elseif (isset($berhasil)) {
			?>
				<p style="color: green; font-style:italic;"><?php echo $berhasil; ?> !</p>
			<?php
			}
			?>

			<p>Already have an account? <a href="?open=login">Login Here!</a></p>
			<button class="btnsignup" type='submit' name="tambahuser">Sign Up</button>

		</fieldset>
</div>
</form>