<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="../../public/styles.css">
        <style>
        /* Reset mặc định của trình duyệt */
        body, h1, ul, li, form, label, input, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form thêm sản phẩm */
form {
    background-color: #f9f9f9;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    margin-bottom: 50px;
    font-family: 'Roboto', sans-serif;
    transition: all 0.4s ease-in-out;
    border: 1px solid #ddd;
}

form:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

form label {
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
    color: #333;
    font-size: 1.1em;
}

form input {
    width: 100%;
    padding: 14px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1.1em;
    box-sizing: border-box;
    transition: all 0.3s ease;
    background-color: #f4f4f4;
}

form input:focus {
    border-color: #007bff;
    background-color: #ffffff;
    outline: none;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
}

form button {
    width: 100%;
    padding: 14px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.1em;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.1);
}

form button:hover {
    background-color: #0056b3;
    transform: translateY(-3px);
}

form button:active {
    background-color: #004080;
}

/* Table styling */
table {
    width: 100%;
    max-width: 700px;
    border-collapse: collapse;
    background: linear-gradient(145deg, #ffffff, #f4f4f4);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    margin: 0 auto;
    overflow: hidden;
    border: 1px solid #ddd;
}

thead {
    background-color: #007bff;
    color: white;
}

thead th {
    padding: 15px;
    font-size: 1.1em;
    font-weight: 700;
    text-align: left;
    letter-spacing: 1px;
}

tbody tr {
    border-bottom: 1px solid #f1f1f1;
}

tbody td {
    padding: 14px;
    font-size: 1em;
    color: #333;
}

tbody tr:hover {
    background-color: #f9f9f9;
    transition: background-color 0.3s ease;
}

tbody td a {
    text-decoration: none;
    color: #007bff;
    margin: 0 8px;
    font-weight: 500;
    transition: color 0.3s ease;
}

tbody td a:hover {
    text-decoration: underline;
    color: #0056b3;
}

/* Paragraph styling */
p {
    font-size: 1.3em;
    color: #555;
    text-align: center;
    font-weight: 600;
    margin-top: 30px;
}

/* Subtle animations */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

form button {
    animation: pulse 1.5s infinite ease-in-out;
}


    </style>

</head>
<body>

<?php
echo "<h1>Product List</h1>";

echo "<form method='POST' action='?action=create'>
        <label for='name'>Product Name:</label>
        <input type='text' id='name' name='name' required>
        <label for='price'>Price:</label>
        <input type='number' id='price' name='price' required>
        <button type='submit'>Add Product</button>
      </form>";

if (isset($products) && !empty($products)) {
    echo "<table>";
    echo "<thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
          </thead>";
    echo "<tbody>";
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($product['name']) . "</td>";
        echo "<td>$" . htmlspecialchars(number_format($product['price'], 2)) . "</td>";
        echo "<td>
                <a href='?action=show&id=" . $product['id'] . "'>View</a> | 
                <a href='?action=update&id=" . $product['id'] . "'>Edit</a> | 
                <a href='?action=delete&id=" . $product['id'] . "' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}

?>


</body>
</html>
