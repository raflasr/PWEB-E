<?php
session_start();
include 'db_connection.php';

$nrp = $_GET['nrp'];

// Periksa apakah sesi autentikasi edit ada
if (!isset($_SESSION['authenticated_edit']) || $_SESSION['authenticated_edit'] !== true) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['authenticate'])) {
        $nama_pegawai = $_POST['nama_pegawai'];
        $password_pegawai = $_POST['password_pegawai'];

        // Verifikasi nama pegawai dan password
        $stmt = $conn->prepare("SELECT * FROM employees WHERE nama_pegawai = ?");
        $stmt->bind_param("s", $nama_pegawai);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $employees = $result->fetch_assoc();

            // Verifikasi password (gunakan password_verify jika password di-hash)
            if ($password_pegawai === $employees['password_pegawai']) {
                $_SESSION['authenticated_edit'] = true; // Set sesi autentikasi
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
                <img src="sma_logo.png" alt="School Logo">
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
    exit; // Hentikan eksekusi halaman sampai autentikasi selesai
}

// Handle update data siswa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birthplace = $_POST['birthplace'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $school_origin = $_POST['school_origin'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("UPDATE students SET 
            name=?, 
            address=?, 
            birthplace=?, 
            birthdate=?, 
            gender=?, 
            religion=?, 
            school_origin=?, 
            email=?, 
            phone=? 
            WHERE nrp=?");
    $stmt->bind_param(
        "ssssssssss", 
        $name, $address, $birthplace, $birthdate, $gender, $religion, $school_origin, $email, $phone, $nrp
    );

    if ($stmt->execute()) {
        echo "Data updated successfully!";
        unset($_SESSION['authenticated_edit']); // Hapus sesi autentikasi setelah update
        header("Location: students.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

// Ambil data siswa
$stmt = $conn->prepare("SELECT * FROM students WHERE nrp = ?");
$stmt->bind_param("s", $nrp);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="kursus_logo.png" alt="School Logo">
            <h2>DevNest</h2>
            <a href="index.php">Home</a>
            <a href="students.php">Pendaftar</a>
        </div>
        <div class="form-container">
            <h2>Edit Data Siswa</h2>
            <form action="" method="post">
                <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
                <input type="text" name="address" value="<?php echo htmlspecialchars($student['address']); ?>" required>
                <input type="text" name="birthplace" value="<?php echo htmlspecialchars($student['birthplace']); ?>" required>
                <input type="date" name="birthdate" value="<?php echo htmlspecialchars($student['birthdate']); ?>" required>
                <select name="gender" required>
                    <option value="Male" <?php if($student['gender'] == 'Male') echo 'selected'; ?>>Laki-Laki</option>
                    <option value="Female" <?php if($student['gender'] == 'Female') echo 'selected'; ?>>Perempuan</option>
                </select>
                <input type="text" name="religion" value="<?php echo htmlspecialchars($student['religion']); ?>" required>
                <input type="text" name="school_origin" value="<?php echo htmlspecialchars($student['school_origin']); ?>" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required pattern=".+@gmail\.com">
                <input type="text" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>" required>
                <button type="submit" name="update">Update</button>
                <button type="button" onclick="window.location.href='students.php'">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>