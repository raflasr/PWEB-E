<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM siswa WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $update_sql = "UPDATE siswa SET nama='$nama', umur='$umur', jenis_kelamin='$jenis_kelamin', nomor_telepon='$nomor_telepon', email='$email', alamat='$alamat' WHERE id=$id";
    
    if ($conn->query($update_sql) === TRUE) {
        header("Location: list.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Peserta</title>
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
    <h1>Edit Data Peserta</h1>
    <form method="POST">
        Nama: <input type="text" name="nama" value="<?= $row['nama']; ?>" required><br>
        Umur: <input type="number" name="umur" value="<?= $row['umur']; ?>" required><br>
        Jenis Kelamin:
        <select name="jenis_kelamin">
            <option value="Laki-laki" <?= $row['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="Perempuan" <?= $row['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
        </select><br>
        Nomor Telepon: <input type="text" name="nomor_telepon" value="<?= $row['nomor_telepon']; ?>" required><br>
        Email: <input type="email" name="email" value="<?= $row['email']; ?>" required><br>
        Alamat: <textarea name="alamat" required><?= $row['alamat']; ?></textarea><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
