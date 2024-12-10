<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bakery";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Ambil gambar lama dari database
    $sql = "SELECT picture FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $picture = $product['picture']; // Gunakan gambar lama jika tidak diubah

    // Proses upload gambar jika ada file baru
    if (!empty($_FILES['picture']['tmp_name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['picture']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            if (!move_uploaded_file($_FILES['picture']['tmp_name'], $targetFilePath)) {
                die("Error uploading file: " . error_get_last()['message']);
            }
            $picture = $fileName;
        } else {
            die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
        }
    }

    // Update data produk
    $sql = "UPDATE products SET name = ?, price = ?, stock = ?, description = ?, category = ?, picture = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdisssi", $name, $price, $stock, $description, $category, $picture, $id);

    if ($stmt->execute()) {
        header("Location: edit_product.php");
        exit;
    } else {
        die("Error updating product: " . $stmt->error);
    }
}
?>
