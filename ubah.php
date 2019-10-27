<?php

session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} 

require 'functions.php';

//ambil data di url
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
// var_dump($mhs);
if (isset($_POST['submit'])) {
	if (ubah($_POST) > 0) {
		echo "
				<script> 
					alert ('data berhasil diubah');
					document.location.href = 'index.php';
				</script>

			";
	} else {
		echo "
				<script> 
					alert ('data gagal diubah');
					document.location.href = 'index.php';
				</script>

			";
	}
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Mahasiswa</title>
</head>
<body>
	<h1>Halaman Ubah Data</h1>
	<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
	<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
	<ul>
		<li>
			<label for="nama">Nama :</label>
			<input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
		</li>
		<li>
			<label for="alamat">Alamat :</label>
			<input type="text" name="alamat" id="alamat" required value="<?= $mhs["alamat"]; ?>">
		</li>
		<li>
			<label for="usia"> usia :</label>
			<input type="text" name="usia" id="usia" required value="<?= $mhs["usia"]; ?>">
		</li>
		<li>
			<label for="jenkel">Jenis Kelamin :</label>
			<input type="text" name="jenkel" id="jenkel" required value="<?= $mhs["jenkel"]; ?>">
		</li>
		<li>
			<label for="prodi">Prodi :</label>
			<input type="text" name="prodi" id="prodi" required value="<?= $mhs["prodi"]; ?>">
		</li>
		<li>
			<label for="jurusan">Jurusan :</label>
			<input type="text" name=" jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
		</li>
		<li>
			<label for="gambar">gambar :</label>
			<img src="img/<?= $mhs["gambar"];?>" width="40">
			<input type="file" name="gambar" id="gambar"> 
		</li>
		<li>
			<button name="submit">Ubah Data!</button>
		</li>
	</ul>
	</form>
</body>
</html>