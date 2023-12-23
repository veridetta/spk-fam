<?php
//cek role admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header('Location: index.php?page=pub_login');
}
?>
<?php
    $kriteria = $koneksi->query("SELECT * FROM kriteria");
?>
<div class="container mt-4" style="min-height: 70vh;">
    <div class="col-12">
        <p class="h1">Quisioner Pelanggan</p>
        <p class="lead">Berikut ini merupakan hasil quisioner pelanggan.</p>
        <div class=" table-responsive">
            <table class="table table-bodered b-1 table-striped">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2" style="vertical-align: middle;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama Pelanggan</th>
                        <?php 
                        $idsubkriteria = [];
                        $idkriteria=[];
                        $totalcolspan=0;
                        $arraypengganti = range('A', 'Z');
                        $arrnilai = ["5","4","3","2","1"];
                        $arraynilai = ["SS (5)", "S (4)", "RR (3)", "KS (2)", "TS (1)"];
                        while($row = $kriteria->fetch_assoc()){
                            $idkriteria[]=$row['id'];
                            $colspan = $koneksi->query("SELECT * FROM sub_kriteria WHERE id_kriteria = {$row['id']}")->num_rows;
                            $totalcolspan += $colspan;
                            echo '<th colspan="'.$colspan.'">'.$row['nama'].'</th>';
                        }
                        ?>
                        <th rowspan="2"style="vertical-align: middle;">Skor Total</th>
                    </tr>
                    <tr>
                        
                        <?php 
                        $kriteria = $koneksi->query("SELECT * FROM kriteria");
                        while($row = $kriteria->fetch_assoc()){
                            $nop =0;
                            $subKriteria = $koneksi->query("SELECT * FROM sub_kriteria WHERE id_kriteria = {$row['id']} order by field(id_kriteria, ".implode(',', $idkriteria).")");
                            while($subRow = $subKriteria->fetch_assoc()){
                                $idsubkriteria[] = $subRow['id'];
                                echo '<th class="text-center"><small>'.$arraypengganti[$nop++].'</small></th>';
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $noreal=1;
                    $pelanggan = $koneksi->query("SELECT * FROM users WHERE role = 'pelanggan'");
                    $dataArray = array();
                    $jumlahKolom = count($idsubkriteria) + 2; // Jumlah kolom, termasuk kolom No dan Nama Pelanggan
                    $totals = array_fill(0, $jumlahKolom, 0); // Inisialisasi array total
                    while ($row = $pelanggan->fetch_assoc()) {
                        $rowData = array();
                        $rowData['No'] = $no++;
                        $rowData['Nama Pelanggan'] = $row['username'];

                        $quis = $koneksi->query("SELECT * FROM quisioner_detail WHERE user_id = {$row['id']} order by field(sub_kriteria_id, " . implode(',', $idsubkriteria) . ")");
                        $skor = 0;
                        ?>
                        <tr>
                                <td><?php echo $noreal++;?></td>
                                <td><?php echo $row['username'];?></td>
                        <?php
                        while ($quisRow = $quis->fetch_assoc()) {
                            $rowData[$quisRow['sub_kriteria_id']] = $quisRow['nilai'];
                            $totals[$quisRow['sub_kriteria_id']] += $quisRow['nilai'];
                            $skor += $quisRow['nilai'];
                            echo '<td class="text-center">'.$quisRow['nilai'].'</td>';
                        }
                        ?>
                            <td class="text-center"><?php echo $skor;?></td>
                        </tr>
                    <?php
                    
                        $dataArray[] = $rowData;
                    }
                ?>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo $totalcolspan+3;?>" class="fw-bold">Rekap Quisioner</td>
                    </tr>
                    <?php
                        $kolom = [];
                        $row = ["Sangat Setuju (5)", "Setuju (4)", "Ragu-ragu (3)", "Kurang Setuju (2)", "Tidak Setuju (1)"];
                        $no=1;
                        $int=0;
                        $jj = [];
                        foreach($row as $r){
                            $kolom[$r] = 0;
                            ?>
                            <tr>
                                <td><?php echo $no++;?></td>
                                <td class="fw-bold"><?php echo $r;?></td>
                                <?php
                                $kol=[];
                                foreach ($dataArray as $dd =>$lf) {
                                    $jumlah=0;
                                    foreach ($lf as $key => $value) {
                                        if ($key == 'No' || $key == 'Nama Pelanggan') {
                                            continue;
                                        }
                                        if (!isset($kol[$key])) {
                                            $kol[$key] = 0;
                                        }
                                        if($int<5){
                                            if($arrnilai[$int]==$value){
                                                $kol[$key] += $jumlah+1;
                                                $jj[$key] = $kol[$key]; 
                                            }else{
                                                $kol[$key] = $jumlah;
                                            };
                                        }
                                    }
                                }
                                foreach($kol as $k){
                                    echo '<td class="text-center">'.$k.'</td>';
                                }
                                ?>       
                            </tr>
                            <?php
                            $int++;
                        }
                        echo '<tr><td></td><td class="fw-bold">Jumlah</td>';
                        foreach($jj as $j){
                            echo '<td class="text-center fw-bold">'.$j.'</td>';
                        }
                        echo '</tr>';
                    ?>
            </table>
        </div>
        <hr class="mt-4">
        <div class="col-12 row">
            <div class="col-12 col-lg-6">
                <p class="h4">Keterangan</p>
                <div class="table-responsive table-sm">
                    <table class="table table-bodered table-sm b-1 table-striped">
                        <thead>
                            <th>No</th>
                            <th>Variabel</th>
                            <th>Kriteria</th>
                        </thead>
                        <tbody>
                            <?php
                                $kriteria = $koneksi->query("SELECT * FROM kriteria");
                                while($row = $kriteria->fetch_assoc()){
                                    $subKriteria = $koneksi->query("SELECT * FROM sub_kriteria WHERE id_kriteria = {$row['id']} order by field(id_kriteria, ".implode(',', $idkriteria).")");
                                    $no = 1;
                                    ?>
                                    <tr>
                                        <td>-</td>
                                        <td colspan="2"><?php echo $row['nama'];?></td>
                                    </tr>
                                    <?php
                                    while($subRow = $subKriteria->fetch_assoc()){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $arraypengganti[$no-2];?></td>
                                            <td><?php echo $subRow['nama'];?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>