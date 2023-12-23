<div class="col-12 row">
        <div class="col-lg-6 col-md-6 col-12 mt-3">
            <p class="fw-bold mb-1">Indikator Jawaban Angket</p>
            <table class="table table-sm table-bordered table-hovered table-striped">
                <thead>
                    <tr>
                        <th class="fw-bold text-center bg-info">No </th>
                        <th class="fw-bold text-center bg-info">Pilihan Jawaban</th>
                        <th class="fw-bold text-center bg-info">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //array Sangat Setuju, Setuju, Ragu-ragu, Kurang Setuju, Tidak Setuju
                    $row = ["Sangat Setuju", "Setuju", "Ragu-ragu", "Kurang Setuju", "Tidak Setuju"];
                    //array 5, 4, 3, 2, 1
                    $skor = [5, 4, 3, 2, 1];
                    $no = 1;
                    foreach ($row as $r) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class=""><?php echo $r; ?></td>
                            <td class="text-center"><?php echo $skor[$no - 2]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6 col-md-6 col-12 mt-3">
            <p class="fw-bold mb-1">Kriteria Indikator Angket</p>
            <table class="table table-sm table-bordered table-hovered table-striped">
                <thead>
                    <tr>
                        <th class="fw-bold text-center bg-info">No </th>
                        <th class="fw-bold text-center bg-info">Presentase (%)</th>
                        <th class="fw-bold text-center bg-info">Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //array Sangat Puas, Puas, Cukup Puas, Kurang Puas, Tidak Puas
                    $row = $koneksi->query("
                        SELECT *
                        FROM assign_rule
                        WHERE id IN (
                            SELECT MAX(id)
                            FROM assign_rule
                            GROUP BY kepuasan
                        )
                    ")->fetch_all(MYSQLI_ASSOC);
                    $no = 1;
                    foreach ($row as $r) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class=""><?php echo $r['nilai_min'].' - '.$r['nilai_max']; ?></td>
                            <td class=""><?php echo $r['kepuasan']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6 col-md-6 col-12 mt-3">
            <p class="fw-bold mb-1">Indikator Kepuasan Angket</p>
            <table class="table table-sm table-bordered table-hovered table-striped">
                <thead>
                    <tr>
                        <th class="fw-bold text-center bg-info">No </th>
                        <th class="fw-bold text-center bg-info">Kepuasan</th>
                        <th class="fw-bold text-center bg-info">Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rowp = ["Tidak Puas","Kurang Puas","Cukup Puas","Puas","Sangat Puas"];
                    //array 5, 4, 3, 2, 1
                    $skorp = [1, 2, 3, 4, 5];
                    $nop = 1;
                    foreach ($rowp as $r) {
                        ?>
                        <tr>
                            <td class="text-center fw-bold"><?php echo $nop++; ?></td>
                            <td class=""><?php echo $r; ?></td>
                            <td class="text-center fw-bold"><?php echo $skorp[$nop - 2]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6 col-md-6 col-12 mt-3">
            <p class="fw-bold mb-1">Indikator Kepuasan Akhir</p>
            <table class="table table-sm table-bordered table-hovered table-striped">
                <thead>
                    <tr>
                        <th class="fw-bold text-center bg-info">No </th>
                        <th class="fw-bold text-center bg-info">Kriteria</th>
                        <th class="fw-bold text-center bg-info">Range Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //array Sangat Puas, Puas, Cukup Puas, Kurang Puas, Tidak Puas
                    $row = $koneksi->query("
                        SELECT *
                        FROM assign_rule
                        WHERE id IN (
                            SELECT MAX(id)
                            FROM assign_rule
                            GROUP BY kepuasan
                        )
                    ")->fetch_all(MYSQLI_ASSOC);
                    $hitungkriteria = $koneksi->query("SELECT * FROM kriteria")->num_rows;
                    $hitungnilaimax = $koneksi->query("SELECT MAX(nilai) FROM rule")->fetch_assoc()['MAX(nilai)'];

                    $maxValue = $hitungkriteria * $hitungnilaimax;
                    $increment = $maxValue / count($row);

                    $i = 0;
                    $previous_max = -1; // Initialize with -1 so that the first min starts from 0
                    foreach ($row as $key => $value) {
                        $row[$key]['nilai_min'] = $previous_max + 1;
                        $row[$key]['nilai_max'] = $row[$key]['nilai_min'] + $increment;
                        $previous_max = $row[$key]['nilai_max'];
                    }

                    $no = 1;
                    foreach ($row as $r) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $no++ . "</td>";
                        echo "<td class=''>" . $r['kepuasan'] . "</td>";
                        echo "<td class='text-center'>" . $r['nilai_min'] ." - ".$r['nilai_max'] ."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>