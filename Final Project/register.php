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

// regis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO employees (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $message = [
            'type' => 'success',
            'content' => 'Registrasi berhasil. Silakan <a href="login.php">login</a>.'
        ];
    } else {
        $message = [
            'type' => 'error',
            'content' => 'Error: ' . $conn->error
        ];
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
            <h1>Register Employee</h1>
        </header>

        <?php if (isset($message)): ?>
            <div class="message <?php echo $message['type']; ?>">
                <?php echo $message['content']; ?>
            </div>
        <?php endif; ?>

        <div class="login-container">
            <div class="login">
                <form method="POST" action="">
                    <label>Username:</label><br>
                    <input type="text" name="username" required><br><br>
                    <label>Password:</label><br>
                    <input type="password" name="password" required><br><br>
                    <button type="submit" class="btn-log">Register</button>
                </form>
            
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

            </div>

            <div class="login-image">
                <img src="https://images.crowdspring.com/blog/wp-content/uploads/2023/05/16174534/bakery-hero.png" alt="Bakery Image">
            </div>
        </div>
    </main>
</div>
</body>
</html>

