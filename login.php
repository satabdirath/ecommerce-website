<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: index.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <title>Document</title>
    </title>
    <style>
     /* Default styles for all devices */
     body {
  background-image: url('https://static-blog.omniconvert.com/blog/wp-content/uploads/2020/09/21135804/How-to-do-Growth-of-eCommerce-Website-scaled.jpg');
  background-size: cover;
  font-family: Arial, sans-serif;
  background-color: #F9F9F9;
  }
@media only screen and (max-width: 600px) {
  .background-image {
    background-image: url('phone-background-image.jpg');
    background-size: cover;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
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
    <h2>Login</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="usernameemail">Email : </label>
      <input type="text" name="usernameemail" id = "usernameemail" required value=""> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password" required value=""> <br>
      <button type="submit" name="submit">Login</button>
      <br>


      <div style="display: flex; justify-content: space-between; align-items: center;">
  <button style="width: 100px; height: 30px; background-color: watermelon; border: none;"><a href="registration.php" style="text-decoration: none; color: white;">Register</a></button>


  

  <a href="forgot_password.php" style="text-decoration: none; margin-right: 20px;">Forgot password?</a>
  
</div>
<div>
<a href="admin_login.php" style="text-decoration: none; margin-right: 20px;">Admin login</a>
</div>

  </form>
  </body>
</html>

