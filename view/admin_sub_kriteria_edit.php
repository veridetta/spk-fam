<?php
//cek role admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header('Location: index.php?page=pub_login');
}
?>
<?php
if (!isset($_GET['id'])) {
    // Redirect atau tampilkan pesan kesalahan jika tidak ada ID yang diberikan
    header("Location: ?page=admin_sub_kriteria");
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM sub_kriteria WHERE id = '$id'";
$result = $koneksi->query($sql);
if ($result->num_rows > 0) {
    $subkriteria = $result->fetch_assoc();
} else {
    // Redirect atau tampilkan pesan bahwa data tidak ditemukan
    header("Location: ?page=admin_sub_kriteria");
    exit();
}
?>
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Ubah Sub Kriteria</h2>
            </div>
            <div class="card-body">
                <form action="action/sub_kriteria_edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $subkriteria['id']; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $subkriteria['nama']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required value="<?php echo $subkriteria['kode']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="kriteria" class="form-label">Kriteria</label>
                        <?php $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria"); ?>
                        <select class="form-select" id="kriteria" name="kriteria" required>
                            <option value="">Pilih Kriteria</option>
                            <?php while ($row = mysqli_fetch_array($kriteria)) : ?>
                                <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $subkriteria['id_kriteria']) echo 'selected' ?>><?php echo $row['nama']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
    </div>