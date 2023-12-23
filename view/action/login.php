<?php
session_start();
include '../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Menjalankan query untuk mendapatkan data pengguna berdasarkan email
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Memeriksa password
        if (password_verify($password, $row['password'])) {
            // Login berhasil, simpan informasi pengguna dalam sesi
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: ../index.php?page=admin_beranda");
            } else {
                header("Location: ../index.php?page=pub_beranda");
            }
            exit();
        } else {
            $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Password salah.');
            header("Location: ../index.php?page=pub_login");
            exit();
        }
    } else {
        $_SESSION['pesan'] = array('jenis' => 'danger', 'pesan' => 'Email tidak ditemukan.');
        header("Location: ../index.php?page=pub_login");
        exit();
    }
}

$koneksi->close();
?>
