<?php
require 'config.php';

if (empty($_SESSION["id"])) {
    header("Location: admin_login.php");
}

$id = $_SESSION["id"];
$result = mysqli_query($conn, "SELECT * FROM admin WHERE id = $id");
$row = mysqli_fetch_assoc($result);
$name = $row["name"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
   
</head>
<body>
    <h1 style = "color : white">Welcome <?php echo $name; ?>!</h1>
    <p style="color: white ">You have successfully logged in with the email: <?php echo $row["email"]; ?></p>
    <a href="admin_logout.php" class="button">Logout</a>&nbsp;&nbsp;
    <a href="product_admin.php" class="button">product</a>&nbsp;&nbsp;
    <a href="order request_admin.php" class="button">view request</a>&nbsp;&nbsp;
</body>
</html>