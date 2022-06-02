<?php
if (isset($_POST['tambahkategori'])) {

	global $connect;

	$hasil = mysqli_query($connect, "INSERT INTO kategori (Kategori,alias,Terbit) VALUES ('" . $_POST['kategori'] . "','" . $_POST['alias'] . "','" . $_POST['terbit'] . "') ");
}

if (isset($_POST['editkategori'])) {

	global $connect;

	$hasil = mysqli_query($connect, "UPDATE kategori SET Kategori='" . $_POST['kategori'] . "',alias='" . $_POST['alias'] . "',Terbit='" . $_POST['terbit'] . "' WHERE ID='" . $_POST['ID'] . "' ");
}


if (isset($_GET['act']) && $_GET['act'] == 'edit') {

	$id = (int)$_GET['id'];

	global $connect;
	$sql = mysqli_query($connect, "SELECT * FROM kategori WHERE ID = '$id' ");
	while ($r = mysqli_fetch_array($sql)) {
		extract($r);

		$kategori = $Kategori;
		$alias = $alias;
		$terbit = $Terbit;
		$ID = $ID;
	}
}

if (isset($_GET['act']) && $_GET['act'] == 'hapus') {

	$id = (int)$_GET['id'];

	global $connect;

	$sql = mysqli_query($connect, "DELETE FROM kategori WHERE ID = '$id' ");
}

?>

<div class="w100">
	<form action="./?mod=kategori" method="POST">

		<input type="hidden" name="ID" value="<?= (isset($ID) ? $ID : ''); ?>">

		<fieldset class="formkategori mx-auto">
			<h3 class="titleform">Tambah Kategori</h3>
			<div class="inputkategori">
				<div class="formnama">Kategori : <br>
					<input type="text" name="kategori" placeholder="Nama Kategori" value="<?= (isset($kategori) ? $kategori : ''); ?>" class="kotakinput" required>
				</div>
				<div class="formnama">Alias : <br>
					<input type="text" name="alias" placeholder="Alias" value="<?= (isset($alias) ? $alias : ''); ?>" class="kotakinput" required>
				</div>
				<div class="formnama">Tampilkan : <br>

					<select name="terbit" class="kotakpilihan">
						<option value="1" <?= ((isset($terbit) && $terbit == 1) ? 'selected' : ''); ?>>Yes</option>
						<option value="0" <?= ((isset($terbit) && $terbit == 0) ? 'selected' : ''); ?>>No</option>
					</select>

				</div>
				<input type="submit" name="<?= (isset($ID) ? 'editkategori' : 'tambahkategori'); ?>" value="<?= (isset($ID) ? 'Edit' : 'Tambah'); ?>" class="btnkategori">
			</div>
		</fieldset>
	</form>

</div>

<div class="w100">
	<fieldset class="listkategori mx-auto mt-5">
		<legend class="titleform">List Kategori</legend>

		<table class="table table-success table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Kategori Name</th>
					<th>Alias</th>
					<th>Aksi</th>
				</tr>
			</thead>

			<?php

			global $connect;

			$sql = mysqli_query($connect, "SELECT * FROM kategori ORDER BY ID DESC");
			while ($r = mysqli_fetch_array($sql)) {
				extract($r);
			?>
				<tbody>
					<tr>
						<td><?= $ID ?></td>
						<td><?= $Kategori ?></td>
						<td><?= $alias ?></td>
						<td>
							<a href="./?mod=kategori&act=edit&id=<?= $ID ?>" class="btnedit">Edit</a> <a href="./?mod=kategori&act=hapus&id=<?= $ID ?>" class="btndelete">Delete</a>
						</td>
					</tr>
				</tbody>
			<?php
			}
			?>

	</fieldset>
</div>