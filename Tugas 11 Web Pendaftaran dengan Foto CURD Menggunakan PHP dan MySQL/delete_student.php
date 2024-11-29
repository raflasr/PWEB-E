<?php
session_start();
include 'db_connection.php';

$nrp = $_GET['nrp'];

// Periksa apakah sesi autentikasi untuk delete ada
if (!isset($_SESSION['authenticated_delete']) || $_SESSION['authenticated_delete'] !== true) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['authenticate'])) {
        $nama_pegawai = $_POST['nama_pegawai'];
        $password_pegawai = $_POST['password_pegawai'];

        // Verifikasi nama pegawai dan password
        $stmt = $conn->prepare("SELECT * FROM employees WHERE nama_pegawai = ?");
        $stmt->bind_param("s", $nama_pegawai);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $employee = $result->fetch_assoc();

            // Verifikasi password (gunakan password_verify jika password di-hash)
            if ($password_pegawai === $employee['password_pegawai']) {
                $_SESSION['authenticated_delete'] = true; // Set sesi autentikasi
                header("Location: " . $_SERVER['REQUEST_URI']); // Refresh halaman
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Nama pegawai tidak ditemukan!";
        }
    }

    // Tampilkan form autentikasi jika belum terautentikasi
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Autentikasi Pegawai</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <img src="kursus_logo.png" alt="School Logo">
                <h2>DevNest</h2>
            </div>

            <div class="form-container">
                <h2>Autentikasi Pegawai</h2>
                <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
                <form action="" method="post">
                    <input type="text" name="nama_pegawai" placeholder="Nama Pegawai" required>
                    <input type="password" name="password_pegawai" placeholder="Password" required>
                    <button type="submit" name="authenticate">Login</button>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit; // Hentikan eksekusi sampai autentikasi selesai
}

// Proses penghapusan data jika sudah terautentikasi
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $sql = "DELETE FROM students WHERE nrp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nrp);

    if ($stmt->execute()) {
        unset($_SESSION['authenticated_delete']); // Hapus sesi autentikasi setelah delete
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: students.php");
    exit;
}

// Proses jika tombol batal ditekan
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cancel'])) {
    unset($_SESSION['authenticated_delete']); // Menghapus sesi autentikasi jika batal
    header("Location: students.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Konfirmasi Hapus Data</h2>
            <p>Apakah Anda yakin ingin menghapus data dengan NRP <?php echo htmlspecialchars($nrp); ?>?</p>
            <form action="" method="post">
                <button type="submit" name="delete" class="btn-delete">Hapus</button>
                <button type="submit" name="cancel" class="btn-cancel">Batal</button>
            </form>
        </div>
    </div>
</body>
</html>