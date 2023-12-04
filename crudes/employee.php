<style>
        body {
            font-family: Arial, sans-serif;
        }

        fieldset {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        form p {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            width: auto;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        a {
            text-decoration: none;
            margin-right: 10px;
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
    </style>


<?php
session_start();
include('connection_db.php');
include('global.php');

$id = null;
$fname = null;
$lname = null;
$state = null;
$gender = null;
$agree = null;
$sql = '';

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM `users` WHERE `id`='$id'";
    $result = $conn->query($sql);
    errorCheck($sql, $conn, $result);

    // Redirect to the employee list page after deletion
    header("Location: http://localhost/crudes%203/crudes/employee.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $fname = $row['fname'];
        $lname = $row['lname'];
        $state = $row['state'];
        $gender = $row['gender'];
        $agree = $row['agree'];
        $email = $row['email'];
        $password = $row['password'];
        $profile = $row['profile'];

    }
}

if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $state = $_POST['state'];
    $gender = $_POST['gender'];
    $agree = isset($_POST['agree']) ? 'yes' : 'no';
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_POST['id'])) {
        // Update existing record
        $id = $_POST['id'];

        // Check if a new image is uploaded
        if (!empty($_FILES["image"]["name"])) {
            $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $tmpFile = $_FILES['image']['tmp_name'];
            $filename = mt_rand(1000, 9999) . strtotime("now") . '.' . $ext;
            $result = move_uploaded_file($tmpFile, 'profile/' . $filename);

            // Update with a new image
            $sql = "UPDATE `users` SET `fname`='$fname', `lname`='$lname', `state`='$state', `gender`='$gender', `agree`='$agree', `email`='$email', `password`='$password', `profile`='$filename' WHERE `id`='$id'";
        } else {
            // Update without changing the image
            $sql = "UPDATE `users` SET `fname`='$fname', `lname`='$lname', `state`='$state', `gender`='$gender', `agree`='$agree', `email`='$email', `password`='$password' WHERE `id`='$id'";
        }
    } else {
        // Add a new record
        $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $tmpFile = $_FILES['image']['tmp_name'];
        $filename = mt_rand(1000, 9999) . strtotime("now") . '.' . $ext;
        $result = move_uploaded_file($tmpFile, 'profile/' . $filename);


        $sql = "INSERT INTO `users` (`fname`, `lname`, `state`, `gender`, `agree`, `email`, `password`, `profile`) 
                VALUES ('$fname', '$lname', '$state', '$gender', '$agree', '$email', '$password', '$filename')";
    }

    if (!empty($sql)) {
        $result = $conn->query($sql);
        errorCheck($sql, $conn, $result);
    }

    // Redirect to the employee list page after form submission
    header("Location: http://localhost/crudes%203/crudes/employee.php");
    exit;
}
?>


    <tbody>
        <?php
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
             
            }
        }
        ?>
    </tbody>
</table>

<script>

   $(":input").keypress(function(event){
    if (event.which == '10' || event.which == '13') {
        event.preventDefault();
    }
});
</script>



<form method="POST" action="" enctype="multipart/form-data">
    <label style="font-size: 50px">Add Employee</label>
    <p>Employee Image <input type="file" name="image" accept="image/png, image/jpeg"></p>
    <?php if (isset($id)) { ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php } ?>
    <p>First Name <input name="fname" value="<?= isset($fname) ? $fname : '' ?>"    required> </p>
    <p>Last Name <input name="lname" value="<?= isset($lname) ? $lname : '' ?>" required> </p>
    <select name="state"    required>
        <option value="cdo" <?= $state === 'cdo' ? 'selected' : '' ?>> CDO</option>
        <option value="opol" <?= $state === 'opol' ? 'selected' : '' ?>> OPOL</option>
        <option value="molugan" <?= $state === 'molugan' ? 'selected' : '' ?>> MOLUGAN</option>
        <option value="igpit" <?= $state === 'igpit' ? 'selected' : '' ?>> IGPIT</option>
        <option value="elsalvador" <?= $state === 'elsalvador' ? 'selected' : '' ?>>EL SALVADOR</option>

    </select>
    <p>Gender
        <br>
        <input type="radio" name="gender" value="male" <?= $gender === 'male' ? 'checked' : '' ?>> Male<br>
        <input type="radio" name="gender" value="female" <?= $gender === 'female' ? 'checked' : '' ?>> Female<br>
        <input type="radio" name="gender" value="other" <?= $gender === 'other' ? 'checked' : '' ?>> Other
    </p>
    <p>Agree Terms<input type="checkbox" name="agree" <?= $agree === 'yes' ? 'checked' : '' ?>>
    </p>
    <p>Email <input name="email" value="<?= isset($email) ? $email : '' ?>" required> </p>
    <p>Password <input type="password" name="password" value="<?= isset($password) ? $password : '' ?>" required> </p>
    <br> <br>
    <?php if (isset($id)) { ?>
        <a href="http://localhost/crudes%203/crudes/employee.php">Cancel</a>
        <button>Update</button>
    <?php } else { ?>
        <button>Save</button>
    <?php } ?>
    <button onclick="location.href='http://localhost/crudes%203/crudes/dashboard.php'">Home</button>

</form>

List Of Employee

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>State</th>
            <th>Gender</th>
            <th>Agree Terms</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>

    </thead>

    <tbody>

        <?php
        $sql = "SELECT * FROM users";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr id = "<?php echo $row['id']; ?>">
                    <td>
                        <a target="blank" href="profile/<?php echo $row['profile']; ?>"> <img width="100" src="profile/<?php echo $row['profile']; ?>" />
                        </a>
                    </td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['agree']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>

                    <td width="200">
                        <a href="?action=delete&id=<?php echo $row['id']; ?>" style="color: red; background-color: transparent"> DELETE </a>
                        <a href="?action=edit&id=<?= $row['id'] ?>&fname=<?= $row['fname'] ?>&lname=<?= $row['lname'] ?>&state=<?= $row['state'] ?>&gender=<?= $row['gender'] ?>&agree=<?= $row['agree'] ?>&email=<?= $row['email'] ?>&password=<?= $row['password'] ?>&profile=<?= $row['profile'] ?>">EDIT</a>
                        <a style="color: green" href="view.php?id=<?= $row['id'] ?>"> VIEW </a>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>

</table>

<script>

   $(":input").keypress(function(event){
    if (event.which == '10' || event.which == '13') {
        event.preventDefault();
    }
});


</script>




