<?php
//cek role admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header('Location: index.php?page=pub_login');
}
?>
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Tambah Implementasi Aturan</h2>
            </div>
            <div class="card-body">
                <form action="action/sign_rule_tambah.php" method="post">
                <div class="mb-3">
                        <label for="rule" class="form-label">Aturan</label>
                        <select class="form-select" id="rule" name="rule" required>
                            <option value="">Pilih Aturan</option>
                            <?php $arr = ["Tidak Puas", "Kurang Puas", "Cukup Puas", "Puas", "Sangat Puas"]; ?>
                            <?php for( $i = 0; $i < count($arr); $i++ )
                            {
                                echo "<option value='$arr[$i]'>$arr[$i]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kriteria_id" class="form-label">Kriteria</label>
                        <?php $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria"); ?>
                        <select class="form-select" id="kriteria_id" name="kriteria_id" required>
                            <option value="">Pilih Kriteria</option>
                            <?php while ($row = mysqli_fetch_array($kriteria)) : ?>
                                <option value="<?php echo $row['id']; ?>" ><?php echo $row['nama']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nilai_min" class="form-label">Skor</label>
                        <input type="number" class="form-control" id="nilai_min" name="nilai_min" required value="<?php echo $subkriteria['nilai_min']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nilai_max" class="form-label">Skor</label>
                        <input type="number" class="form-control" id="nilai_max" name="nilai_max" required value="<?php echo $subkriteria['nilai_max']; ?>">
                    </div>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </form>
            </div>
        </div>
    </div>