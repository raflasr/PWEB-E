<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="kursus_logo.png" alt="School Logo">
            <h2>DevNest</h2>
            <a href="index.php">Home</a>
            <a href="students.php">Pendaftar</a>
            <a href="register.php">Pendaftaran Siswa</a>
            <a href="upload_photo.php">Upload Photo</a>
        </div>
        
        <div class="table-container">
            <h2>Data Pegawai</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Pegawai</th>
                        <th>Posisi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil data pegawai
                    $result_pegawai = $conn->query("SELECT nama_pegawai, posisi_pegawai FROM employees");

                    if ($result_pegawai->num_rows > 0) {
                        while($pegawai = $result_pegawai->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$pegawai['nama_pegawai']}</td>
                                    <td>{$pegawai['posisi_pegawai']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Tidak ada data pegawai ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <p>Jika Anda ingin mengedit atau menghapus data siswa, harap melalui pegawai yang terdaftar di atas.</p>
        </div>
    </div>
</body>
</html>

<?php
// Tutup koneksi database
$conn->close();
?>