<?php
include('connection_db.php');

header('Content-Type: application/json');

if (isset($_GET['product_code'])) {
    $product_code = $_GET['product_code'];
    $sql_details = "SELECT * FROM `products` WHERE `product_code`='$product_code'";
    $result_details = $conn->query($sql_details);

    if ($result_details->num_rows == 1) {
        $row_details = $result_details->fetch_assoc();
        echo json_encode($row_details);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'Product code not provided']);
}

$conn->close();
?>
