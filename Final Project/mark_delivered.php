<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "bakery");

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Update order status to "delivered"
    $sql = "UPDATE orders SET delivery_status = 'Delivered' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Order marked as delivered!'); window.location.href='delivery_product.php';</script>";
    } else {
        echo "<script>alert('Failed to mark order as delivered.'); window.location.href='delivery_product.php';</script>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
