<?php
require 'config.php';

// Redirect to welcome page if session id is set
if (isset($_SESSION["id"])) {
    header("Location: welcome.php");
    exit;
}

if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM admin  WHERE email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($password == $row['password']) {
            $_SESSION["id"] = $row["id"];
            header("Location: welcome.php");
            exit;
        } else {
            $error = "Wrong Password";
        }
    } else {
        $error = "User Not Registered";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h2>Admin Login</h2>
<center>
<p style="color: red;">Note: this is only for Administrator not fo user</p>
</center>
    <?php if(isset($error)) { ?>
    <div><?php echo $error; ?></div>
    <?php } ?>
    <form class="" action="" method="post" autocomplete="off">
        <label for="usernameemail">Admin Email : </label>
        <input type="text" name="usernameemail" id="usernameemail" required value=""> <br>
        <label for="password">admin Password : </label>
        <input type="password" name="password" id="password" required value=""> <br>
        <button type="submit" name="submit">Login</button>
        <br>
    </form>
</body>
</html>
