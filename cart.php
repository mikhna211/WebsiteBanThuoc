<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

if (isset($_POST['add_to_cart'])) {

    //nếu người dùng đã sẵn sàng thêm sản phẩm vào giỏ hàng
    if (isset($_SESSION['cart'])) {

        $products_array_ids = array_column($_SESSION['cart'], "product_id");
        //nếu sản phẩm đã được thêm vào giỏ hàng hay chưa
        if (!in_array($_POST['product_id'], $products_array_ids)) {

            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$product_id] = $product_array;
            // [ 2=> [], 3=> [], 5=> [] ]

            //sản phẩm đã được thêm
        } else {
            echo '<script>alert("Sản phẩm đã được đưa vào giỏ hàng")</script>';
        }

        //nếu đây là sản phẩm đầu tiên
    } else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
        // [ 2=> [], 3=> [], 5=> [] ]
    }

    //calculate total
    calculateTotalCart();

    //xóa sản phẩm từ giỏ hàng    
} else if (isset($_POST['remove_product'])) {

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //calculate total
    calculateTotalCart();
} else if (isset($_POST['edit_quantity'])) {

    //we get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product quantity
    $product_array['product_quantity'] = $product_quantity;

    //return array back its place
    $_SESSION['cart'][$product_id] = $product_array;

    //calculate total
    calculateTotalCart();
} else {
    //header('location: index.php');
}

function calculateTotalCart()
{

    $total_price = 0;

    $total_quantity = 0;

    foreach ($_SESSION['cart'] as $key => $value) {

        $product =  $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}

?>

<!--Cart-->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="text-center font-weight-bolde">GIỎ HÀNG CỦA BẠN</h2>
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
        </tr>

        <?php if (isset($_SESSION['cart'])) { ?>

            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image']; ?>" />
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <small><?php echo $value['product_price']; ?>đ</small>
                                <br>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                    <input type="submit" name="remove_product" class="remove-btn" value="Xóa">
                                </form>
                            </div>
                        </div>
                    </td>

                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                            <input type="submit" class="edit-btn" value="Sửa" name="edit_quantity">
                        </form>
                    </td>

                    <td>
                        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?>đ</span>
                    </td>
                </tr>

            <?php } ?>

        <?php } ?>
    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Tổng cộng</td>
                <?php if (isset($_SESSION['cart'])) { ?>
                    <td><?php echo $_SESSION['total']; ?>đ</td>
                <?php } ?>
            </tr>
        </table>
    </div>

    <div class="checkout-container">
        <form method="POST" action="checkout.php">
            <input type="submit" class="btn checkout-btn" value="Thanh toán" name="checkout">
        </form>
    </div>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->