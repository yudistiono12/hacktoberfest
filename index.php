<?php 
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}


require 'functions.php';

//pagination
//konfigurasi
// $jumlahDataPerHalaman = 5;
// $jumlahData = count(query("SELECT * FROM mahasiswa"));
// $jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);
// $halamanAktif = (isset($_GET["halaman"]))?$_GET["halaman"] : 1; //sama kayak if dibawah ini
// if (isset($_GET["halaman"])) {
// 	$halamanAktif = $_GET["halaman"];
// } else {
// 	$halamanAktif = 1;
// }
// $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
// var_dump($halamanAktif);
$mahasiswa = query("SELECT * FROM mahasiswa " );

if (isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>halaman utama</title>
</head>
<body>
	<a href="logout.php">logout</a>
	<h1>halaman admin</h1> <br>
	<h2><a href="registrasi.php">sign Up!</a></h2>
	<h2><a href="tambah.php">Tambah Data Baru</a></h2><br>
	<!-- <h3><a href="ubah.php">sign in!</a></h3><p>   </p> <h3>sign up!</h3> -->
	<form action="" method="post">
		<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword perncarian anda">
		<button type="submit" name="cari">Cari!</button>
	</form>
	<!-- <-- navigasi -->
	<!-- <?php if ($halamanAktif > 1) :?>
		<a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
	<?php endif; ?>
	<?php for ($i=1; $i <= $jumlahHalaman ; $i++) : ?>
		<?php if($i == $halamanAktif): ?>
			<a href="?halaman=<?= $i; ?>" style ="font-weight: bold; color: green;"><?= $i; ?></a>
		<?php else: ?>
			<a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>
	<?php if ($halamanAktif < $jumlahHalaman) :?>
		<a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
	<?php endif; ?> -->
	<!-- selesai navigasi --> 
	<br>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Usia</th>
			<th>Jenis Kelamin</th>
			<th>Prodi</th>
			<th>Jurusan</th>
			<th>gambar</th>
		</tr> 
		<?php $no = 1; ?>
		<?php foreach ($mahasiswa as $row): ?>
		<tr>
			<td><?= $no; ?></td>
			<td>
				<a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a>
				<a href="hapus.php?id=<?= $row["id"]; ?>" onclick = "return confirm ('yakin?');">hapus</a>
			</td>
			<td><?= $row['nama']; ?></td>
			<td><?= $row['alamat']; ?></td>
			<td><?= $row['usia']; ?></td>
			<td><?= $row['jenkel']; ?></td>
			<td><?= $row['prodi']; ?></td>
			<td><?= $row['jurusan']; ?></td>
			<td><img src="img/<?= $row['gambar']; ?> " width ="50"; ></td>
		</tr>
		<?php $no++; ?>
		<?php endforeach; ?>
	</table>
</body>
</html>