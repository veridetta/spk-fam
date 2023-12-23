<?php
//cek role admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header('Location: index.php?page=pub_login');
}
?>
<?php
if (!isset($_GET['id'])) {
    // Redirect atau tampilkan pesan kesalahan jika tidak ada ID yang diberikan
    header("Location: ?page=admin_kriteria");
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM rule WHERE id = '$id'";
$result = $koneksi->query($sql);
if ($result->num_rows > 0) {
    $kriteria = $result->fetch_assoc();
} else {
    // Redirect atau tampilkan pesan bahwa data tidak ditemukan
    header("Location: ?page=admin_kriteria");
    exit();
}
?>
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Ubah Aturan</h2>
            </div>
            <div class="card-body">
                <form action="action/rule_edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $kriteria['id']; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $kriteria['nama']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required value="<?php echo $kriteria['kode']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <input type="number" class="form-control" id="nilai" name="nilai" required value="<?php echo $kriteria['nilai']; ?>">
                    </div>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
    </div>