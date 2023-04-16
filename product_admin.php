<?php
require 'config.php';

// If user is not logged in, redirect to login page
if (empty($_SESSION["id"])) {
    header("Location: admin_login.php");
    exit;
}

// Fetch all products from database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Handle form submissions
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price','$image')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product added successfully.');</script>";
        header("Refresh:0");
    } else {
        echo "<script>alert('Error adding product.');</script>";
    }
} elseif (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product updated successfully.');</script>";
        header("Refresh:0");
    } else {
        echo "<script>alert('Error updating product.');</script>";
    }
    
} elseif (isset($_POST['delete_product'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product deleted successfully.');</script>";
        header("Refresh:0");
    } else {
        echo "<script>alert('Error deleting product.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Admin</title>
    <style>
    body {
        background-image: url('https://img.freepik.com/premium-vector/digital-technology-background-abstract-hexagons-background-with-black-lines-dots_322958-633.jpg');
        background-size: cover;
        text-align: center;
        color: black;
      }
      </style>
</head>
<body>
    <h2>Product Admin</h2>

    <h3>Add Product</h3>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step=".01" required>
        <br>
        <label for="image">image:</label>
        <input type="text" id="image" name="image" required>
        <br>

        <button type="submit" name="add_product">Add Product</button>
    </form>
<center>
    <h3>Update/Delete Products</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['image']; ?></td>
                    

                    <td>
                        <form action="" method="post">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<button type="submit" name="update_product">Update</button>
<button type="submit" name="delete_product">Delete</button>
</form>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</center>
</body>
</html>


