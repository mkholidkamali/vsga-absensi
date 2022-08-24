<?php
session_start();

require_once "./koneksi.php";

if (!isset($_SESSION['loggedin'])) {
	header("Location: login.php");
	exit();
}

if ($_POST != []) {
    $name = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];

    $sql = "INSERT INTO mahasiswa (name, jenis_kelamin, jurusan) VALUE ('$name', '$jenis_kelamin', '$jurusan')";

    try {
        $result = mysqli_query($db, $sql);

        if ($result) {
            header('Location: daftar.php');
            exit();
        } else {
            echo "Gagal";
        }
    } catch (\Exception $err) {
        var_dump($err);
        exit();
    }

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
    <h1 class="text-center mt-5">Tambah Mahasiswa</h1>
	<main class="container">
        <div class="card col-6 mx-auto">
            <div class="card-body">
                <form action="" method="post">
                    <div class="my-2">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select type="option" name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="PRIA">Pria</option>
                            <option value="WANITA">Wanita</option>
                        </select>
                    </div>
                    <div class="my-2">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select type="option" name="jurusan" id="jurusan" class="form-control" required>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-block btn-danger mt-4">Tambah</button>
                </form>
            </div>
        </div>
	</main>
</body>
</html>