<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: 2px solid #4CAF50;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        h1,
        h2 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .logout-btn {
            background-color: #f44336;
            padding: 8px 12px; /* Smaller padding */
            font-size: 14px; /* Smaller font size */
        }

        /* Add some spacing */
        .logout-btn-container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <fieldset>
            <h1>Admin Dashboard</h1>
        </fieldset>

        <div id="addProduct">
            <!-- Add Product Form -->
            <h2>Add Product</h2>
            <form method="post" action="product.php">
                <!-- Product details input fields -->
                <button type="submit">Add Product</button>
            </form>
        </div>

        <div id="addEmployee">
            <!-- Add Employee Form -->
            <h2>Add Employee</h2>
            <form method="post" action="employee.php">
                <!-- Employee details input fields -->
                <button type="submit">Add Employee</button>
            </form>
        </div>

        <div id="addCategory">
            <!-- Add Category Form -->
            <h2>Add Category</h2>
            <form method="post" action="category.php">
                <!-- Category details input fields -->
                <button type="submit">Add Category</button>
            </form>
        </div>

        <!-- Logout Button with smaller size and spacing -->
        <div class="logout-btn-container">
            <form method="post" action="login.php">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
session_start();

// Check if the user is not authenticated, redirect to login
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit;
}

// Handle logout
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to login page after logout
    header("Location: login.php");
    exit;
}
?>
