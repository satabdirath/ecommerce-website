<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       /* Base button styles */
button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 10px;
  cursor: pointer;
  border-radius: 5px;
}

button:hover {
  background-color: #3e8e41;
}

/* Center the content */
.center {
  text-align: center;
}

/* Adjust layout for small screens */
@media screen and (max-width: 480px) {
  /* Reduce padding and font size of buttons */
  button {
    padding: 8px 16px;
    font-size: 14px;
  }
  
  /* Make cart product and total layout responsive */
  .cart-product, .cart-total {
    display: block;
    text-align: center;
  }
  
  /* Reduce margin between cart products */
  .cart-product + .cart-product {
    margin-top: 10px;
  }
  
  /* Adjust layout of cart buttons */
  .cart-buttons {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
}


</style>
</head>
<body>
   <center> 
<?php
require_once 'config.php';

// Add product to cart
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        // If the product is already in the cart, do not increment the quantity
    } else {
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['cart'][$product_id] = array(
                "name" => $row['name'],
                "price" => $row['price'],
                "quantity" => 1
            );
        }
    }
}

// Display cart contents
if (!empty($_SESSION['cart'])) {
    $total = 0;
    foreach ($_SESSION['cart'] as $product_id => $product) {
        echo '<div class="cart-product">';
        echo '<h3>' . $product['name'] . '</h3>';
        echo '<p>Price: $' . $product['price'] . '</p>';
        echo '<p>Quantity: ' . $product['quantity'] . '</p>';
        echo '</div>';
        $total += $product['price'] * $product['quantity'];
    }
    echo '<div class="cart-total">';
    echo '<h4>Total: $' . $total . '</h4>';
    echo '</div>';
} else {
    echo 'Your cart is empty.';
}

// Display checkout and back to shopping buttons
echo '<div class="cart-buttons">';
echo '<form method="post" action="checkout.php">';
echo '<button type="submit">Checkout</button>';
echo '</form>';
echo '<form method="get" action="product.php">';
echo '<button type="submit">Back to Shopping</button>';
echo '</form>';
echo '</div>';
echo '<form method="get" action="clear_cart.php">';
echo '<button type="submit">clear cart</button>';
echo '</form>';
echo '</div>';

mysqli_close($conn);
?>
   </center>
</body>
</html>