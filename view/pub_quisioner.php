<?php
    if(!isset($_SESSION['user_id']) && $_SESSION['role'] != 'pelanggan'){
        header('Location: ?page=pub_login');
    }
    $hasQuiz = $koneksi->query("SELECT * FROM quisioner WHERE user_id = {$_SESSION['user_id']}")->num_rows;
    if($hasQuiz > 0){
        header('Location: ?page=pub_testimoni');
    }
    $kriteria = $koneksi->query("SELECT * FROM kriteria");
?>
<div class="container mt-4" style="min-height: 70vh;">
    <div class="col-12">
        <p class="h1">Quisioner Pelanggan</p>
        <p class="lead">Isi quisioner berikut untuk memberikan testimoni Anda.</p>
        <form action="action/pub_proses.php" method="post">
            <table class="table table-bodered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Quisioner</th>
                        <th>Sangat Setuju (SS)</th>
                        <th>Setuju (S)</th>
                        <th>Ragu-ragu (RR)</th>
                        <th>Kurang Setuju (KS)</th>
                        <th>Tidak Setuju (TS)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        while($row = $kriteria->fetch_assoc()){
                            ?>
                            <tr>
                                <td>-</td>
                                <td colspan="6" class="fw-bold"><?php echo $row['nama'];?></td>
                            </tr>
                            <?php
                            $subKriteria = $koneksi->query("SELECT * FROM sub_kriteria WHERE id_kriteria = {$row['id']}");
                            while($subRow = $subKriteria->fetch_assoc()){
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $no++;?></td>
                                    <td class="text-start"><?php echo $subRow['nama'];?></td>
                                    <td>
                                        <input type="radio" name="jawaban[<?php echo $subRow['id'];?>]" value="5" required>
                                    </td>
                                    <td>
                                        <input type="radio" name="jawaban[<?php echo $subRow['id'];?>]" value="4" required>
                                    </td>
                                    <td>
                                        <input type="radio" name="jawaban[<?php echo $subRow['id'];?>]" value="3" required>
                                    </td>
                                    <td>
                                        <input type="radio" name="jawaban[<?php echo $subRow['id'];?>]" value="2" required>
                                    </td>
                                    <td>
                                        <input type="radio" name="jawaban[<?php echo $subRow['id'];?>]" value="1" required>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
            </table>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
</div>