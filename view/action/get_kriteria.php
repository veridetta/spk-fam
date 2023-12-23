<?php
include '../../config/db.php';
// Query SQL untuk mengambil data kriteria
$sql = "SELECT * FROM kriteria";
$result = $koneksi->query($sql);

// Menyiapkan array untuk data JSON
$data = array();

// Mengambil data dari hasil query
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