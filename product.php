<!DOCTYPE html>
<html>
<head>
	<title>Products | Eshop</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Dancing+Script" rel="stylesheet">
    <style>
      /* For screens smaller than 576px (mobile devices) */
@media (max-width: 576px) {

/* Center align the header */
.text-center {
  text-align: center !important;
}

/* Reduce the font size of the header */
.mb-5 {
  font-size: 2rem !important;
}

/* Reduce the width of the search bar */
#search {
  width: 80%;
}

/* Reduce the font size of the form labels */
label {
  font-size: 0.8rem;
}

/* Adjust the margin and padding of the form elements */
form {
  margin: 10px;
  padding: 10px;
}

/* Make the buttons full width */
button {
  width: 100%;
  margin-top: 10px;
}
}

             
    
             
    .product {
  margin: 20px;
    }

    
    form {
        display: inline-block;
        margin-right: 10px;
    }
    label {
        font-weight: bold;
        margin-right: 5px;
    }
    input[type="text"], select {
        padding: 5px;
        font-size: 16px;
    }
    button[type="submit"], button {
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 5px;
    }
    button[type="submit"]:hover, button:hover {
        background-color: #2E8B57;
    }
    button a {
  color: white;
}
footer {
  
  padding: 50px 0;
  margin-top: 50px;
}

footer h3 {
  font-size: 24px;
  font-weight: bold;
  margin-top: 0;
}

footer p {
  font-size: 16px;
  line-height: 1.5;
}

footer ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

footer ul li {
  margin-bottom: 10px;
}

footer hr {
  border-top: 1px solid #dee2e6;
  margin-top: 40px;
  margin-bottom: 40px;
}

.container {
  padding-left: 0;
  padding-right: 0;
}

@media (max-width: 767px) {
  footer {
    position: static;
  }
}
@media only screen and (max-width: 767px) {
  footer {
    margin-left: 10px;
    margin-right: 10px;
  }
}

</style>


</head>
<body class="container">
	<h1 class="text-center text-danger mb-5" style="font-family: 'Abril Fatface', cursive;">Eshop</h1>
    <div>
    <form method="post" action="product.php">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search">
    <button type="submit">Search</button>
</form>

<form method="post" action="product.php">
    <label for="sort">Sort by:</label>
    <select name="sort" id="sort">
        <option value="Name">Name</option>
        <option value="Price">Price</option>
    </select>
    <button type="submit">Sort</button>
</form>

<form method="post" action="product.php">
    <label for="filter">Filter by:</label>
    <select name="filter" id="filter">
        <option value="all">All Products</option>
        <option value="mobile">Mobile</option>
        <option value="laptop">Laptop</option>
        <option value="Gift items">Gift items</option>
        <option value="watches">watches</option>
    </select>
    <button type="submit">Filter</button>
    <button><a href="product.php">Clear Filter</a></button>

</form>


<div class="row">
<?php
require_once 'config.php';


    // Check if the search form was submitted
    if (isset($_POST['search'])) {
        $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM products WHERE name LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM products";
    }

// Check if the sort form was submitted
if (isset($_POST['sort'])) {
    $sortOption = mysqli_real_escape_string($conn, $_POST['sort']);
    if ($sortOption == 'Price') {
        $sql .= " ORDER BY price ASC";
    } else {
        $sql .= " ORDER BY name ASC";
    }
}

// Check if the filter form was submitted
if (isset($_POST['filter'])) {
    $filterOption = mysqli_real_escape_string($conn, $_POST['filter']);
    if ($filterOption != 'all') {
        $sql = "SELECT * FROM products WHERE name LIKE '%$filterOption%'";
    }
}




// Execute the modified SQL query and display the products
$result = mysqli_query($conn, $sql);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Display the product information
            echo '<div class="product">';
            echo '<img src="images/' . $row['image'] . '" alt="' . $row['name'] . '">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<h4>$' . $row['price'] . '</h4>';

            // Display the add to cart button with the product ID
            echo '<form method="post" action="cart.php">';
            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
            echo '<button type="submit">Add to Cart</button>';
            echo '</form>';

            echo '</div>';
        }
    } else {
        echo 'No products found.';
    }
} else {
    echo 'Error: ' . mysqli_error($conn);
}
mysqli_close($conn);
?>
</div>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <hr>
        <h3>About Us</h3>
        <p>We are a leading e-commerce website that offers a wide range of products to our customers. Our mission is to provide high-quality products at affordable prices and make shopping convenient and enjoyable for our customers.</p>
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
    <div class="row">
      <div class="col-md-12">
        <button onclick="location.href='index.php'" type="button" class="btn btn-primary" style="background-color: #2E8B57;">Go Back</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <hr>
        <p>&copy; created by satabdi  rath. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
</body>
</html> 

