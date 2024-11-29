<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="kursus_logo.png" alt="School Logo">
            <h2>DevNest</h2>
            <a href="index.php">Home</a>
            <a href="students.php">Pendaftar</a>
            <a href="pegawai.php">Data Pegawai</a>
            <a href="upload_photo.php">Upload Photo</a>
        </div>
        <div class="form-container">
            <h2>Formulir Pendaftaran</h2>
            <p>Silakan isi form di bawah ini dengan lengkap dan benar</p>
            <form action="process_registration.php" method="post">
                <input type="text" name="nrp" placeholder="NRP" required>
                <input type="text" name="name" placeholder="Nama" required>
                <input type="text" name="address" placeholder="Alamat" required>
                <input type="text" name="birthplace" placeholder="Tempat Lahir" required>
                <input type="date" name="birthdate" placeholder="Tanggal Lahir" required>
                <select name="gender" required>
                    <option value="">Jenis Kelamin</option>
                    <option value="Male">Laki-Laki</option>
                    <option value="Female">Perempuan</option>
                </select>
                <select name="religion" required>
                    <option value="">Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
                <input type="text" name="school_origin" placeholder="Asal Sekolah" required>
                <input type="email" name="email" placeholder="Email (@gmail.com)" required pattern=".+@gmail\.com">
                <input type="text" name="phone" placeholder="No Telp" required>
                <button type="submit">Daftar</button>
                <button type="button" onclick="window.location.href='index.php'">Batal</button>
            </form>
        </div>
    </div>
</body>
</html>