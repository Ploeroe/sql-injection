<?php
include("header.php");

if (isset($_GET["keluar"]) && $_GET["keluar"] == 'yes') {
	session_destroy();
	echo '<meta http-equiv="REFRESH" content="0;url=./?open=default" />';
}

?>

<div class="pt10 pb10">

	<?php
	$open = (isset($_GET["open"]) ? $_GET["open"] : '');

	switch ($open) {
		case "cat":
			include("kategori.php");
			break;

		case "detail":
			include("detail.php");
			break;

		case "cari":
			include("cari.php");
			break;

		case "signup":
			include("signup.php");
			break;

		case "login":
			include("login.php");
			break;

		case "default":
			include("depan.php");
			break;

		case "about":
			include("about.php");
			break;

		default:
			include("depan.php");
			break;
	}

	?>

</div>


<?php
include("footer.php");
?>