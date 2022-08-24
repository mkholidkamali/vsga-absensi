<?php

session_start();

require_once "./koneksi.php";

if (!isset($_SESSION['loggedin'])) {
	header("Location: login.php");
	exit();
}

$no = $_GET['no'];
if ($_GET == []) {
    header("Location: daftar.php");
    exit();
}

$sql = "DELETE FROM guru WHERE id = $no";
try {
    $result = mysqli_query($db, $sql);
    header("Location: daftar.php");
    exit();
} catch (Exception $err ) {
    var_dump($err);
    exit();
}

?>