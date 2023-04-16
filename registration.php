<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["login"])){
  $email = $_POST["email"];
  $password = $_POST["password"];
  $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION["id"] = $row["id"];
    $_SESSION["name"] = $row["name"];
    header("Location: index.php");
  }
  else{
    echo
    "<script> alert('Invalid Email or Password'); </script>";
  }
}
if(isset($_POST["register"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Email Has Already Been Used'); </script>";
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO users (name, email, password) VALUES('$name','$email','$password')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration Successful'); </script>";
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>
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
        background-color: transparent;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
      }

      h2 {
        text-align: center;
        margin-top: 0;
      }

      input[type=text], input[type=email], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }

      button {
        background-color: #E75450;
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
      .container input[type="text"],
.container input[type="email"],
.container input[type="password"],
.container textarea {
  background-color: rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(5px);
}


      
    </style>

    <script>
  /* Select the password and confirm password input fields
  const passwordInput = document.querySelector('input[name="password"]');
  const confirmPasswordInput = document.querySelector('input[name="confirmpassword"]');
  
  // Add an event listener to the submit button
  const submitButton = document.querySelector('button[type="submit"]');
  submitButton.addEventListener('click', function(event) {
    // Prevent the form from submitting by default
    event.preventDefault();

    // Check if the passwords match
    if (passwordInput.value !== confirmPasswordInput.value) {
      alert("Passwords do not match");
      return;
    }
    
    // Check if the password has at least one uppercase letter and is at least 6 characters long
    const passwordRegex = /^(?=.*[A-Z]).{6,}$/;
    if (!passwordRegex.test(passwordInput.value)) {
      alert("Password must contain at least one uppercase letter and be at least 6 characters long");
      return;
    }
    
    // If all checks pass, submit the form
    event.target.submit();
  });*/
</script>

  </head>
  <body>
    <h2>Registration</h2>
    <form method="post" autocomplete="off">
      <div class="container">
        <label for="name"><b>Name:</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>

        <label for="email"><b>Email:</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>

        <label for="password"><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label for="confirmpassword"><b>Confirm Password:</b></label>
        <input type="password" placeholder="Confirm Password" name="confirmpassword" required>

        <button type="submit" name="register">Register</button>
      </div>
    </form>
  </body>
</html>
