<?php
if (isset($_POST['add'])) {

	global $gambar;
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

		$path = PATH_GAMBAR . '/';

		if (isset($gambarfile) && isset($gambarfile_name)) {

			$gambarbaru = uniqid('', true) . "." . $_POST['judul'];


			$dest1 = '../' . $path . $gambarbaru . '.jpg';
			$dest2 = $path . $gambarbaru . '.jpg';

			move_uploaded_file($_FILES['gambar']['tmp_name'], $dest1);

			$gambar = $dest2;
		} else {

			$gambar = $_POST['gambar'];
		}
	}

	if ($_POST['aksi'] == 'tambah') {
		global $connect;
		$sql = "INSERT INTO berita (Judul,Isi,Kategori,Gambar,Teks,Tanggal,Viewnum,Updateby,Post_type,Terbit) VALUES ('" . $_POST['judul'] . "','" . $_POST['isi'] . "','" . $_POST['kategori'] . "','$gambar','" . $_POST['teks'] . "','" . date("Y-m-d H:i:s") . "','0','" . $_SESSION['loginadmin'] . "','berita','" . $_POST['terbit'] . "')";

		$hasil = mysqli_query($connect, $sql);
	}
	if ($_POST['aksi'] == 'edit') {
		global $connect;
		$sql = mysqli_query($connect, "UPDATE berita SET Judul='" . $_POST['judul'] . "',Isi='" . $_POST['isi'] . "',Kategori='" . $_POST['kategori'] . "',Gambar='$gambar',Teks='" . $_POST['teks'] . "',Terbit='" . $_POST['terbit'] . "' WHERE ID='" . $_POST['id'] . "' ");
	}
}

if (isset($_GET['act']) && $_GET['act'] == 'edit') {

	$id = (int)$_GET['id'];
	global $connect;

	$sql = mysqli_query($connect, "SELECT * FROM berita WHERE ID='$id' ");
	while ($b = mysqli_fetch_array($sql)) {
		extract($b);

		$id = $ID;
		$judul = $Judul;
		$kategori = $Kategori;
		$isi = $Isi;
		$gambar = $Gambar;
		$teks = $Teks;
		$tanggal = $Tanggal;
		$updateby = $Updateby;
		$terbit = $Terbit;

		if (isset($_GET['hapusgambar']) && $_GET['hapusgambar'] == 'yes') {
			unlink('../' . $gambar);
			$sqlupdate = mysqli_query($connect, "UPDATE berita SET Gambar='' WHERE ID='$id' ");

			echo '<meta http-equiv="REFRESH" content="0;url=./?mod=berita&act=edit&id=' . $id . '" />';
		}
	}
}

if (isset($_GET['act']) && $_GET['act'] == 'hapus') {

	$id = (int)$_GET['id'];
	global $connect;

	$sql = mysqli_query($connect, "SELECT * FROM berita WHERE ID='$id' ");
	while ($b = mysqli_fetch_array($sql)) {

		$gbr = $b['Gambar'];
		if (!empty($gbr->Gambar)) {
			unlink('../' . $gbr);
		}
		header("location: ?mod=berita");
	}

	$hapus = mysqli_query($connect, "DELETE FROM berita WHERE ID='$id' ");
}

?>
<div class="w100">
	<form action="./?mod=berita" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= (isset($id) ? $id : '') ?>">
		<input type="hidden" name="aksi" value="<?= (isset($id) ? 'edit' : 'tambah'); ?>">
		<fieldset class="berita mx-auto py-4">
			<h3 class="titleform">Tambah Berita</h3>

			<div class="formberita">
				<label>Judul</label>:<br>
				<input type="text" name="judul" placeholder="Judul berita" value="<?= (isset($judul) ? $judul : '') ?>" size="40" class="inputberita">
			</div>

			<div class="formberita">
				<label>Kategori</label>:<br>
				<select name="kategori" class="kotakpilihan">
					<option>Pilih kategori</option>
					<?php
					global $connect;
					$hasil = mysqli_query($connect, "SELECT * FROM kategori WHERE Terbit='1' ORDER BY ID DESC");
					while ($k = mysqli_fetch_array($hasil)) {

						echo '
					<option value="' . $k['alias'] . '" ' . ($kategori == $k['alias'] ? 'selected' : '') . ' >' . $k['Kategori'] . '</option>
					';
					}

					?>
				</select>
			</div>

			<div class="formberita">
				<label>Isi berita</label>:<br>
				<textarea name="isi" cols="80" rows="8" class="summernote"><?= (isset($isi) ? $isi : '') ?></textarea>

			</div>

			<div class="formberita">
				<label>Gambar</label>:<br>
				<?php
				if (!empty($gambar) && !empty($id)) {
					echo '
				<div class="imgsedang">
				<input type="hidden" name="gambar" value="' . $gambar . '">
				<img src="' . URL_SITUS . $gambar . '">
				<div class="imghapus"><a href="./?mod=berita&act=edit&hapusgambar=yes&id=' . $id . '">x</a></div>
				</div>

				';
				} else {

					echo '<input type="file" name="gambar" class="btnberita">';
				}

				?>

			</div>
			<div class="clear pd10"></div>

			<div class="formberita">
				<label>Teks</label>:<br>
				<textarea class="inputberita" name="teks" cols="30" rows="5"><?= (isset($teks) ? $teks : '') ?></textarea>
			</div>

			<div class="formberita">
				<label>Terbitkan</label>:<br>
				<select name="terbit" class="kotakpilihan">
					<option value="1" <?= ((isset($terbit) && $terbit == 1) ? 'selected' : '') ?>>Yes</option>
					<option value="0" <?= ((isset($terbit) && $terbit == 0) ? 'selected' : '') ?>>No</option>
				</select>
			</div>

			<input class="btntambah" type="submit" name="add" value="<?= (isset($id) ? 'Edit' : 'Tambah') ?>" class="btn-primary">

		</fieldset>

	</form>

</div>

<div class="clear"></div>

<div class="w100">
	<fieldset class="listkategori mx-auto mt-5">
		<h3 class="titleform">List Berita</h3>

		<table class="table table-success table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Judul</th>
					<th>Kategori</th>
					<th>Tanggal</th>
					<th>Aksi</th>
				</tr>
			</thead>

			<?php
			global $connect;

			$hasil = mysqli_query($connect, "SELECT * FROM berita ORDER BY ID DESC");
			while ($b = mysqli_fetch_array($hasil)) {
				extract($b);
			?>
				<tbody>
					<tr>
						<td><?= $ID; ?></td>
						<td><?= $Judul; ?></td>
						<td><?= $Kategori; ?></td>
						<td><?= $Tanggal; ?></td>
						<td>
							<a href="./?mod=berita&act=edit&id=<?= $ID; ?>" class="btnedit">edit</a><a href="./?mod=berita&act=hapus&id=<?= $ID; ?>" class="btndelete">hapus</a>
						</td>
					</tr>
				</tbody>
			<?php
			}
			?>

	</fieldset>
</div>