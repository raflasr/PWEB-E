<?php
include 'config.php';

$sql = "SELECT * FROM siswa";
$result = $conn->query($sql);

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM siswa WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: list.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pendaftar</title>
    <style>
        /* Same CSS as before */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
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

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #ffffff; /* White background for the table */
            border: 2px solid #007BFF; /* Blue border for the table */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #007BFF; /* Blue border for table cells */
        }

        th {
            background-color: #007BFF; /* Blue background for header */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f1f1f1; /* Light gray for even rows */
        }

        tr:hover {
            background-color: #e1eaff; /* Light blue on hover */
        }

        td {
            color: #333; /* Dark text color for table cells */
        }

        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        .delete-btn {
            background-color: #f44336; /* Red */
            color: white;
        }

    </style>
</head>
<body>
    <h1>Daftar Pendaftar</h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['umur']; ?></td>
                <td><?= $row['jenis_kelamin']; ?></td>
                <td><?= $row['nomor_telepon']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                    <a href="?delete_id=<?= $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
