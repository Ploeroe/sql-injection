<div class="mainpage">

	<div class="content">

		<?php

		$id = (isset($_GET['id']) ? $_GET['id'] : '');

		global $connect;

		$sql = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' AND ID = '" . $id . "' ");
		while ($b = mysqli_fetch_array($sql)) {
			extract($b);

			$Updateviewnum = mysqli_query($connect, "UPDATE berita SET Viewnum=Viewnum+1 WHERE ID = '" . $id . "' ");

			echo '
		<div class="detail wow fadeInUp" data-wow-delay="0.6s" data-aos="fade-up"  data-aos-duration="1000">
			<h5 class="kategoriberita">' . $Kategori . '</h5>
			<h2 class="judulberita">' . $Judul . '</h2>

			<div class="info mb-5">
				<span> Tanggal: ' . $Tanggal . ' </span> | <span> Update by: ' . $Updateby . ' </span>
			</div>
			 <div class="img">
			 	<img width="100%" src="' . URL_SITUS . $Gambar . '">
			 	<div class="teks-foto">' . $Teks . '</div>
			 </div>
			 
			 <p>' . nl2br($Isi) . '</p>
			 <div class="clear"></div>
		</div>

		';
		}
		?>
		<div class="clear"></div>

		<?php
		include 'comment.php'
		?>

	</div>

	<div class="sidebar">

		<?php
		include 'sidebar.php';
		?>

	</div>

	<div class="clear"></div>

</div>