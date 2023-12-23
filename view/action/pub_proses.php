<?php
session_start();
include '../../config/db.php';

// Pengecekan apakah pengguna sudah login atau belum
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    if($role == 'pelanggan') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['jawaban']) && is_array($_POST['jawaban'])) {
                // Insert into quisioner table
                $input =  $koneksi->query("INSERT INTO quisioner (user_id, date_submit) VALUES ('$user_id', NOW())");
        
                // // Get the quisioner_id of the last inserted row
                $quisioner_id = $koneksi->insert_id;
        
                foreach ($_POST['jawaban'] as $sub_kriteria_id => $nilai) {
                    // Assuming you have a function insertQuisionerDetail in your db.php file
                    $insert = $koneksi->query("INSERT INTO quisioner_detail (user_id, quisioner_id, sub_kriteria_id, nilai) 
                                    VALUES ('$user_id', '$quisioner_id', '$sub_kriteria_id', '$nilai')");
                }
                $_SESSION['pesan'] = ['jenis' => 'success', 'pesan' => 'Quisioner berhasil diisi.'];
                header('Location: ../index.php?page=pub_testimoni');
                exit();
            }else{
                $_SESSION['pesan'] = ['jenis' => 'danger', 'pesan' => 'Quisioner gagal diisi.'];
                header('Location: ../index.php?page=pub_quisioner');
                exit();
            }
        }else{
            $_SESSION['pesan'] = ['jenis' => 'danger', 'pesan' => 'Quisioner gagal diisi.'];
            header('Location: ../index.php?page=pub_quisioner');
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
