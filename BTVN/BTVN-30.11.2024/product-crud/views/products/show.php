<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <style>
    h1 {
        font-size: 2.5em;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-family: 'Roboto', sans-serif;
        position: relative;
        transition: color 0.3s ease;
    }

    h1::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50%;
        height: 4px;
        background-color: #007bff;
        border-radius: 2px;
        transition: width 0.3s ease;
    }

    h1:hover {
        color: #007bff;
    }

    h1:hover::after {
        width: 100%;
    }
</style>

</head>
<body>
<?php
if (isset($products)) {
    echo "
    <style>
        .product-details {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Arial', sans-serif;
        }

        .product-title {
            font-size: 2em;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .product-info p {
            font-size: 1.1em;
            color: #333;
            margin: 10px 0;
        }

        .product-info strong {
            font-weight: bold;
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1.1em;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .back-link:hover {
            background-color: #0056b3;
        }
    </style>

    <div class='product-details'>
        <h1 class='product-title'>Product Details</h1>
        <div class='product-info'>
            <p><strong>Name:</strong> " . htmlspecialchars($products["name"]) . "</p>
            <p><strong>Price:</strong> $" . number_format($products["price"], 2) . "</p>
        </div>
        <a class='back-link' href='index.php'>Back</a>
    </div>
    ";
}
?>


</body>
</html>
