<?php
include('connection_db.php');
include('global.php');


if (isset($_POST['action'])  && $_POST['action']  === 'save-customer') {
	$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $tmpFile = $_FILES['image']['tmp_name'];
    $filename = mt_rand(1000, 9999).strtotime("now").'.'.$ext;
    $result = move_uploaded_file($tmpFile, 'profile/'.$filename);
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$state = $_POST['state'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$agree = isset($_POST['agree']) ? 'yes' : 'no';
	$sql = "INSERT INTO `users`(`fname`, `lname`, `state`, `gender`, `agree`, `email`, `password`,`profile`) VALUES ('$fname','$lname','$state','$gender','$agree','$email','$password','$filename')";
	$result = $conn->query($sql);
	if ($result == TRUE) {
		echo json_encode([
			'success' => true,
			'message' => 'User successfully saved',
		]);
	} else {
		echo json_encode([
			'success' => false,
			'message' => $sql . "<br>" . $conn->error,
		]);
	}
} else if (isset($_POST['action'])   && $_POST['action'] === 'get-customer') {
	$itemRecords = array();
	$sql = "SELECT * FROM users";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$itemDetails=array(
				"id" => $row['id'],	
				"fname" => $row['fname'],		
			); 
		   array_push($itemRecords, $itemDetails);
		}
	}
	echo json_encode([
		'success' => true,
		'users' => $itemRecords,
	]);
} else if (isset($_POST['action'])   && $_POST['action'] === 'get-customer-details') {
	$id = $_POST['id'];
	$sql = "SELECT * FROM `users` WHERE id=$id ";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	echo json_encode([
		'success' => true,
		'user' => $row,
	]);
} else if (isset($_GET['action'])   && $_GET['action'] === 'all-products') {
	$itemRecords = array();
	$sql = "SELECT * FROM products";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$itemDetails=array(
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
} else {
	echo json_encode([
		'success' => false,
		'message' => 'Request not found',
	]);
}

/*
https://reqbin.com/
endpoint
http://localhost/sia/crudes/api.php

// for save customer


action=save-customer
fname=Niel
lname=Niel
state=Niel
gender=male
profile=
agree=yes
email=niel.daculan@gmail.com
password=123456


get customer
action=get-customer


for final prodject 

Admin Dashboard
-Create, View and edit category
-Create, View and edit products
-Create, View and edit employee
- View  employee sales

assignment
- api edit and delete user
-Login form with redirection 
-Displaylogin user into dashboard(Fname, Lname) 
Mobile 
- View Product list
- POS DASHBOARD
- Sales History

Debugging individual
*/