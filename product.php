<?php
session_start();
require_once 'config.php';

// Restrict access if not logged in
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("Location: login.php");
    exit();
}

// Get the user's name from session
$name = $_SESSION['name'] ?? 'Guest';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Products | Eshop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- jQuery & Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Dancing+Script" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card-img-top {
      height: 200px;
      object-fit: contain;
      background: #f8f8f8;
    }
    .product-card {
      transition: transform 0.2s ease;
    }
    .product-card:hover {
      transform: scale(1.02);
    }
    .header-actions a {
      margin-left: 15px;
    }
  </style>
</head>
<body class="container">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center py-3 mb-4 border-bottom">
    <h1 class="text-danger" style="font-family: 'Abril Fatface', cursive;">Eshop</h1>
    <div class="header-actions d-flex align-items-center">
      <span class="mr-3">👤 <?php echo htmlspecialchars($name); ?></span>
      <!--<a href="cart.php" class="btn btn-outline-success">
        <i class="fa fa-shopping-cart"></i> Cart
      </a>--->
      <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
  </div>

  <!-- Controls -->
  <div class="card p-3 mb-4">
    <div class="row">
      <div class="col-md-4">
        <form method="post" action="product.php">
          <div class="form-row align-items-center">
            <div class="col-auto">
              <label class="sr-only" for="search">Search</label>
              <input type="text" name="search" id="search" class="form-control mb-2" placeholder="Search products">
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary mb-2">Search</button>
            </div>
          </div>
        </form>
      </div>

      <div class="col-md-4">
        <form method="post" action="product.php" class="form-inline">
          <label class="mr-2" for="sort">Sort by:</label>
          <select name="sort" id="sort" class="form-control mr-2">
            <option value="Name">Name</option>
            <option value="Price">Price</option>
          </select>
          <button type="submit" class="btn btn-primary">Sort</button>
        </form>
      </div>

      <div class="col-md-4">
        <form method="post" action="product.php" class="form-inline">
          <label class="mr-2" for="filter">Filter:</label>
          <select name="filter" id="filter" class="form-control mr-2">
            <option value="all">All Products</option>
            <option value="mobile">Mobile</option>
            <option value="laptop">Laptop</option>
            <option value="Gift items">Gift items</option>
            <option value="watches">Watches</option>
          </select>
          <button type="submit" class="btn btn-primary mr-2">Filter</button>
          <a href="product.php" class="btn btn-secondary">Clear</a>
        </form>
      </div>
    </div>
  </div>

  <!-- Products Grid -->
  <div class="row">
    <?php
    $sql = "SELECT * FROM products";

    if (isset($_POST['search'])) {
      $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);
      $sql = "SELECT * FROM products WHERE name LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
    }

    if (isset($_POST['filter'])) {
      $filterOption = mysqli_real_escape_string($conn, $_POST['filter']);
      if ($filterOption != 'all') {
        $sql = "SELECT * FROM products WHERE name LIKE '%$filterOption%'";
      }
    }

    if (isset($_POST['sort'])) {
      $sortOption = mysqli_real_escape_string($conn, $_POST['sort']);
      $sql .= " ORDER BY " . ($sortOption == 'Price' ? 'price' : 'name') . " ASC";
    }

    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card h-100 product-card">';
        echo '<img class="card-img-top" src="images/' . $row['image'] . '" alt="' . $row['name'] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['name'] . '</h5>';
        echo '<p class="card-text">' . $row['description'] . '</p>';
        echo '<h6 class="text-success">$' . $row['price'] . '</h6>';
        echo '</div>';
        echo '<div class="card-footer bg-white border-top-0">';
        echo '<form method="post" action="cart.php">';
        echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
        echo '<button type="submit" class="btn btn-success btn-block">Add to Cart</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<div class="col-md-12"><p class="text-center">No products found.</p></div>';
    }
    mysqli_close($conn);
    ?>
  </div>

  <!-- Footer -->
  <footer class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <hr>
          <h3>About Us</h3>
          <p>We are a leading e-commerce website offering a wide range of products at great prices.</p>
        </div>
        <div class="col-md-6">
          <hr>
          <h3>Contact Us</h3>
          <ul>
            <li><i class="fa fa-map-marker"></i> 123 Main Street, Anytown USA</li>
            <li><i class="fa fa-phone"></i> (123) 456-7890</li>
            <li><i class="fa fa-envelope"></i> <a href="mailto:info@example.com">info@example.com</a></li>
          </ul>
        </div>
      </div>
      <div class="text-center mt-3">
        <p class="mt-3">&copy; Created by Satabdi Rath. All rights reserved.</p>
      </div>
    </div>
  </footer>

</body>
</html>

