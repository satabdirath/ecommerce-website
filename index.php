<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}
else{
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Index</title>
    <style>
      
  /* Adjust font sizes for smaller screens */
  @media only screen and (max-width: 480px) {
    h1 {
      font-size: 23px;
    }
    p {
      font-size: 10px;
      color: white
    }
    .button {
      font-size: 14px;
      padding: 8px 16px;
    }
  }
  
  /* Adjust margin-top for smaller screens */
  @media only screen and (max-width: 767px) {
    h1 {
      margin-top: 50px;
    }
  }
  
  /* Adjust background image size for smaller screens */
  @media only screen and (max-width: 1024px) {
    body {
      background-size: contain;
    }
  }


      body {
        background-image: url('https://media.istockphoto.com/id/1340117122/photo/cube-with-shopping-trolley-symbol-on-the-laptop-keyboard.jpg?b=1&s=170667a&w=0&k=20&c=PU8iTTvTj6TV6_Quy9Z7KQJoOgY-rp_rqI9FbFNFYEw=');
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
        padding: 12px 24px;
        background-color: #4CAF50;
        
        color: white;
        text-align: center;
        font-size: 18px;
        border-radius: 8px;
        margin-top: 50px;
        text-decoration: none;
      }
      .button:hover {
        background-color: blue;
      }
    </style>
  </head>
  <body style="text-align: left;">
  <h1>Welcome <?php echo $row["name"]; ?> <br> To Eshop !! </h1>
  <p> Shop your heart out with our wide selection of products<br> at unbeatable prices! Enjoy a seamless online shopping experience <br>and fast delivery.</p>
  <a href="product.php" class="button">Shop now</a>&nbsp;&nbsp;&nbsp;
  <a href="logout.php" class="button">Logout</a>
</body>

</html>