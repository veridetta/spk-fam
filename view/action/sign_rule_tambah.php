<?php
session_start();
include '../../config/db.php';

// Pengecekan apakah pengguna sudah login atau belum
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    if($role == 'admin') {
        // Ambil data dari form
        $nilai_max = $_POST['nilai_max'];
        $nilai_min = $_POST['nilai_min'];
        $kriteria_id = $_POST['kriteria_id'];
        $rule_id = $_POST['rule'];
        //cek kosong
        if(strlen($skor)<1){
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data tidak boleh kosong.');
            header("Location: ../index.php?page=admin_sign_rule_tambah");
            exit();
        }
        // Query SQL untuk tambah data kriteria
        $sql = "INSERT INTO assign_rule (nilai_max, nilai_min, kriteria_id, kepuasan) VALUES ('$nilai_max','$nilai_min', '$kriteria_id', '$rule_id')";
        if ($koneksi->query($sql) === TRUE) {
            $_SESSION['pesan'] = array('jenis' => 'success', 'pesan' => 'Data implementasi aturan berhasil ditambahkan.');
            header("Location: ../index.php?page=admin_sign_rule");
            exit();
        } else {
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data implementasi aturan gagal ditambahkan.'. $koneksi->error);
            header("Location: ../index.php?page=admin_sign_rule_tambah");
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
