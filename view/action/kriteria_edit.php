<?php
session_start();
include '../../config/db.php';

// Pengecekan apakah pengguna sudah login atau belum
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    if($role == 'admin') {
        // Ambil data dari form
        $nama = $_POST['nama'];
        $kode = $_POST['kode'];
        $keterangan = $_POST['keterangan'];
        $id = $_POST['id'];
        //cek kosong
        if(empty($nama) || empty($kode)){
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data tidak boleh kosong.');
            header("Location: ../index.php?page=admin_kriteria_edit&id=$id");
            exit();
        }
        // Query SQL untuk ubah data kriteria
        $sql = "UPDATE kriteria SET nama = '$nama', kode = '$kode', keterangan = '$keterangan' WHERE id = '$id'";
        if ($koneksi->query($sql) === TRUE) {
            $_SESSION['pesan'] = array('jenis' => 'success', 'pesan' => 'Data kriteria berhasil diubah.');
            header("Location: ../index.php?page=admin_kriteria");
            exit();
        } else {
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data kriteria gagal diubah.');
            header("Location: ../index.php?page=admin_kriteria_edit&id=$id");
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
