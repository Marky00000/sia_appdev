<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        fieldset {
            width: 300px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        legend {
            font-size: 20px;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
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
            margin-bottom: 15px;

            
        }

        a {
            text-decoration: none;
            color: #333;
            margin-top: 10px;
        }
    </style>

<?php
session_start();
include('connection_db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Do not hash the password in this case

    // Check if the username is already taken
    $checkUsername = "SELECT * FROM admin WHERE username='$username'";
    $resultUsername = $conn->query($checkUsername);

    if ($resultUsername->num_rows > 0) {
        // Username is already taken
        echo '<script>alert("Username is already taken. Please choose another username.");</script>';
    } else {
        // Register the admin user with the plain (unhashed) password
        $sql = "INSERT INTO admin (email, username, password) VALUES ('$email', '$username', '$password')";
        $result = $conn->query($sql);

        if ($result) {
            echo '<script>alert("Admin user registered successfully!");</script>';
        } else {
            echo '<script>alert("Error registering admin user. Please try again.");</script>';
        }
    }
}
?>


<fieldset>
    <legend>Admin Register</legend>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="adminRegistrationForm">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="register" id="register">Register</button>
        <button onclick="location.href='http://localhost/crudes%203/crudes/login.php'">Admin Login</button>
    </form>
</fieldset>


          
