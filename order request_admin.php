<?php

require 'config.php';

if (empty($_SESSION["id"])) {
    header("Location: admin_login.php");
}

$id = $_SESSION["id"];

// fetch orders and order details
$result = mysqli_query($conn, "SELECT o.id, o.user_id, o.total, o.created_at, od.product_id, od.quantity, od.price
                               FROM orders o
                               INNER JOIN order_details od ON o.id = od.order_id
                               ORDER BY o.created_at DESC");
$order_details = array();
while ($row = mysqli_fetch_assoc($result)) {
    $order_id = $row["id"];
    if (!isset($order_details[$order_id])) {
        $order_details[$order_id] = array(
            "user_id" => $row["user_id"],
            "total" => $row["total"],
            "created_at" => $row["created_at"],
            "products" => array()
        );
    }
    $order_details[$order_id]["products"][] = array(
        "product_id" => $row["product_id"],
        "quantity" => $row["quantity"],
        "price" => $row["price"]
    );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Requests</title>
    
</head>
<body>
    <center>
    <h1>Order Requests</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Total</th>
                <th>Created At</th>
                <th>Products</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_details as $order_id => $order_detail) { ?>
                <tr>
                    <td><?php echo $order_id; ?></td>
                    <td><?php echo $order_detail["user_id"]; ?></td>
                    <td><?php echo $order_detail["total"]; ?></td>
                    <td><?php echo $order_detail["created_at"]; ?></td>
                    <td>
                        <ul>
                            <?php foreach ($order_detail["products"] as $product) { ?>
                                <li><?php echo $product["product_id"]; ?> (<?php echo $product["quantity"]; ?> x <?php echo $product["price"]; ?>)</li>
                            <?php } ?>
                        </ul>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table><br>
    <a href="logout.php" class="button">Logout</a>
    </center>
</body>
</html>
