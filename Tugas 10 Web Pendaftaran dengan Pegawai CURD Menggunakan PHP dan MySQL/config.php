<?php
$servername = "localhost"; // Nama server (default localhost)
$username = "root";        // Username database
$password = "";            // Password database (kosong untuk XAMPP default)
$dbname = "pendaftaransiswabaru"; // Nama database yang digunakan

// Koneksi ke MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Koneksi berhasil
    // echo "Connected successfully"; // Bisa digunakan untuk cek koneksi berhasil
}
?>
