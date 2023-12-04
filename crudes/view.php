<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>

<?php
include('connection_db.php');
include('global.php');

$id = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE id=$id ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<?php if (isset($row)) { ?>
    <label style="font-size: 30px">Employee Information</label>
    <fieldset> 
    <img src="profile/<?php echo $row['profile']; ?>" alt="Profile Picture">
    <p>First Name:   <?= $row['fname'] ?></p>
    <p>Last Last Name:   <?= $row['lname'] ?></p>
    <p>Gender:   <?= $row['gender'] ?></p>
    <p>State:   <?= $row['state'] ?></p>
    <p>Email:   <?= $row['email'] ?></p>

<?php } else { ?>
    <p>User not found!</p>
<?php } ?>
<button onclick="location.href='http://localhost/crudes%203/crudes/employee.php'">Home</button>
</fieldset>

</body>
</htm
