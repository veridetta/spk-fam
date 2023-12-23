<?php
session_start();

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login atau halaman beranda setelah logout
$_SESSION['pesan'] = array('jenis' => 'success', 'pesan' => 'Berhasil logout.');
header("Location: ../index.php?page=pub_login");
exit();
?>
