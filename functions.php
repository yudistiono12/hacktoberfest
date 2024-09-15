<?php 

$conn = mysqli_connect("localhost", "root", "", "latihanphp");


function query ($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}


function tambah ($data) {
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$usia = htmlspecialchars($data["usia"]);
	$jenkel = htmlspecialchars($data["jenkel"]);
	$prodi = htmlspecialchars($data["prodi"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

	//upload gambar
	$gambar = upload();
	if(!$gambar){
		return false;
	}


	$query = "INSERT INTO mahasiswa
					VALUES ('', '$nama','$alamat', '$usia', '$jenkel', '$prodi', '$jurusan', '$gambar')

				";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function upload() {
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	//cek ada gambar diupload apa tidak
	if ($error === 4) {
		echo "
			<script>
			alert ('pilih gambar terlebih dahulu')
			</script>
		";
		return false;
	}
	//cek upload ini gambar atau bukan

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			 </script>";
			 return false; 
	}

	//cek jika ukurannya terlalu besar 
	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			 </script>";
			 return false;
	}
	//lolos di cek 
	//generetae nama gambar baru

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

	return $namaFileBaru;
}



function hapus ($id) {
	global $conn;
	mysqli_query ($conn, "DELETE FROM mahasiswa WHERE id = $id");

	return mysqli_affected_rows($conn);
}


function ubah ($data){
	global $conn;
	$id = $data['id'];
	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$usia = htmlspecialchars($data["usia"]);
	$jenkel = htmlspecialchars($data["jenkel"]);
	$prodi = htmlspecialchars($data["prodi"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	//cek apakah user ganta gambar baru
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE  mahasiswa SET
					nama = '$nama',
					alamat = '$alamat',
					usia = '$usia',
					jenkel = '$jenkel',
					prodi = '$prodi',
					jurusan = '$jurusan',
					gambar = '$gambar'
				WHERE id = $id
				";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function cari($keyword) {
	$query = "SELECT * FROM mahasiswa
				WHERE
				nama LIKE '%$keyword%' OR
				alamat LIKE '%$keyword%' OR
				usia LIKE '%$keyword%' OR
				jenkel LIKE '%$keyword%' OR
				prodi LIKE '%$keyword%' OR
				jurusan LIKE '%$keyword%' OR
				gambar LIKE '%$keyword%'
			";
	return query($query);
}

function registrasi ($data) {
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$email = strtolower(stripcslashes($data["email"]));
	//cek username sudah apa belom di database
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "
				<script>
				alert ('mohon maaf username sudah terdaftar!')
				</script>";
		return false;
	}
	//cek passqord sama dengan konfirmasinya

	if ($password !== $password2) {
		echo "
				<script>
				alert ('konfirmasi password tidak sesuai');
				</script>
				";
		return false;
	}

	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	//tambahkan user baru ke database

	mysqli_query ($conn, "INSERT INTO user VALUES('', '$username', '$password', '$email')");

	return mysqli_affected_rows($conn);
}

?>