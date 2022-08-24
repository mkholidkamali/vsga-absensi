<?php

$server     = "localhost";
$user       = "tugas";
$password   = "tugas";
$nama_database = "vsga";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}
?>