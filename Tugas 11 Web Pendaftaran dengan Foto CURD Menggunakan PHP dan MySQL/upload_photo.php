<?php
include 'db_connection.php';

// Variable to store message
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nrp = $_POST['nrp']; // NRP input from form
    $photo = $_FILES['photo']; // Uploaded file

    // Validate NRP (ensure it's 10 digits)
    if (!preg_match("/^\d{10}$/", $nrp)) {
        $message = "NRP harus terdiri dari 10 digit.";
    } else {
        // Check if file is uploaded and valid image
        if ($photo['error'] == 0) {
            $targetDir = "uploads/"; // Directory where files will be uploaded
            $targetFile = $targetDir . basename($photo['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Allowed file types
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            // Check file type
            if (!in_array($imageFileType, $allowedTypes)) {
                $message = "Hanya gambar JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
            } else {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
                    // Insert the file path into the database
                    $stmt = $conn->prepare("UPDATE students SET picture = ? WHERE nrp = ?");
                    $stmt->bind_param("ss", $targetFile, $nrp);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        $message = "Foto berhasil diupload dan disimpan.";
                    } else {
                        $message = "NRP tidak ditemukan atau gagal menyimpan foto.";
                    }

                    $stmt->close();
                } else {
                    $message = "Terjadi kesalahan saat mengupload foto.";
                }
            }
        } else {
            $message = "Tidak ada file yang diupload.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Foto</title>
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
            <a href="pegawai.php">Data Pegawai</a>
        </div>
        <div class="card-container">
            <h2>Upload Foto Siswa</h2>
            <div class="card">
                <!-- Display message -->
                <?php if ($message != ""): ?>
                    <div class="message">
                        <p><?php echo $message; ?></p>
                    </div>
                <?php endif; ?>
                
                <form action="upload_photo.php" method="post" enctype="multipart/form-data">
                    <label for="nrp"><strong>NRP:</strong></label>
                    <input type="text" name="nrp" required>
                    <br><br>
                    <label for="photo"><strong>Pilih Foto:</strong></label>
                    <input type="file" name="photo" accept="image/*" required>
                    <br><br>
                    <button type="submit">Upload Foto</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>