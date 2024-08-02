<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p style='color: red;'>Product not found</p>";
        exit();
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, quantity = ? WHERE id = ?");
    $stmt->bind_param("ssdii", $name, $description, $price, $quantity, $id);

    if ($stmt->execute()) {
        header("Location: view_products.php");
        exit();
    } else {
        $message = "<p style='color: red;'>Error updating product: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-size: 1.1em;
            text-align: left;
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 15px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        p {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>
        <?php if (isset($message)) echo $message; ?>
        <form method="post" action="edit_product.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($row['description']); ?>" required>
            
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" required>
            
            <input type="submit" value="Update Product">
        </form>
    </div>
</body>
</html>
