<?php
include '../../config/db.php';

// Query SQL untuk mengambil data sub_kriteria beserta nama kriteria
$sql = "SELECT assign_rule.* , k.nama as kriteria FROM assign_rule LEFT JOIN kriteria k ON assign_rule.kriteria_id = k.id";
$result = $koneksi->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Menutup koneksi database
$koneksi->close();

// Mengembalikan data dalam format JSON
echo json_encode($data);
?>
