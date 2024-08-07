<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Dược mỹ phẩm' LIMIT 4");

$stmt->execute();

$cosmetics = $stmt->get_result();//[]

?>