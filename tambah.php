<?php 
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

if (isset($_POST['submit'])) {
	if (tambah($_POST) > 0) {
		echo "
				<script> 
					alert ('data berhasil ditambahkan');
					document.location.href = 'index.php';
				</script>

			";
	} else {
		echo "
				<script> 
					alert ('data gagal ditambahkan');
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
	<h1>Halaman Tambah Data Baru</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<li>
			<label for="nama">Nama :</label>
			<input type="text" name="nama" id="nama">
		</li>
		<li>
			<label for="alamat">Alamat :</label>
			<input type="text" name="alamat" id="alamat">
		</li>
		<li>
			<label for="usia"> usia :</label>
			<input type="text" name="usia" id="usia">
		</li>
		<li>
			<label for="jenkel">Jenis Kelamin :</label>
			<input type="text" name="jenkel" id="jenkel">
		</li>
		<li>
			<label for="prodi">Prodi :</label>
			<input type="text" name="prodi" id="prodi">
		</li>
		<li>
			<label for="jurusan">Jurusan :</label>
			<input type="text" name=" jurusan" id="jurusan">
		</li>
		<li>
			<label for="gambar">gambar :</label>
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<button name="submit">Tambah Data!</button>
		</li>
	</form>
</body>
</html>