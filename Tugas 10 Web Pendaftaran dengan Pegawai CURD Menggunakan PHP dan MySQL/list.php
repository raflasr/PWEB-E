<?php
// Koneksi database
include 'config.php';

// Query data siswa dan pegawai
$sql_siswa = "
    SELECT siswa.*, pegawai.nama AS nama_pegawai 
    FROM siswa 
    LEFT JOIN pegawai ON siswa.id_pegawai = pegawai.id
";
$result_siswa = $conn->query($sql_siswa);

// Query semua pegawai
$sql_pegawai = "SELECT * FROM pegawai";
$result_pegawai = $conn->query($sql_pegawai);

// Hapus data siswa
if (isset($_GET['delete_siswa_id'])) {
    $delete_id = intval($_GET['delete_siswa_id']);
    $delete_sql = "DELETE FROM siswa WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: list.php");
        exit();
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
    <title>Daftar Siswa dan Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #CBDCEB;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        h1 {
            text-align: center;
            background-color: #4c77af;
            color: white;
            padding: 10px;
        }
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            color: #000;
        }
        th {
            background-color: #4c77af;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #fff;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            margin: 0 2px;
        }
        .btn-edit {
            background-color: #ffc107;
        }
        .btn-delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h1>List Siswa</h1>
    <table>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Pegawai Pendaftar</th>
            <th>Tindakan</th>
        </tr>
        <?php $no = 1; while ($row = $result_siswa->fetch_assoc()) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['umur']; ?></td>
            <td><?= $row['jenis_kelamin']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['nomor_telepon']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['nama_pegawai'] ?? 'Belum Ditetapkan'; ?></td>
            <td>
                <a href="edit_siswa.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="?delete_siswa_id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h1>List Pegawai</h1>
    <table>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Jabatan</th>
        </tr>
        <?php $no = 1; while ($row = $result_pegawai->fetch_assoc()) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['jabatan']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
