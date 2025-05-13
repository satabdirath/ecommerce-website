<?php
$conn = mysqli_connect("localhost", "root", "", "ecom");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
