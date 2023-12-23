<?php
session_start();
include '../../config/db.php';

// Pengecekan apakah pengguna sudah login atau belum
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    if($role == 'admin') {
        // Ambil data dari form
        $nilai_min = $_POST['nilai_min'];
        $nilai_max = $_POST['nilai_max'];
        $kriteria_id = $_POST['kriteria_id'];
        $rule_id = $_POST['rule'];
        $id = $_POST['id'];

        //cek kosong
        if(strlen($skor)<1){
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data tidak boleh kosong.');
            header("Location: ../index.php?page=admin_sign_rule_edit&id=$id");
            exit();
        }
        // Query SQL untuk ubah data subkriteria
        $sql = "UPDATE assign_rule SET nilai_max = '$nilai_max', nilai_min='$nilai_min', kriteria_id = '$kriteria_id', rule_id = '$rule_id' WHERE id = '$id'";
        if ($koneksi->query($sql) === TRUE) {
            $_SESSION['pesan'] = array('jenis' => 'success', 'pesan' => 'Data implementasi aturan berhasil diubah.');
            header("Location: ../index.php?page=admin_sign_rule");
            exit();
        } else {
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Data implementasi aturan gagal diubah.');
            header("Location: ../index.php?page=admin_sign_rule_edit&id=$id");
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
