<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "bakery");

// Mengecek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Proses upload gambar (jika ada)
    $picture = null; // Variabel untuk menyimpan nama file gambar
    if (!empty($_FILES['picture']['tmp_name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['picture']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Validasi tipe file
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFilePath)) {
                $picture = $fileName;
            } else {
                echo "<script>alert('Gagal mengunggah gambar.'); window.location.href='edit_product.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Tipe file tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.'); window.location.href='edit_product.php';</script>";
            exit;
        }
    }

    // Query untuk menyimpan produk baru
    $sql = "INSERT INTO products (name, price, stock, description, category, picture) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdisss", $name, $price, $stock, $description, $category, $picture);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='edit_product.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk.'); window.location.href='edit_product.php';</script>";
    }

    // Menutup koneksi
    $stmt->close();
    $conn->close();
}
?>
