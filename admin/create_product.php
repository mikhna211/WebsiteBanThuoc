<?php
    include('../server/connection.php');

    if(isset($_POST['add_product'])){
        $product_name = isset($_POST['name']) ? $_POST['name'] : '';
        $product_description = isset($_POST['description']) ? $_POST['description'] : '';
        $product_price = isset($_POST['price']) ? $_POST['price'] : '';
        $product_category = isset($_POST['category']) ? $_POST['category'] : '';
        $manufacturing_country = isset($_POST['country']) ? $_POST['country'] : '';
        $product_company = isset($_POST['company']) ? $_POST['company'] : '';
        $product_specifications = isset($_POST['specifications']) ? $_POST['specifications'] : '';

        // Đây là các tệp hình ảnh
        $image1 = $_FILES['image1']['tmp_name'];
        $image2 = $_FILES['image2']['tmp_name'];
        $image3 = $_FILES['image3']['tmp_name'];
        $image4 = $_FILES['image4']['tmp_name'];

        // Tên hình ảnh
        $image_name1 = $product_name."1.jpeg";
        $image_name2 = $product_name."2.jpeg";
        $image_name3 = $product_name."3.jpeg";
        $image_name4 = $product_name."4.jpeg";

        // Tải lên hình ảnh
        move_uploaded_file($image1, "../assets/imgs/".$image_name1);
        move_uploaded_file($image2, "../assets/imgs/".$image_name2);
        move_uploaded_file($image3, "../assets/imgs/".$image_name3);
        move_uploaded_file($image4, "../assets/imgs/".$image_name4);

        // Tạo một sản phẩm mới
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_category, product_description, 
                                                     product_price, product_specifications, manufacturing_country, 
                                                     product_company, product_image, product_image2, product_image3, 
                                                     product_image4) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssssss', $product_name, $product_category, $product_description, $product_price, 
                                        $product_specifications, $manufacturing_country, $product_company, 
                                        $image_name1, $image_name2, $image_name3, $image_name4);

        if($stmt->execute()){
            header('Location: products.php?product_created=Sản phẩm đã được tạo thành công!');
        } else {
            header('Location: products.php?product_failed=Có lỗi, hãy thử lại!');
        }
    }
?>
