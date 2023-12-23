<?php
$host = "localhost:1235"; // Ganti sesuai host database Anda
$username = "root"; // Ganti sesuai username database Anda
$password = ""; // Ganti sesuai password database Anda
$database = "spk_simoni"; // Ganti sesuai nama database Anda

// Membuat koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>
