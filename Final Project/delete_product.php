<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "bakery");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus produk berdasarkan ID
if ($id) {
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak valid.";
}

// Tutup koneksi
$conn->close();
?>
