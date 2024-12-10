<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    // Simpan pesan ke dalam session
    $_SESSION['error_message'] = "Anda harus login untuk mengakses halaman ini.";
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Untuk membuka pop-up Edit Product
        function openEditPopup(id, name, price, stock, description, category) {
            const popup = document.getElementById('editPopup');
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editStock').value = stock;
            document.getElementById('editDescription').value = description;
            document.getElementById('editCategory').value = category;
            popup.style.display = 'flex';
        }

        // Untuk membuka pop-up Add Product
        function openAddPopup() {
            const popup = document.getElementById('addPopup');
            popup.style.display = 'flex';
        }

        // Menutup semua pop-up
        function closePopup() {
            document.getElementById('editPopup').style.display = 'none';
            document.getElementById('addPopup').style.display = 'none';
        }

        // Konfirmasi delete produk
        function confirmDelete(id) {
            const confirmAction = confirm("Apakah Anda yakin ingin menghapus produk ini?");
            if (confirmAction) {
                window.location.href = 'delete_product.php?id=' + id;
            }
        }
    </script>

</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2>Bakery</h2>
            </div>
            <nav>
                <a href="index.php">Home</a>
                <a href="edit_product.php" class="current_nav">Edit Product</a>
                <a href="order_product.php">Order</a>
                <a href="delivery_product.php">Delivery</a>
                <a href="report.php">Report</a>
                <!--  -->
                <?php 
                // Tambahkan login/logout berdasarkan sesi
                if (isset($_SESSION['employee_id'])): ?>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <h1>Produk</h1>
                <button class="btn-add" onclick="openAddPopup()">+ Add Product</button>
            </header>
            
            <section class="product-list">
                <div class="products">
                    <?php
                    // Koneksi ke database dan ambil data
                    $conn = new mysqli("localhost", "root", "", "bakery");
                    $sql = "SELECT id, name, price, stock, description, category, picture FROM products";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="card">';
                            echo '<img src="uploads/' . basename($row['picture']) . '" alt="' . $row['name'] . '">';
                            echo '<div class="product-info">';
                            echo '<h3>' . $row['name'] . '</h3>';
                            echo '<p>Harga: Rp' . number_format($row['price'], 0, ',', '.') . '</p>';
                            echo '<p>Stok: ' . $row['stock'] . '</p>';
                            echo '<p>Kategori: ' . $row['category'] . '</p>';  // Menampilkan kategori
                            echo '<p>' . $row['description'] . '</p>';  // Menampilkan deskripsi
                            echo '<button class="btn-edit" onclick="openEditPopup(' . 
                                    $row['id'] . ', \'' . $row['name'] . '\', ' . $row['price'] . 
                                    ', ' . $row['stock'] . ', \'' . $row['description'] . '\', \'' . $row['category'] . '\')">Edit</button>';
                            echo '<button class="btn-edit" onclick="confirmDelete(' . $row['id'] . ')">Hapus</button>'; // Tombol Hapus        
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

    <!-- Pop-up untuk Edit Produk -->
    <div id="editPopup" class="popup">
        <div class="popup-content">
            <h2>Edit Produk</h2>
            <form action="update_product.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="editName">Nama Produk:</label>
                    <input type="text" id="editName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="editPrice">Harga:</label>
                    <input type="number" id="editPrice" name="price" required>
                </div>
                <div class="form-group">
                    <label for="editStock">Stok:</label>
                    <input type="number" id="editStock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="editDescription">Deskripsi:</label>
                    <textarea id="editDescription" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editCategory">Kategori:</label>
                    <input type="text" id="editCategory" name="category" required>
                </div>
                <div class="form-group">
                    <label for="editPicture">Gambar:</label>
                    <input type="file" id="editPicture" name="picture">
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn-save">Simpan</button>
                    <button type="button" class="btn-cancel" onclick="closePopup()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pop-up untuk Add Produk -->
    <div id="addPopup" class="popup">
        <div class="popup-content">
            <h2>Tambah Produk</h2>
            <form action="add_product.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="addName">Nama Produk:</label>
                    <input type="text" id="addName" name="name" required>
                </div>
                <div class="form-group">
                    <label for="addPrice">Harga:</label>
                    <input type="number" id="addPrice" name="price" required>
                </div>
                <div class="form-group">
                    <label for="addStock">Stok:</label>
                    <input type="number" id="addStock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="addDescription">Deskripsi:</label>
                    <textarea id="addDescription" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="addCategory">Kategori:</label>
                    <input type="text" id="addCategory" name="category" required>
                </div>
                <div class="form-group">
                    <label for="addPicture">Gambar:</label>
                    <input type="file" id="addPicture" name="picture">
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn-save">Tambah</button>
                    <button type="button" class="btn-cancel" onclick="closePopup()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
