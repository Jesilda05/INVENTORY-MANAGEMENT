<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $name, $description, $price, $quantity);

    if ($stmt->execute()) {
        // Redirect to view_products.php after successful insertion
        header("Location: view_products.php");
        exit(); // Make sure to exit after the redirection
    } else {
        $message = "<p class='error'>Error: " . $stmt->error . "</p>";
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
    <title>Add Product</title>
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
            width: 90%;
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
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-size: 1.1em;
            text-align: left;
            width: 100%;
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            margin-top: 5px;
            width: calc(100% - 22px);
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #5cb85c;
            outline: none;
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

        .success {
            color: #5cb85c;
            font-size: 1.2em;
        }

        .error {
            color: #d9534f;
            font-size: 1.2em;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Product</h1>
        <?php if (isset($message)) echo $message; ?>
        <form method="post" action="add_product.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
            
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            
            <input type="submit" value="Add Product">
        </form>
    </div>
</body>
</html>
