<?php
session_start();
include '../../config/db.php';

// Pengecekan apakah pengguna sudah login atau belum
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    if($role == 'admin') {
        $id = $_GET['id'];
        // Query SQL untuk hapus data subkriteria
        $sql = "DELETE FROM sub_kriteria WHERE id = '$id'";
        if ($koneksi->query($sql) === TRUE) {
            $_SESSION['pesan'] = array('jenis' => 'success', 'pesan' => 'Data sub kriteria berhasil dihapus.');
            header("Location: ../index.php?page=admin_sub_kriteria");
            exit();
        } else {
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data sub kriteria gagal dihapus.');
            header("Location: ../index.php?page=admin_sub_kriteria");
            exit();
        }

    } else {
        // Pengguna adalah pengguna biasa, lanjutkan ke halaman pengguna biasa
        header("Location: ../index.php?page=pub_beranda");
        exit();
    }
} else {
    // Pengguna belum login, arahkan ke halaman login
    header("Location: ../index.php?page=pub_login");
    exit();
}

$koneksi->close();
?>
