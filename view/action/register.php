<?php
include '../../config/db.php';

session_start();

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password, role) VALUES ('$nama', '$email', '$password', 'pelanggan')";

if ($koneksi->query($sql) === TRUE) {
    $_SESSION['pesan'] = array('jenis' => 'success', 'pesan' => 'Pendaftaran berhasil. Silakan login.');
    header("Location: ../index.php?page=pub_login");
    exit();
} else {
    $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Error: ' . $sql . '<br>' . $koneksi->error);
    header("Location: ../index.php?page=pub_daftar");
    exit();
}

$koneksi->close();
?>
