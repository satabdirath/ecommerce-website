<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DynaPuff&family=Labrada:ital@1&display=swap" rel="stylesheet">
<style>
		body {
			background-image: url("images/cart.jpg");
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			font-family: Arial, sans-serif;
            margin: 50px;


		}
        
    body {
        font-family: Arial, sans-serif;
        margin: 50px;
    }

    center {
        max-width: 800px;
        margin: auto;
        text-align: center;
    }

    p {
        font-family: 'DynaPuff', cursive;
        font-family: 'Labrada', serif;
        font-size: 34px;
        font-weight: bold;
        color: green;
    }

    /* Adjust layout for smaller screens */
    @media only screen and (max-width: 600px) {
        body {
            margin: 10px;
            background-image: url("gg.hh");
            background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			font-family: Arial, sans-serif;
            margin: 50px;

        }

        center {
            max-width: 400px;
        }

        
  /* Hide the paragraph on screens smaller than 600px */
  p {
    font-size: medium;
  }


    }


        </style>
</head>
<body>


<center>
<?php
require_once 'config.php';

// Set default value for user_id
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Insert order into orders table
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $total = 0;
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $total += $product['price'] * $product['quantity'];
    }
    $sql = "INSERT INTO orders (user_id, total) VALUES ('$user_id', '$total')";
    mysqli_query($conn, $sql);

    // Get order ID
    $order_id = mysqli_insert_id($conn);

    // Insert order details into order_details table
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $quantity = $product['quantity'];
        $price = $product['price'];
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        mysqli_query($conn, $sql);
    }

    // Clear cart
    unset($_SESSION['cart']);

    // Display confirmation message
    
    echo '<p style="font-family: \'DynaPuff\', cursive; font-family: \'Labrada\', serif; font-size: 34px; font-weight: bold; color: green;">Order placed successfully. Thank you for shopping with us!!</p>';


} else {
    // Redirect to shopping page if cart is empty
    header('Location: product.php');
    exit();
}

mysqli_close($conn);
?>
</center>
</body>
</html>