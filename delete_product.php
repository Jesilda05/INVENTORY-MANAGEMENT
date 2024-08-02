<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect to view_products.php without a message
    header("Location: view_products.php");
    exit();
} else {
    // Redirect to view_products.php if no ID is provided
    header("Location: view_products.php");
    exit();
}
