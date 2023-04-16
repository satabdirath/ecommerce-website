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
    <style>
      /* Default styles for all devices */
      body {
  background-image: url('https://static-blog.omniconvert.com/blog/wp-content/uploads/2020/09/21135804/How-to-do-Growth-of-eCommerce-Website-scaled.jpg');
  background-size: cover;
  font-family: Arial, sans-serif;
  background-color: #F9F9F9;
  }
  @media only screen and (max-width: 600px) {
  body {
    background-image: url('phone-background-image.jpg');
    background-size: cover;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
  }
  
  form {
    max-width: 100%;
  }
  
  input[type=text], input[type=password], button {
    width: 100%;
    margin: 8px 0;
  }
  
  .registerbtn {
    width: auto;
    padding: 10px;
  }
}





form {
  border: 3px solid #f1f1f1;
  background-color: #fee0f1;
  backdrop-filter: blur(10px); 
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
}
#usernameemail {
  background-color: rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(5px); 
}
#password{
  background-color: rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(5px);
}

h2 {
  text-align: center;
  margin-top: 0;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #E75480;
  border-radius: 10px; 

  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.registerbtn {
  border-radius: 10px;
  width: auto;
  padding: 10px 18px;
  background-color: #ff9999;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
</style>
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
