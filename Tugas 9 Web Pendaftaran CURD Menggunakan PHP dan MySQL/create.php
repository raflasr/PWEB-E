<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO siswa (nama, umur, jenis_kelamin, nomor_telepon, email, alamat) VALUES ('$nama', '$umur', '$jenis_kelamin', '$nomor_telepon', '$email', '$alamat')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Siswa Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: left;
            background-color: #007BFF; /* Blue background */
            margin: 0;
            padding: 0;
            color: #fff;
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
        }

        textarea {
            resize: vertical;
            height: 100px;
        }
    </style>
</head>
<body>
    <h1>Formulir Pendaftaran Siswa Baru</h1>
    <form method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="umur">Umur:</label>
        <input type="number" id="umur" name="umur" required><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea><br>

        <input type="submit" value="Simpan">
    </form>
</body>
</html>
