<div class="mainpage">

	<div class="content wow fadeInUp" data-wow-delay="0.4s">


		<?php
		global $connect;

		$get_key = $_GET['key'];

		$key = explode(" ", $get_key);

		sort($key);

		$stradd = '';

		foreach ($key as $val) {

			if ($stradd != '') {

				$stradd .= " OR Isi LIKE '%{$val}%' OR Judul LIKE '%{$val}%' ";
			} else {

				$stradd .= " Isi LIKE '%{$val}%' OR Judul LIKE '%{$val}%' ";
			}
		}


		echo '
		<div class=" mb-5 ">
			<button class="btnsearch float-start wow fadeInUp" data-wow-delay="0.6s">Hasil pencarian kata kunci : ' . str_replace('+', ' ', $get_key) . '</button>
		</div>
		';


		$sql = mysqli_query($connect, "SELECT * FROM berita WHERE $stradd AND Terbit='1' ORDER BY ID DESC LIMIT 0,10");
		while ($b = mysqli_fetch_array($sql)) {
			extract($b);

			echo '
			<div class="boxnews wow fadeInUp">
				<div class="img">
				<a href="./?open=detail&id=' . $ID . '">
					<img src="' . URL_SITUS . $Gambar . '">
					</a>
				</div>
				<div class="text">
				<h1 class="titleberita"><a href="./?open=detail&id=' . $ID . '">' . $Judul . '</a></h1>
				<p>' . substr(strip_tags($Isi), 0, 200) . '</p>
				</div>
				<button class="btnread">
					<a href="./?open=detail&id=' . $ID . '">Read more</a>
				</button>
				<div class="clear"></div>
			</div>

			';
		}



		?>


	</div>

	<div class="sidebar">

		<?php include 'sidebar.php'; ?>

	</div>

	<div class="clear"></div>
</div>

<div class="clear"></div>