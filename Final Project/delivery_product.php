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

// Query to get all orders with product and customer details
$sql = "SELECT o.id, o.customer_name, o.customer_email, o.customer_phone, o.delivery_address, o.quantity, o.total_price, o.order_date, o.delivery_status, p.name AS product_name
        FROM orders o
        JOIN products p ON o.product_id = p.id
        ORDER BY o.order_date DESC"; // Order by most recent

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Orders</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fdf5e6;
            color: #333;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 200px;
            background-color: #f8e8d8; /* Beige */
            color: #6b4e37; /* Dark Brown */
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar nav a {
            display: block;
            color: #6b4e37; /* Dark Brown */
            text-decoration: none;
            margin-bottom: 15px;
            font-size: 1.1em;
            padding: 8px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar nav a:hover {
            background-color: #d4b8a2; /* Light Brown */
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
        }

        header h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #8b4513; /* Brown */
            font-size: 32px;
        }

        /* Table Styling */
        .orders-table {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1.1em;
        }

        table th, table td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #8b4513; /* Brown */
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f7d9c4; /* Light Brown */
        }

        .status-delivered {
            background-color: #d4edda; /* Light Green */
            color: #155724; /* Dark Green */
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-pending {
            background-color: #fff3cd; /* Light Yellow */
            color: #856404; /* Dark Yellow */
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn-deliver {
            background-color: #28a745; /* Green */
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }

        .btn-deliver:hover {
            background-color: #218838; /* Darker Green */
        }

        /* Mobile Responsiveness: Stack columns */
        @media (max-width: 768px) {
            table th, table td {
                padding: 8px;
            }

            table th:nth-child(1), table td:nth-child(1),
            table th:nth-child(2), table td:nth-child(2),
            table th:nth-child(3), table td:nth-child(3),
            table th:nth-child(4), table td:nth-child(4),
            table th:nth-child(5), table td:nth-child(5),
            table th:nth-child(6), table td:nth-child(6),
            table th:nth-child(7), table td:nth-child(7),
            table th:nth-child(8), table td:nth-child(8),
            table th:nth-child(9), table td:nth-child(9),
            table th:nth-child(10), table td:nth-child(10) {
                width: 100%;
            }

            table th, table td {
                display: block;
                text-align: left;
                padding: 10px;
            }

            .btn-deliver {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
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
                <a href="delivery_product.php" class="current_nav">Delivery</a>
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
                <h1>Delivery Orders</h1>
            </header>

            <!-- Table for displaying orders -->
            <section class="orders-table">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Phone</th>
                            <th>Delivery Address</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Get the delivery status
                                $status_class = $row['delivery_status'] == 'Delivered' ? 'status-delivered' : 'status-pending';
                                $status_text = $row['delivery_status'] == 'Delivered' ? 'Delivered' : 'Pending';

                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['customer_name'] . "</td>";
                                echo "<td>" . $row['customer_email'] . "</td>";
                                echo "<td>" . $row['customer_phone'] . "</td>";
                                echo "<td>" . $row['delivery_address'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . number_format($row['total_price'], 2) . "</td>";
                                echo "<td>" . $row['order_date'] . "</td>";
                                echo "<td class='" . $status_class . "'>" . $status_text . "</td>";

                                // If the order is not delivered, show the "Mark as Delivered" button
                                if ($row['delivery_status'] != 'Delivered') {
                                    echo "<td><a href='mark_delivered.php?id=" . $row['id'] . "' class='btn-deliver'>Mark as Delivered</a></td>";
                                } else {
                                    echo "<td>-</td>"; // No action needed if the order is already delivered
                                }

                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>No orders found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
