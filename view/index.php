<!DOCTYPE html>
<html lang="en">
<?php
//require db
require '../config/db.php';
session_start();

$pesan = isset($_SESSION['pesan']) ? $_SESSION['pesan'] : '';

// Hapus pesan sesi agar tidak ditampilkan lagi
unset($_SESSION['pesan']);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI MONI - Beranda</title>
    <link rel="shortcut icon" href="https://via.placeholder.com/50" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css"  />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

</head>

<body>
    <!-- Include Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- Konten Halaman Beranda -->
    <?php
     //cek request page
     if(isset($_GET['page'])){
        $page = $_GET['page'].'.php';
        if(file_exists($page)){
            if(isset($_SESSION['user_id'])){
                if($_SESSION['role'] == 'admin'){
                    ?>
                    <div class="row w-100" style="min-height: 70vh;">
                        <div class="col-md-3 col-lg-3">
                            <?php include 'sidebar.php'; ?>
                        </div>
                        <div class="col-md-9 col-lg-9">
                            <div class="mt-2">
                                <?php include 'message.php';?>
                            </div>
                            <?php include $page; ?>
                            <?php include 'footer.php';?>
                        </div>
                    </div>
                    <?php
                }else{
                    include 'message.php';
                    include $page;
                    include 'footer.php';
                }
            }else{
                include 'message.php';
                include $page;
                include 'footer.php';
            }
        }else{
            echo "<h1>404 Not Found</h1>";
            include 'footer.php';
         }
     }else{
      ?>
        <div class="container mt-4" style="min-height: 70vh;">
            <h1>Selamat Datang di SI MONI</h1>
            <p>Sistem Informasi Testimoni (SI MONI) sebagai alat evaluasi kepuasan pelanggan pada toko parfum menggunakan metode FAM.</p>
            <p>Daftarkan diri Anda sekarang untuk memberikan testimoni!</p>
            <a href="daftar.php" class="btn btn-primary">Daftar Sekarang</a>
        </div>
        <!-- Include Footer -->
        <?php include 'footer.php'; ?>
      <?php
    }
    ?>

</body>

</html>
