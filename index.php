<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ff7e5f, #feb47b); /* Gradient background */
            color: #333;
            text-align: center;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 50px auto;
            overflow: hidden;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            background-color: #5cb85c;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px;
            font-size: 18px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        a:hover {
            background-color: #4cae4c;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inventory Management System</h1>
        <a href="add_product.php">Add Product</a>
        <a href="view_products.php">View Products</a>
    </div>
</body>
</html>
