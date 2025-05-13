<?php
session_start(); // ✅ Start the session
require 'config.php';

// If user already logged in, redirect to product page
if (!empty($_SESSION["id"])) {
    header("Location: product.php");
    exit();
}

// Handle login form submission
if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        // If using hashed password, use password_verify()
        if ($password === $row['password']) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            header("Location: product.php");
            exit();
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('User Not Registered');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post" autocomplete="off">
        <label for="usernameemail">Email:</label>
        <input type="text" name="usernameemail" id="usernameemail" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit" name="submit">Login</button><br>

        <div>
            <a href="registration.php">Register</a> |
            <a href="forgot_password.php">Forgot password?</a> |
            <a href="admin_login.php">Admin login</a>
        </div>
    </form>
</body>
</html>
