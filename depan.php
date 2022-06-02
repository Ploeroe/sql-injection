<div class="mainpage">

	<?php
	include 'swiper.php';
	?>
	<div class="content wow fadeInUp">
		<h1 class="todaynews wow fadeInLeft" data-aos="fade-right" data-aos-duration="1000">Today News</h1>
		<?php
		global $connect;

		$sql = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' ORDER BY ID DESC LIMIT 0,10");
		while ($b = mysqli_fetch_array($sql)) {
			extract($b);

			echo '
		<div class="boxnews" data-aos="fade-up"  data-aos-duration="1000">
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

		<?php
		include 'sidebar.php';
		?>

	</div>

	<div class="clear"></div>

</div>