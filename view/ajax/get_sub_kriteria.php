<?php
include '../../config/db.php';

// Query SQL untuk mengambil data sub_kriteria beserta nama kriteria
$sql = "SELECT sub_kriteria.*, k.nama as kriteria FROM sub_kriteria LEFT JOIN kriteria k ON sub_kriteria.id_kriteria = k.id";
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
