<?php
$host = "localhost"; // Host database
$username = "root"; // Username MySQL
$password = ""; // Password MySQL
$database = "mahasiswa_rpl"; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
