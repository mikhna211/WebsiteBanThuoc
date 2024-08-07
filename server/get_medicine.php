<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Thuốc' LIMIT 4");

$stmt->execute();

$medicine_products = $stmt->get_result();//[]

?>