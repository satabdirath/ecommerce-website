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
    <style>
      body {
        background-image: url('https://c4.wallpaperflare.com/wallpaper/431/57/206/geometry-geometric-web-dark-wallpaper-preview.jpg');
        background-size: cover;
        text-align: center;
        color: black;
      }
      h1 {
        margin-top: 100px;
        font-size: 50px;
      }
      p {
        font-size: 24px;
      }
      .button {
        display: inline-block;
        padding: 8px 18px;
        background-color: blue;
        
        color: white;
        text-align: center;
        font-size: 18px;
        
        
        text-decoration: none;
      }
      .button:hover {
        background-color: blue;
      }
    </style>
</head>
<body>
    <h1 style = "color : white">Welcome <?php echo $name; ?>!</h1>
    <p style="color: white ">You have successfully logged in with the email: <?php echo $row["email"]; ?></p>
    <a href="admin_logout.php" class="button">Logout</a>&nbsp;&nbsp;
    <a href="product_admin.php" class="button">product</a>&nbsp;&nbsp;
    <a href="order request_admin.php" class="button">view request</a>&nbsp;&nbsp;
</body>
</html>