<?php
session_start();

// Unset the cart session variable
unset($_SESSION['cart']);

// Redirect back to the product page
header('Location: product.php');
exit();
?>
