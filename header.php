<?php
include("inc/fungsi.php");
if (session_id() == '') {
	session_start();

	if (isset($_SESSION['userid'])) {
		$usergambar = $_SESSION['usergambar'];
		$userfirst = $_SESSION['userfirst'];
		$userlast = $_SESSION['userlast'];
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title><?= getprofilweb('site_title') ?></title>
	<meta name="description" content="<?= getprofilweb('meta_desc') ?>">
	<meta name="keywords" content="<?= getprofilweb('meta_key') ?>">
	<link rel="icon" href="/image/News.png">
	<link rel="stylesheet" type="text/css" href="assets/berita.css">
	<link href="assets/hover.css" rel="stylesheet" media="all">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
	<link rel="stylesheet" href="assets/animate.css">
	<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="nav">
		<div class="container">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<a class="navbar-brand" href="?open=default">
					<img src="image/News.png" alt="" width="30" height="30">
				</a>
			</ul>
			<?php
			if (isset($_SESSION['userid'])) {
			?>
				<ul class="navbar-nav ms-auto">
					<li class="nav-item mt-3 me-2">
						<div class="namanav"><?php echo " $userfirst  $userlast"; ?></div>
					</li>
					<li class="nav-item mt-2">
						<img class="imgnav" src=<?php echo " $usergambar"; ?>>
					</li>
					<span class="btnlogout ms-2"><a href="?keluar=yes">Log Out</a></span>

				<?php
			} else {
				?>
					<span class="btnlogout me-2"><a href="?open=login">Login</a></span>
					<span class="btnlogout"><a href="?open=signup">Sign Up</a></span>
				<?php
			}
				?>
				</ul>
		</div>
	</nav>

	<div class="main">
		<div class="container">
			<?php
			$open = (isset($_GET["open"]) ? $_GET["open"] : '');
			if ($open !== "login" && $open !== "signup") {
			?>

				<header>
					<div class="title mx-auto">
						<img src="image/title.png" class="imgtitle wow fadeInUp">
					</div>
					<hr>
					<nav class="navbar navbar-expand navbar-light bg-light mb-5 wow fadeInUp" data-wow-delay="0.4s">
						<div class="container-fluid">
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="navbar-nav me-auto mb-2 mb-lg-0">
									<li class="nav-item">
										<a href="./" class="nav-link">Home</a>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Kategori
										</a>
										<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
											<?php
											global $connect;

											$menu = mysqli_query($connect, "SELECT * FROM kategori WHERE Terbit='1' ORDER BY ID ASC LIMIT 0,10");
											while ($r = mysqli_fetch_array($menu)) {
												extract($r);

												echo '
													<li>
														<a class="dropdown-item" href="./?open=cat&id=' . $ID . '">' . $Kategori . '</a>
													</li>
													';
											}
											?>
										</ul>
									<li class="nav-item">
										<a class="nav-link" href="./?open=about">About Us</a>
									</li>
									</li>
								</ul>
								<form action="" method="GET" class="d-flex">
									<input type="text" name="key" placeholder="Type Here" class="form-control me-2">
									<input type="submit" name="open" value="cari" class="btnsearch">
								</form>
							</div>
						</div>
				</header>
			<?php
			}
			?>