<?php
require 'config.php';

if(isset($_POST["submit"])){
  $username = $_POST["username"];

  // check if username exists
  $result = mysqli_query($conn, "SELECT * FROM users WHERE name = '$username'");
  if(mysqli_num_rows($result) == 0){
    $message = "<span style='color:red'>Username not found.</span>";
  } else {
    // get the new password from user
    $new_password = $_POST["new_password"];

    // update user's password in database
    mysqli_query($conn, "UPDATE users SET password = '$new_password' WHERE name = '$username'");

    // show success message
    $message = "<span style='color:green'>Your password has been reset.</span>";
   
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password</title>
    <style>
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
        background-color: #ffffff;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
      }
      form {
  background: transparent;
}

 form input, form button, form a {
  background-color: rgba(255, 255, 255, 0.2); /* set the background color with 20% opacity */
  border: none;
  border-radius: 5px;
  color: #fff; /* set the text color to white */
  padding: 10px;
  margin: 10px;
  display: block;
  width: 100%;
  max-width: 400px;
}

form label, form input {
  font-size: 20px;
}

form button, form a {
  font-size: 24px;
  cursor: pointer;
}

form input[type="text"], form input[type="email"], form input[type="password"] {
  box-sizing: border-box;
  width: 100%;
  max-width: 400px;
}

form input[type="text"]:focus, form input[type="email"]:focus, form input[type="password"]:focus {
  background-color: rgba(255, 255, 255, 0.3); /* set the background color with 30% opacity when the input is focused */
}

form a {
  text-align: center;
  text-emphasis-color: black;
  margin-top: 20px;
  text-decoration: none;
}

form a:hover {
  text-decoration: underline;
}

form ::-webkit-input-placeholder {
  /* WebKit browsers */
  color: #fff;
  opacity: 0.5;
}

form :-moz-placeholder {
  /* Mozilla Firefox 4 to 18 */
  color: #fff;
  opacity: 0.5;
}

form ::-moz-placeholder {
  /* Mozilla Firefox 19+ */
  color: #fff;
  opacity: 0.5;
}

form :-ms-input-placeholder {
  /* Internet Explorer 10+ */
  color: #fff;
  opacity: 0.5;
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
   
      button[name=submit] {
        background-color: #ff9999;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        float: left;
      }
   
      button[name=submit]:hover {
        opacity: 0.8;
      }
   
      a[href="login.php"] {
        float: right;
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
   
      @media screen and (max-width: 300px) {
        span.psw {
          display: block;
          float: none;
        }
   
        button[name=submit] {
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
    <div>
  <form method="post">
    <h1>Forgot Password</h1>
    <?php if(isset($message)) echo "<p>$message</p>"; ?>
   
      <label for="username">Username:</label>
      <input type="text" name="username" required>
      <br>
      <label for="new_password">New Password:</label>
      <input type="password" name="new_password" required>
      <br>
      <button type="submit" name="submit">Reset Password</button>
      <a href="login.php"  style="color: black;">Back to Login</a><br>
      


    </form>
    </div>
  </body>
</html>
