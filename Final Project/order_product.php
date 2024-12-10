<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    // Simpan pesan ke dalam session
    $_SESSION['error_message'] = "Anda harus login untuk mengakses halaman ini.";
    header("Location: login.php");
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "bakery");

// Mengecek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $product_id = $_POST['product_id'];
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];
    $delivery_address = $_POST['delivery_address'];
    $quantity = $_POST['quantity'];

    // Ambil data produk dari database
    $sql = "SELECT price, stock FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Hitung total harga
    $total_price = $product['price'] * $quantity;
    $order_date = date("Y-m-d H:i:s"); // Get the current date and time for order date

    // Check stock availability
    if ($product['stock'] < $quantity) {
        echo "<script>alert('Stok tidak cukup untuk produk ini.'); window.location.href='order_product.php';</script>";
        exit;
    }

    // Simpan data order ke database
    $sql = "INSERT INTO orders (product_id, customer_name, customer_email, customer_phone, delivery_address, quantity, total_price, order_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssids", $product_id, $customer_name, $customer_email, $customer_phone, $delivery_address, $quantity, $total_price, $order_date);

    if ($stmt->execute()) {
        // Update stock of the product
        $new_stock = $product['stock'] - $quantity;
        $sql = "UPDATE products SET stock = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $new_stock, $product_id);
        $stmt->execute();

        echo "<script>alert('Pesanan berhasil dibuat!'); window.location.href='order_product.php';</script>";
    } else {
        echo "<script>alert('Gagal membuat pesanan.'); window.location.href='order_product.php';</script>";
    }

    // Menutup koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Product</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to update total price dynamically based on quantity and price
        function updateTotalPrice() {
            var productSelect = document.getElementById('product_id');
            var quantity = document.getElementById('quantity').value;
            var price = productSelect.options[productSelect.selectedIndex].getAttribute('data-price');
            var totalPrice = price * quantity;
            document.getElementById('total_price').value = totalPrice.toFixed(2); // Show total price
        }

        // Function to update available stock when a product is selected
        function updateStockInfo() {
            var productSelect = document.getElementById('product_id');
            var stock = productSelect.options[productSelect.selectedIndex].getAttribute('data-stock');
            document.getElementById('available_stock').innerText = "Available stock: " + stock;
            updateTotalPrice();
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
                <a href="edit_product.php">Edit Product</a>
                <a href="order_product.php" class="current_nav">Order</a>
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
                <h1>Order Product</h1>
            </header>
            
            <section class="order-form">
                <form action="order_product.php" method="POST">
                    <!-- Product selection -->
                    <div class="form-group">
                        <label for="product_id">Product:</label>
                        <select name="product_id" id="product_id" onchange="updateStockInfo()" required>
                            <?php
                            $conn = new mysqli("localhost", "root", "", "bakery");
                            $sql = "SELECT id, name, price, stock FROM products";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "' data-price='" . $row['price'] . "' data-stock='" . $row['stock'] . "'>" . $row['name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No products available</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>

                    <!-- Customer's personal details -->
                    <div class="form-group">
                        <label for="customer_name">Your Name:</label>
                        <input type="text" id="customer_name" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Your Email:</label>
                        <input type="email" id="customer_email" name="customer_email" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_phone">Your Phone Number:</label>
                        <input type="tel" id="customer_phone" name="customer_phone" required>
                    </div>

                    <!-- Delivery information -->
                    <div class="form-group">
                        <label for="delivery_address">Delivery Address:</label>
                        <textarea id="delivery_address" name="delivery_address" rows="4" required></textarea>
                    </div>

                    <!-- Quantity of product -->
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" oninput="updateTotalPrice()" required>
                    </div>

                    <!-- Display available stock -->
                    <div class="form-group">
                        <p id="available_stock">Available stock: 0</p>
                    </div>

                    <!-- Display total price -->
                    <div class="form-group">
                        <label for="total_price">Total Price:</label>
                        <input type="text" id="total_price" name="total_price" value="0.00" readonly>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn-save">Order Now</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
