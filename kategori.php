<div class="mainpage">

	<div class="content">

		<?php
		global $connect;

		$catid = (isset($_GET['id']) ? $_GET['id'] : '');

		$resultkategori = mysqli_query($connect, "SELECT * FROM kategori WHERE ID='" . $catid . "'");
		$KategoriBerita = mysqli_fetch_assoc($resultkategori);

		$getalias = mysqli_query($connect, "SELECT * FROM kategori WHERE ID='" . $catid . "'");
		while ($al = mysqli_fetch_array($getalias)) {
			$sql = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' AND Kategori='" . $al['alias'] . "' ORDER BY ID DESC LIMIT 0,10");

			echo '<h1 class="todaynews wow fadeInUp" data-wow-delay="0.8s">' . $KategoriBerita['Kategori'] . '</h1>';

			while ($b = mysqli_fetch_array($sql)) {
				extract($b);

				echo '
			<div class="boxnews wow fadeInUp" data-wow-delay="0.8s">
			<div class="img">
				<img src="' . URL_SITUS . $Gambar . '">
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
		}
		?>


	</div>

	<div class="sidebar">

		<?php include 'sidebar.php'; ?>

	</div>

	<div class="clear"></div>
</div>

<div class="clear"></div>