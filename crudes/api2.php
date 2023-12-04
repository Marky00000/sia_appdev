<?php
include('connection_db.php');
include('global.php');

if (isset($_GET['action'])   && $_GET['action'] === 'get-customer') {
    $itemRecords = array();
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $itemDetails = array(
                "id" => $row['id'],
                "product_name" => $row['product_name'],
                "product_code" => $row['product_code'],
                "price" => $row['price'],
            );
            array_push($itemRecords, $itemDetails);
        }
    }
    echo json_encode([
        'success' => true,
        'products' => $itemRecords,
    ]);
    
 } else if (isset($_POST['action'])  && $_POST['action']  === 'save-customer') {
    

}else{
    echo json_encode([
		'success' => false,
		'message' => 'Request not found',
	]);
}
