<?php
include('connection.php');

try {
    // Lấy product_id từ GET
    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

    if ($product_id) {
        // Truy vấn loại sản phẩm hiện tại
        $stmt = $conn->prepare("SELECT product_category FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $current_product = $result->fetch_assoc();
            $current_category = $current_product['product_category'];
        } else {
            throw new Exception("Không tìm thấy sản phẩm với ID: $product_id");
        }

        $stmt->close();

        // Truy vấn các sản phẩm gợi ý cùng loại
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? LIMIT 4");
        $stmt->bind_param("s", $current_category);
        $stmt->execute();
        $relatived_products = $stmt->get_result();
        $stmt->close();
    } else {
        throw new Exception("Không có product_id được cung cấp");
    }
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}

// Đóng kết nối với cơ sở dữ liệu
$conn->close();
