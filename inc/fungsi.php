<?php
include 'koneksi.php';

function getprofilweb($tax)
{
	global $connect;

	$hasil = mysqli_query($connect, "SELECT * FROM konfigurasi WHERE Tax='$tax' ORDER BY ID DESC LIMIT 1");
	while ($r = mysqli_fetch_array($hasil)) {
		return $r['Isi'];
	}
}


// Berita diurutkan secara 
function populer()
{
?>
	<!--berita populer-->
	<div class="">

		<h1 class="todaynews wow fadeInRight" data-wow-delay="0.6s" data-aos="fade-left" data-aos-duration="1000">Top News</h1>
		<div class="populer" data-aos="fade-up" data-aos-duration="1000">
			<?php
			global $connect;

			$pop = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' AND Tanggal>='" . date('Y-m-d H:i:s', strtotime('' . POPULER_TIME . ' days')) . "' ORDER BY Viewnum DESC LIMIT 0,10");

			while ($r = mysqli_fetch_array($pop)) {
				extract($r);

				echo '
				<div class="side-box">
				<div class="img">
				<a href="./?open=detail&id=' . $ID . '">
				<img src="' . URL_SITUS . $Gambar . '">
				</a>
				</div>
				<span>' . substr($Tanggal, 0, 10) . ' | view: <b>' . $Viewnum . '</b> </span>
				
				<h1><a href="./?open=detail&id=' . $ID . '">' . $Judul . '</a></h1>
				<div class="clear"></div>
				</div>
				
				';
			}

			?>

		</div>
	</div>
	<!--/berita populer-->
<?php

}


// Berita diurutkan secara waktu terbit
function beritaterbaru()
{
?>
	<!--berita terkini-->
	<div class=>

		<h1 class="todaynews wow fadeInRight" data-wow-delay="0.6s" data-aos="fade-left" data-aos-duration="1000">Hot News</h1>
		<div class="populer" data-aos="fade-up" data-aos-duration="1000">
			<?php
			global $connect;

			$terkini = mysqli_query($connect, "SELECT * FROM berita WHERE Terbit='1' ORDER BY ID DESC LIMIT 0,10");

			while ($r = mysqli_fetch_array($terkini)) {
				extract($r);

				echo '
				<div class="side-box">
					<div class="img">
					<a href="./?open=detail&id=' . $ID . '">
					<img src="' . URL_SITUS . $Gambar . '">
					</a>
					</div>
					<span>' . substr($Tanggal, 0, 10) . ' </span>
					
					<h1><a href="./?open=detail&id=' . $ID . '">' . $Judul . '</a></h1>
					<div class="clear"></div>
					</div>

					';
			}

			?>

		</div>
	</div>
	<!--/berita terkini-->
<?php

}

?>