<?php
include 'koneksi.php';

// Query untuk mengambil data mahasiswa
$query = "SELECT nim, nama_lengkap, tanggal_lahir, no_hp FROM mahasiswa";
$result = $conn->query($query);

// Menyimpan data ke dalam array
$siswa = [];
while ($row = $result->fetch_assoc()) {
    $siswa[] = $row;
}

// Menutup koneksi
$conn->close();
?>
