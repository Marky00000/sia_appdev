<?php
include('connection_db.php');

$product_code = $_GET['product_code'];

$sql_view = "SELECT * FROM products WHERE product_code='$product_code'";
$result_view = $conn->query($sql_view);

if ($result_view->num_rows == 1) {
    $row_view = $result_view->fetch_assoc();
    $product_name = $row_view['product_name'];
    $price = $row_view['price'];
    $profile = $row_view['profile'];
} else {
    echo "Product not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            text-align: center;
            padding-top: 20px;
        }

        img {
            border-radius: 50%;
            margin-bottom: 20px;
            width: 200px; /* Increased image width */
        }

        p {
            margin: 15px 0; /* Increased margin for paragraphs */
            font-size: 18px; /* Increased font size */
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px; /* Increased padding for the button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px; /* Increased font size */
        }

        fieldset {
            margin-bottom: 20px;
            padding: 10px;
            border: 2px solid #4CAF50; /* Green border */
            border-radius: 5px; /* Rounded corners */
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 20px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            margin: 0 auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a.button:hover {
            background-color: #45a049;
        }

        a.delete {
            color: red;
        }

        a.edit {
            color: blue;
        }

        a.view {
            color: green;
        }

        table img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        button {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<fieldset>
    <h2>Product Details</h2>
    <img src="<?php echo $profile; ?>" alt="Product Image">
    <label>Product Name: <?php echo $product_name; ?></label>
    <label>Price: <?php echo $price; ?></label>
    <label>Product Code: <?php echo $product_code; ?></label>
</fieldset>

<button onclick="location.href='http://localhost/crudes%203/crudes/product.php'">Home</button>

</body>
</html>

<?php
$conn->close();
?>
