<?php
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $id_pegawai = $_POST['id_pegawai']; // Pilih pegawai dari form

    // Query untuk menambah siswa
    $sql = "INSERT INTO siswa (nama, umur, jenis_kelamin, nomor_telepon, email, alamat, id_pegawai)
            VALUES ('$nama', $umur, '$jenis_kelamin', '$nomor_telepon', '$email', '$alamat', $id_pegawai)";

    if ($conn->query($sql) === TRUE) {
        header("Location: list.php"); // Redirect ke daftar siswa setelah berhasil
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: left;
            background-color: #007BFF; /* Blue background */
            margin: 0;
            padding: 0;
            color: black;
        }
        
        h1 {
            font-size: 2.5em;
            margin-top: 30px;
            font-weight: bold;
            letter-spacing: 2px;
            color: white;
        }
        
        form {
            background-color: #f4f7f6;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            width: 50%;
        }
        
        label {
            font-size: 1.1em;
            color: black; /* Text color set to black */
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        
        input, select, textarea {
            font-size: 1em;
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            color: black; /* Ensuring text color in the form fields is black */
        }
        
        input[type="submit"] {
            background-color: #007BFF; /* Blue submit button */
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
            padding: 15px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        
        select, textarea {
            font-size: 1em;
            color: black;
        }
        
        textarea {
            resize: vertical;
            height: 100px;
        }
    </style>
</head>
<body>

    <h1>Tambah Siswa Baru</h1>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="umur">Umur:</label>
        <input type="number" id="umur" name="umur" required>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea>

        <label for="id_pegawai">Pegawai yang Menangani:</label>
        <select id="id_pegawai" name="id_pegawai" required>
            <?php
            // Ambil data pegawai dari database untuk dropdown
            $sql_pegawai = "SELECT id, nama FROM pegawai";
            $result_pegawai = $conn->query($sql_pegawai);
            while ($pegawai = $result_pegawai->fetch_assoc()) {
                echo "<option value='" . $pegawai['id'] . "'>" . $pegawai['nama'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Tambah Siswa">
    </form>

</body>
</html>
