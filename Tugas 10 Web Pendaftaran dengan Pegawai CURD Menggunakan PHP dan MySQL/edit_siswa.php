<?php
include 'config.php'; // Koneksi ke database

// Mengecek apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data siswa berdasarkan ID
    $sql = "SELECT * FROM siswa WHERE id = $id";
    $result = $conn->query($sql);

    // Cek apakah data ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data siswa tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $id_pegawai = $_POST['id_pegawai']; // Pegawai yang menangani

    // Update data siswa
    $update_sql = "UPDATE siswa SET 
                    nama='$nama', 
                    umur=$umur, 
                    jenis_kelamin='$jenis_kelamin', 
                    nomor_telepon='$nomor_telepon', 
                    email='$email', 
                    alamat='$alamat', 
                    id_pegawai=$id_pegawai
                    WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: list.php"); // Redirect ke daftar siswa setelah update
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
    <title>Edit Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: left;
            background-color: #ffffff; /* White background */
            margin: 0;
            padding: 0;
            color: #333; /* Dark text for contrast */
        }

        h1 {
            font-size: 2.5em;
            margin-top: 30px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #007BFF; /* Blue color for the title */
        }

        form {
            width: 60%;
            margin: 30px auto;
            padding: 20px;
            background-color: #f4f7f6; /* Light gray background for form */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        input[type="submit"] {
            background-color: #007BFF; /* Blue submit button */
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        select, textarea {
            resize: vertical; /* Allow resizing of text areas */
        }
    </style>
</head>
<body>

    <h1>Edit Data Siswa</h1>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= $row['nama']; ?>" required>

        <label for="umur">Umur:</label>
        <input type="number" id="umur" name="umur" value="<?= $row['umur']; ?>" required>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki" <?= $row['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="Perempuan" <?= $row['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
        </select>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?= $row['nomor_telepon']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $row['email']; ?>" required>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?= $row['alamat']; ?></textarea>

        <label for="id_pegawai">Pegawai yang Menangani:</label>
        <select id="id_pegawai" name="id_pegawai" required>
            <?php
            // Ambil data pegawai untuk dropdown
            $sql_pegawai = "SELECT id, nama FROM pegawai";
            $result_pegawai = $conn->query($sql_pegawai);
            while ($pegawai = $result_pegawai->fetch_assoc()) {
                echo "<option value='" . $pegawai['id'] . "' " . ($row['id_pegawai'] == $pegawai['id'] ? 'selected' : '') . ">" . $pegawai['nama'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Update Siswa">
    </form>

</body>
</html>
