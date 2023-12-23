<div class="col-12">
        <p class="h1">Kepuasan Pelanggan</p>
        <div class=" table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="text-center">
                        <th rowspan="1" style="vertical-align: middle;" class="bg-info">No</th>
                        <th class="bg-info" rowspan="1" style="vertical-align: middle;">Nama Pelanggan</th>
                        <th class="bg-info" colspan="2" style="vertical-align: middle;">Nilai</th>
                        <th class="bg-info" colspan="1" style="vertical-align: middle;">FAM</th>
                        <th class="bg-info" colspan="1" style="vertical-align: middle;">Tingkat</th>
                        <th class="bg-info" colspan="1" style="vertical-align: middle;">Skor</th>
                        <th class="bg-info" colspan="1" style="vertical-align: middle;">Total Skor</th>
                        <th class="bg-info" colspan="1" style="vertical-align: middle;">Tingkat Kepuasan Akhir</th>
                    </tr>
                    <tr>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $noreal=1;
                    $nnnilai = array();
                    $pelanggan = $koneksi->query("SELECT * FROM users WHERE role = 'pelanggan'");
                    while ($row = $pelanggan->fetch_assoc()) {
                        $kriteria = $koneksi->query("select * from kriteria");
                        $hitungkriteria = $kriteria->num_rows;
                        $kriteria = $kriteria->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <tr>
                            <td rowspan="<?php echo $hitungkriteria;?>"><?php echo $noreal++;?></td>
                            <td rowspan="<?php echo  $hitungkriteria;?>"><?php echo $row['username'];?></td>
                            <?php
                            $n=0;
                            $total_skor=0;
                            foreach ($kriteria as $k) {
                                if($n>0){
                                    echo '<tr>';
                                }
                                $subkriteria = $koneksi->query("select * from sub_kriteria where id_kriteria = {$k['id']}");
                                $subkriteria = $subkriteria->fetch_all(MYSQLI_ASSOC);
                                $arraysubkriteria_id = array();
                                foreach ($subkriteria as $sk) {
                                    $arraysubkriteria_id[] = $sk['id'];
                                }
                                $nilaimax = $koneksi->query("SELECT MAX(nilai_min) FROM assign_rule where kriteria_id='$k[id]'")->fetch_assoc()['MAX(nilai_min)'];
                                $maxrule = $koneksi->query("SELECT MAX(nilai) FROM rule ")->fetch_assoc()['MAX(nilai)'];
                                $answers = $koneksi->query("SELECT * FROM quisioner_detail WHERE user_id = {$row['id']} AND sub_kriteria_id IN (".implode(',', $arraysubkriteria_id).")");
                                $answers = $answers->fetch_all(MYSQLI_ASSOC);
                                $totalnilai=0;
                                foreach($answers as $answer){
                                    $totalnilai += $answer['nilai'];
                                }
                                $ratamax = ($maxrule * count($subkriteria));
                                $ratarata = round(($totalnilai/$ratamax)*100);
                                echo '<td class="">'.$k['nama'].'</td>';
                                echo '<td class="text-center">'.$ratarata.'</td>';
                                $nilai = $koneksi->query("SELECT * FROM assign_rule WHERE nilai_min <= {$ratarata} AND nilai_max >= {$ratarata}");
                                    $nilai = $nilai->fetch_assoc();
                                    if($nilai['nilai_min']==$nilaimax){
                                        $datamaxkedua = $koneksi->query("SELECT MAX(nilai_max) FROM assign_rule WHERE nilai_max < {$nilai['nilai_max']}")->fetch_assoc()['MAX(nilai_max)'];
                                        $fam = ($ratarata-$nilai['nilai_min'])/($datamaxkedua-$nilai['nilai_min']);
                                        echo '<td class="text-center">'.$fam.'</td>';
                                    }else{
                                        $fam = ($nilai['nilai_max']-$ratarata)/($nilai['nilai_max']-$nilai['nilai_min']);
                                        echo '<td class="text-center">'.$fam.'</td>';
                                    }
                                    echo '<td class="text-center">'.$nilai['kepuasan'].'</td>';
                                    $rownilai = $koneksi->query("
                                            SELECT *
                                            FROM assign_rule
                                            WHERE id IN (
                                                SELECT MAX(id)
                                                FROM assign_rule
                                                GROUP BY kepuasan
                                            )
                                        ")->fetch_all(MYSQLI_ASSOC);
                                        $oo=1;
                                        $previous_max = -1; // Initialize with -1 so that the first min starts from 0
                                        foreach ($rownilai as $key => $value) {
                                            $rownilai[$key]['nilai_min'] = $previous_max + 1;
                                            $rownilai[$key]['nilai_max'] = $rownilai[$key]['nilai_min'] + $increment;
                                            $previous_max = $rownilai[$key]['nilai_max'];
                                        }
                    
                                        $no = 0;
                                        $nnnilai=$rownilai;
                                        foreach ($rownilai as $r) {
                                            if($r['kepuasan']==$nilai['kepuasan']){
                                                $rulebaru = $koneksi->query("SELECT * FROM rule order by nilai asc")->fetch_all(MYSQLI_ASSOC);
                                                $kk=0;
                                                foreach ($rulebaru as $ko) {
                                                    if($kk==$no){
                                                        $total_skor += $ko['nilai'];
                                                        echo '<td class="text-center">'.$ko['nilai'].'</td>';
                                                    }
                                                    $kk++;
                                                }
                                                
                                            }
                                            $no++;
                                        }
                                        if($n<1){
                                            echo '<td id=total-'.$row['id'].' class="text-center" rowspan="'.$hitungkriteria.'">'.$total_skor.'</td>';
                                            echo '<td id=kepuasan-'.$row['id'].' class="text-center" rowspan="'.$hitungkriteria.'">'.$total_skor.'</td>';
                                        }
                                        echo '</tr>';
                                $n++;
                            }
                            ?>
                            <script>
                                $("#total-<?php echo $row['id'];?>").html(<?php echo $total_skor;?>);
                            </script>
                            <?php
                            foreach($nnnilai as $nn){
                                if($total_skor>=$nn['nilai_min'] && $total_skor<=$nn['nilai_max']){
                                    ?>
                                    <script>
                                        $("#kepuasan-<?php echo $row['id'];?>").html("<?php echo $nn['kepuasan'];?>");
                                    </script>
                                    <?php
                                }
                            }
                            ?>
                    <?php };?>
                </tbody>
            </table>
        </div>
    </div>