<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aplikasi Registrasi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header("Location: login.php");
	exit();
}

?>
<body>
	<main class="container">
		<h1 class="text-center mt-5">ABSENSI MAHASISWA</h1>
		<div class="row justify-content-between">
			<div class="col-md-6 card mt-3">
				<div class="card-body text-center">
					<h4 class="mb-5">Daftar Guru dan Mahasiswa</h4>
					<a href="daftar.php" class="btn btn-danger d-block">Lihat daftar</a>
				</div>
			</div>
			<div class="col-md-6 card mt-3">
				<div class="card-body text-center">
					<h4 class="mb-5">ABSENSI</h4>
					<a href="absensi.php" class="btn btn-danger d-block">Lakukan Absensi</a>
				</div>
			</div>
		</div>
		<div class="mx-auto text-center mt-3">
			<a href="logout.php" class="btn btn-danger">Logout</a>
		</div>
	</main>
</body>
</html>