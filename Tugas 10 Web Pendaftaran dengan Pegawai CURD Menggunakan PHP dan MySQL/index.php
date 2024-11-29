<?php
include 'config.php';

// Mengambil jumlah pendaftar
$sql = "SELECT COUNT(*) as total_pendaftar FROM siswa";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pendaftar = $row['total_pendaftar'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Kursus Siswa Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Pendaftaran Kursus Siswa Baru</h2>
        <h1>DevNest</h1>
    </div>
    
    <div class="container">
        <img src="coding.jpeg" alt="Gambar Anak Coding">
        <div class="menu">
            <h3>Menu</h3>
            <h3>Total Pendaftar: <?= $total_pendaftar; ?></h3>
            <a href="create.php">Daftar Baru</a> |
            <a href="list.php">Pendaftar</a>
        </div>
    </div>
</body>
</html>