<?php
session_start();
require_once 'config.php';

// Redirect to login if not logged in
if (empty($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// Add product to cart
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    if (!isset($_SESSION['cart'][$product_id])) {
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['cart'][$product_id] = array(
                "name" => $row['name'],
                "price" => $row['price'],
                "image" => $row['image'], // assuming 'image' column
                "quantity" => 1
            );
        }
    }
}

// Handle quantity updates
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    if (isset($_SESSION['cart'][$product_id])) {
        if ($action === 'increase') {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } elseif ($action === 'decrease') {
            $_SESSION['cart'][$product_id]['quantity'] -= 1;
            if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
        }
        .cart-product {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
            gap: 20px;
        }
        .cart-product img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .cart-details {
            flex-grow: 1;
        }
        .cart-details h3 {
            margin: 0;
            color: #333;
        }
        .cart-details p {
            margin: 5px 0;
            color: #555;
        }
        .quantity-form {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .quantity-form button {
            padding: 5px 10px;
            background: #007BFF;
            border: none;
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }
        .cart-total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .cart-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .cart-buttons form {
            margin: 0;
        }
        .cart-buttons button {
            padding: 10px 20px;
            background: #28a745;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .cart-buttons button:hover {
            background: #218838;
        }
        .empty {
            text-align: center;
            font-size: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Shopping Cart</h2>
        <?php
        if (!empty($_SESSION['cart'])) {
            $total = 0;
            foreach ($_SESSION['cart'] as $product_id => $product) {
                echo '<div class="cart-product">';
                echo '<img src="images/' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">';
                echo '<div class="cart-details">';
                echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                echo '<p>Price: ₹' . number_format($product['price'], 2) . '</p>';
                echo '<div class="quantity-form">';
                echo '<form method="post">';
                echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                echo '<input type="hidden" name="action" value="decrease">';
                echo '<button type="submit" name="update_quantity">-</button>';
                echo '</form>';
                echo '<span>' . $product['quantity'] . '</span>';
                echo '<form method="post">';
                echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                echo '<input type="hidden" name="action" value="increase">';
                echo '<button type="submit" name="update_quantity">+</button>';
                echo '</form>';
                echo '</div>'; // .quantity-form
                echo '</div>'; // .cart-details
                echo '</div>'; // .cart-product
                $total += $product['price'] * $product['quantity'];
            }
            echo '<div class="cart-total">';
            echo 'Total: ₹' . number_format($total, 2);
            echo '</div>';
        } else {
            echo '<div class="empty">Your cart is empty.</div>';
        }
        ?>
        <div class="cart-buttons">
            <form method="post" action="checkout.php">
                <button type="submit">Checkout</button>
            </form>
            <form method="get" action="product.php">
                <button type="submit">Back to Shopping</button>
            </form>
            <form method="get" action="clear_cart.php">
                <button type="submit">Clear Cart</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>