<?php
$host = 'localhost';
$db   = 'si';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
     die("Koneksi ke database gagal: " . mysqli_connect_error());
 }
 
//  echo "Koneksi ke database berhasil";
?>
