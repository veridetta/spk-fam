<?php

// Fungsi untuk melakukan hash terhadap password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Data pengguna dalam bentuk JSON
$jsonData = '[ 
    
    {
        "NAMA": "Dina",
        "email": "dina@gmail.com",
        "password": "dina1234"
    }
]';

// Mengubah JSON menjadi array PHP
$usersData = json_decode($jsonData, true);

// Koneksi ke database (gantilah dengan informasi koneksi yang sesuai)
$servername = "localhost:1235";
$username = "root";
$password = "";
$dbname = "spk_simoni";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Loop melalui data pengguna dan lakukan insert ke database
foreach ($usersData as $user) {
    $nama = $user['NAMA'];
    $email = $user['email'];
    $password = hashPassword($user['password']);

    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $password);

    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan<br>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Tutup koneksi
$conn->close();

?>
