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

// Ambil data produk dari database
$sql = "SELECT id, name, price, stock, description, picture FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Management</title>
    <link rel="stylesheet" href="style.css">
    

</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2>Bakery</h2>
            </div>
            <nav>
                <a href="index.php" class="current_nav">Home</a>
                <a href="edit_product.php">Edit Product</a>
                <a href="order_product.php">Order</a>
                <a href="delivery_product.php">Delivery</a>
                <a href="report.php">Report</a>
                <!--  -->
                <?php 
                // Tambahkan login/logout berdasarkan sesi
                session_start();
                if (isset($_SESSION['employee_id'])): ?>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>
        </aside>

        <!-- Main Page -->
        <main class="main-content">            
            <header>
                <h1>My Bakery</h1>
                <p>Promo Hari Ini: Diskon 20% untuk semua kue cokelat!</p>
            </header>

            
            <section class="product-status">
                <h2>Status Barang</h2>
                <div class="products">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Pastikan gambar disimpan dengan nama file dalam folder "uploads"
                            $imagePath = 'uploads/' . $row['picture']; // Mengakses gambar dari folder uploads
                            
                            echo '<div class="card">';
                            // Periksa apakah file gambar ada sebelum ditampilkan
                            if (file_exists($imagePath)) {
                                echo '<img src="' . $imagePath . '" alt="' . $row['name'] . '">';
                            } else {
                                // Jika gambar tidak ditemukan, tampilkan gambar default
                                echo '<img src="uploads/default.jpg" alt="Default Image">';
                            }

                            echo '<div class="product-info">';
                            echo '<h3>' . $row['name'] . '</h3>';
                            echo '<p>Harga: Rp' . number_format($row['price'], 0, ',', '.') . '</p>';
                            if ($row['stock'] > 0) {
                                echo '<p>Stok: ' . $row['stock'] . '</p>';
                            } else {
                                echo '<p class="out-of-stock">Stok Habis</p>';
                            }

                            // Menambahkan deskripsi produk
                            echo '<p>' . (empty($row['description']) ? 'Tidak ada deskripsi.' : $row['description']) . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Tidak ada produk.</p>';
                    }
                    ?>
                </div>
            </section>
        </main>
    </div>

</body>
</html>
