<?php
    if(!isset($_SESSION['user_id']) && $_SESSION['role'] != 'pelanggan'){
        header('Location: ?page=pub_login');
    }
    $hasQuiz = $koneksi->query("SELECT * FROM quisioner WHERE user_id = {$_SESSION['user_id']}")->num_rows;
?>
<div class="container mt-4" style="min-height: 70vh;">
    <h1>Selamat Datang <?php echo $_SESSION['username'];?></h1>
    <p>Sistem Informasi Testimoni (SI MONI) sebagai alat evaluasi kepuasan pelanggan pada toko parfum menggunakan metode FAM.</p>
    <p>Daftarkan diri Anda sekarang untuk memberikan testimoni!</p>
    <?php
        if($hasQuiz > 0){
            ?>
            <a href="?page=pub_testimoni" class="btn btn-primary">Lihat Testimoni</a>
            <?php
        }else{
            ?>
            <a href="?page=pub_quisioner" class="btn btn-primary">Isi Quisioner</a>
            <?php
        }
    ?>
</div>
