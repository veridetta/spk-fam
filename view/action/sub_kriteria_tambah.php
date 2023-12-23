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
        $kriteria = $_POST['kriteria'];
        //cek kosong
        if(empty($nama) || empty($kode)){
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data tidak boleh kosong.');
            header("Location: ../index.php?page=admin_sub_kriteria_tambah");
            exit();
        }
        // Query SQL untuk tambah data kriteria
        $sql = "INSERT INTO sub_kriteria (nama, kode, id_kriteria) VALUES ('$nama', '$kode', '$kriteria')";
        if ($koneksi->query($sql) === TRUE) {
            $_SESSION['pesan'] = array('jenis' => 'success', 'pesan' => 'Data sub kriteria berhasil ditambahkan.');
            header("Location: ../index.php?page=admin_sub_kriteria");
            exit();
        } else {
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data sub kriteria gagal ditambahkan.');
            header("Location: ../index.php?page=admin_sub_kriteria_tambah");
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
