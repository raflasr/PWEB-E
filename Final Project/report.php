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

// Get the current month
$current_month = date('Y-m'); // Format: YYYY-MM

// Query to get all orders for the current month with total quantity for each product
$sql_orders = "SELECT o.id, o.product_id, o.customer_name, o.customer_email, o.customer_phone, o.delivery_address, o.total_price, o.order_date, o.delivery_status, p.name AS product_name
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE DATE_FORMAT(o.order_date, '%Y-%m') = '$current_month'
        ORDER BY o.order_date DESC"; // Order by most recent

$result_orders = $conn->query($sql_orders);

// Query to get the total quantity of each product sold in the current month
$sql_product_totals = "SELECT product_id, SUM(quantity) AS total_quantity
        FROM orders
        WHERE DATE_FORMAT(order_date, '%Y-%m') = '$current_month'
        GROUP BY product_id";
$result_product_totals = $conn->query($sql_product_totals);

// Store product quantities in an associative array
$product_quantities = [];
while ($row = $result_product_totals->fetch_assoc()) {
    $product_quantities[$row['product_id']] = $row['total_quantity'];
}

// Query to get financial data (total revenue) for the current month
$sql_revenue = "SELECT SUM(total_price) AS total_revenue FROM orders WHERE DATE_FORMAT(order_date, '%Y-%m') = '$current_month'";
$result_revenue = $conn->query($sql_revenue);
$total_revenue = $result_revenue->fetch_assoc()['total_revenue'];

require('fpdf/fpdf.php'); // Include the FPDF library

// Generate the PDF report if the download button is clicked
if (isset($_POST['download_pdf'])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Bakery Order Report for ' . date('F Y', strtotime($current_month)), 0, 1, 'C');
    $pdf->Ln(10);
    
    // Orders Table Header
    $pdf->SetFont('Arial', 'B', 12);
    
    // Set X to move the table left
    $pdf->SetX(5); // Change 20 to 10 for closer to the left

    // Header without Quantity
    $header = ['Order ID', 'Product', 'Customer Name', 'Total Price', 'Order Date', 'Total Quantity'];
    $col_widths = [20, 40, 40, 30, 40, 30]; // Adjust widths to match content size
    
    // Create header
    for ($i = 0; $i < count($header); $i++) {
        $pdf->Cell($col_widths[$i], 10, $header[$i], 1, 0, 'C');
    }
    $pdf->Ln();
    
    // Table Content
    $pdf->SetFont('Arial', '', 12);
    if ($result_orders->num_rows > 0) {
        while ($row = $result_orders->fetch_assoc()) {
            $pdf->SetX(5); // Start each row at the same X position (move to the left)
            
            $pdf->Cell($col_widths[0], 10, $row['id'], 1);
            $pdf->Cell($col_widths[1], 10, $row['product_name'], 1);
            $pdf->Cell($col_widths[2], 10, $row['customer_name'], 1);
            $pdf->Cell($col_widths[3], 10, 'Rp ' . number_format($row['total_price'], 2, ',', '.'), 1);
            $pdf->Cell($col_widths[4], 10, $row['order_date'], 1, 0);
            
            // Display total quantity for the product in the order
            $product_id = $row['product_id']; // Get the product ID from the order
            $total_quantity = isset($product_quantities[$product_id]) ? $product_quantities[$product_id] : 0;
            $pdf->Cell($col_widths[5], 10, $total_quantity, 1, 1, 'C');
        }
    } else {
        $pdf->Cell(0, 10, 'No orders found for this month.', 1, 1, 'C');
    }

    // Add a space after the table
    $pdf->Ln(10);

    // Revenue section
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Total Revenue: Rp ' . number_format($total_revenue, 2, ',', '.'), 0, 1, 'C');

    // Output the PDF to browser
    $pdf->Output();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdf5e6;
            color: #333;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 200px;
            background-color: #f8e8d8;
            padding: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1.1em;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #8b4513;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f7d9c4;
        }

        .status-delivered {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .total-revenue {
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
            padding: 10px;
            margin-top: 20px;
        }

        .btn-deliver {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-deliver:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
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
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>
        </aside>

        <main class="main-content">
            <header>
                <h1>Monthly Report</h1>
            </header>

            <section class="orders-table">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Customer Name</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Total Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_orders->num_rows > 0) {
                            while ($row = $result_orders->fetch_assoc()) {
                                $status_class = $row['delivery_status'] == 'Delivered' ? 'status-delivered' : 'status-pending';
                                $status_text = $row['delivery_status'] == 'Delivered' ? 'Delivered' : 'Pending';

                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['product_name'] . "</td>";
                                echo "<td>" . $row['customer_name'] . "</td>";
                                echo "<td>" . number_format($row['total_price'], 2) . "</td>";
                                echo "<td>" . $row['order_date'] . "</td>";
                                
                                // Display total quantity for the product in the order
                                $product_id = $row['product_id']; // Get the product ID from the order
                                $total_quantity = isset($product_quantities[$product_id]) ? $product_quantities[$product_id] : 0;
                                echo "<td>" . $total_quantity . "</td>";
                                
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No orders found for this month.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="total-revenue">
                    <strong>Total Revenue: </strong>Rp <?= number_format($total_revenue, 2, ',', '.') ?>
                </div>
            </section>

            <form method="post">
                <button type="submit" name="download_pdf" class="btn-deliver">Download PDF Report</button>
            </form>
        </main>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
