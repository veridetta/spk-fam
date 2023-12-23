<?php
//cek role admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header('Location: index.php?page=pub_login');
}
?>
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Tambah Sub Kriteria</h2>
            </div>
            <div class="card-body">
                <form action="action/sub_kriteria_tambah.php" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="kriteria" class="form-label">Kriteria</label>
                        <?php $kategori = mysqli_query($koneksi, "SELECT * FROM kriteria"); ?>
                        <select class="form-select" id="kriteria" name="kriteria" required>
                            <option value="">Pilih Kriteria</option>
                            <?php while ($row = mysqli_fetch_array($kategori)) : ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
    </div>