<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Siswa yang sudah mendaftar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="kursus_logo.png" alt="School Logo">
            <h2>DevNest</h2>
            <a href="index.php">Home</a>
            <a href="register.php">Pendaftaran Siswa</a>
            <a href="pegawai.php">Data Pegawai</a>
            <a href="upload_photo.php">Upload Photo</a>
        </div>
        <div class="table-container">
            <h2>Siswa yang sudah mendaftar</h2>
            <button class="new-btn" onclick="window.location.href='register.php'">New +</button>
            <table>
                <thead>
                    <tr>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db_connection.php';
                    $result = $conn->query("SELECT nrp, name FROM students");

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['nrp']}</td>
                                    <td>{$row['name']}</td>
                                    <td>
                                        <a href='view_student.php?nrp={$row['nrp']}'>View Data</a> |
                                        <a href='edit_student.php?nrp={$row['nrp']}'>Edit</a> |
                                        <a href='delete_student.php?nrp={$row['nrp']}' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No records found.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>