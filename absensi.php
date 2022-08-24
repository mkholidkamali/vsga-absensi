<?php
session_start();

require_once "./koneksi.php";

if (!isset($_SESSION['loggedin'])) {
	header("Location: login.php");
	exit();
}

if ($_POST != []) {
    $absensi = $_POST['absensi'];
    $no = $_POST['no'];
    $sql = "UPDATE mahasiswa SET absensi = $absensi WHERE id = $no";
    mysqli_query($db, $sql);
}

$sql2 = "SELECT * FROM mahasiswa";
$mahasiswaResult = mysqli_query($db, $sql2);
$mahasiswa = mysqli_fetch_all($mahasiswaResult);
$mahasiswaShow = false;
if ($mahasiswa != []) {
	$mahasiswaShow = true;
}

?>
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
<body>
	<main class="container">
		<h1 class="text-center mt-5">ABSENSI MAHASISWA</h1>
        <div class="mx-auto text-center">
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card mt-3 mx-auto">
            <div class="card-body text-center">
                <h4 class="mb-1">Daftar Mahasiswa</h4>
                <div class="row my-2">
                    <table class="table table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jumlah Absensi</th>
                                <th scope="col">Jumlah Pertemuan</th>
                                <th scope="col">Nilai Kehadiran</th>
                                <th scope="col">Absensi</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($mahasiswaShow == true) { ?>
                                <?php $i=1; foreach ($mahasiswa as $m) { ?>
                                    <tr>
                                        <th scope="row"><?= $i++ ?></th>
                                        <td><?= $m[1] ?></td>
                                        <td><?= $m[4] ?></td>
                                        <td>7</td>
                                        <td><?php if($m[4]>=5){echo"A";}else if($m[4]>=3&&$m[4<5]){echo"B";}else{echo"C";} ?></td>
                                        <form action="" method="post">
                                        <td>
                                            <input type="number" name="absensi" class="form-control">
                                            <input type="hidden" name="no" value="<?= $m[0] ?>">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success">Terima</button>
                                        </td>
                                        </form>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</main>
</body>
</html>