<?php
session_start();

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan
}


// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bakery";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

//login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM employees WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
        if (password_verify($password, $employee['password'])) {
            $_SESSION['employee_id'] = $employee['id'];
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Password salah.";
        }
    } else {
        $error_message = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <a href="index.php">Home</a>
            <a href="edit_product.php">Edit Product</a>
            <a href="order_product.php">Order</a>
            <a href="delivery_product.php">Delivery</a>
            <a href="report.php">Report</a>
            <!--  -->
            <?php 
            // Tambahkan login/logout berdasarkan sesi
            if (isset($_SESSION['employee_id'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php" class="current_nav">Login</a>
            <?php endif; ?>
        </nav>
    </aside>

    <!-- Main Page -->
    <main class="main-content">
        <header>
            <h1>Login Employee</h1>
        </header>

        <!-- pesan error -->
        <?php if (isset($error_message)): ?>
            <p class="error"><?= $error_message; ?></p>
        <?php endif; ?>

        <div class="login-container">
            <div class="login">
                <form method="POST" action="">
                    <label>Username:</label><br>
                    <input type="text" name="username" required><br><br>                <label>Password:</label><br>
                    <input type="password" name="password" required><br><br>
                    <button type="submit" class="btn-log">Login</button>
                </form>
            
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </div>

            <div class="login-image">
                <img src="https://images.crowdspring.com/blog/wp-content/uploads/2023/05/16174534/bakery-hero.png" alt="Bakery Image">
            </div>
        </div>
    </main>
</div>
</body>
</html>
