<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style> /* Your existing styles remain unchanged */ body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; } h1 { background-color: #4CAF50; color: white; padding: 20px; text-align: center; margin: 0; } table { width: 80%; margin: 20px auto; border-collapse: collapse; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); } th, td { border: 1px solid #ddd; padding: 10px; text-align: left; } th { background-color: #4CAF50; color: white; } tr:nth-child(even) { background-color: #f9f9f9; } tr:hover { background-color: #f1f1f1; } td:first-child { width: 40%; } td:nth-child(2), td:nth-child(3) { width: 30%; } td, th { transition: background-color 0.3s; } /* Styling for the Home button */ a.button { display: inline-block; padding: 10px 20px; margin: 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; } a.button:hover { background-color: #45a049; } a { text-decoration: none; color: #333; } a:hover { color: #4CAF50; } /* Added style for product images */ table img { width: 100px; /* Adjust this value as needed */ height: auto; display: block; margin: 0 auto; /* Center the image within the cell */ } } fieldset { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; } form { max-width: 600px; margin: 0 auto; } form p { margin-bottom: 15px; } label { display: block; margin-bottom: 5px; font-weight: bold; } input, select { width: 100%; padding: 8px; box-sizing: border-box; } input[type="checkbox"] { width: auto; } button { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; } </style>
</head>
<body>

<?php
include('connection_db.php');

if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    $edit_category_id = $_GET['category_id']; // Assuming the column name is 'category_id'
    $edit_sql = "SELECT * FROM `category` WHERE `category_id`='$edit_category_id'";
    $edit_result = $conn->query($edit_sql);

    if ($edit_result->num_rows > 0) {
        $edit_row = $edit_result->fetch_assoc();
        $edit_category = $edit_row['category'];
    } else {
        echo '<script>alert("Error fetching category for editing: Category not found");</script>';
        // Redirect or handle the error as needed
    }
}
?>

<fieldset>
    <form method="post" action="" enctype="multipart/form-data">
        <?php if(isset($edit_category_id)): ?>
        <label style="font-size: 50px">Edit Category</label>
        <?php else: ?>
        <label style="font-size: 50px">Add Category</label>
        <?php endif; ?>
        <p>Category <input name="<?= isset($edit_category_id) ? 'edit_category' : 'category' ?>" value="<?= isset($edit_category) ? $edit_category : '' ?>" required /></p>
        <!-- Add a hidden input field to store the category ID -->
        <?php if(isset($edit_category_id)): ?>
        <input type="hidden" name="edit_category_id" value="<?= isset($edit_category_id) ? $edit_category_id : '' ?>" />
        <?php endif; ?>

        <?php if(isset($edit_category_id)): ?>
        <button type="submit" name="update">Update</button>
        <button type="button" onclick="location.href='http://localhost/crudes%203/crudes/category.php'">Cancel</button>
        <?php else: ?>
        <button type="submit" name="save">Save</button>
        <?php endif; ?>
    </form>
</fieldset>

</body>
</html>

<?php
include('connection_db.php'); // Make sure to include your database connection file

if (isset($_POST['save'])) {
    $category = $_POST['category'];
    $sql = "INSERT INTO `category`(`category`) VALUES ('$category')";
    $result = $conn->query($sql);

    if ($result) {
        echo '<script>alert("Category successfully saved!");</script>';
    } else {
        // Handle errors if needed
        echo '<script>alert("Error: ' . $conn->error . '");</script>';
    }
}

if (isset($_POST['update'])) {
    $edit_category_id = $_POST['edit_category_id'];
    $edit_category = $_POST['edit_category'];
    $edit_sql = "UPDATE category SET category = '$edit_category' WHERE category_id = '$edit_category_id'";
    $edit_result = $conn->query($edit_sql);

    if ($edit_result) {
        echo '<script>alert("Category successfully updated!");</script>';
        header("Location: http://localhost/crudes%203/crudes/category.php");
        exit;
    } else {
        echo '<script>alert("Error updating category: ' . $conn->error . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>
<body>

<h1> Category</h1>

<table>
    <thead>
        <tr>
            <th>Category ID</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td>
                        <a style="color: red" href="?action=delete&category_id=<?= $row['category_id'] ?>"> DELETE </a>
                        <a style="color: blue" href="?action=edit&category_id=<?= $row['category_id'] ?>"> EDIT </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="3">No categories found</td></tr>';
        }
        ?>

    </tbody>
</table>

<center><a class="button" href="http://localhost/crudes%203/crudes/dashboard.php">Home</a></center>

</body>
</html>
