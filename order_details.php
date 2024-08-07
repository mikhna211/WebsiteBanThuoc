<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

/*
    chưa thanh toán
    đang giao
    đã giao
*/

include('server/connection.php');

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");

    $stmt->bind_param('i', $order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);
} else {
    header('location: account.php');
    exit;
}

function calculateTotalOrderPrice($order_details) {

    $total = 0;

    foreach($order_details as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);
    }
    return $total;
}

?>

<!--Order details-->
<section id="orders" class="orders container my-5 py-5">
    <div class="container mt-5 py-3">
        <h2 class="font-weight-bolde text-center">Chi tiết đơn hàng</h2>
        <hr class="mx-auto">
    </div>

    <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
        </tr>

        <?php foreach($order_details as $row) { ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>">
                        <div>
                            <p class="mt-3"><?php echo $row['product_name']; ?></p>
                        </div>
                    </div>
                </td>

                <td>
                    <span><?php echo $row['product_price']; ?>đ</span>
                </td>

                <td>
                    <span><?php echo $row['product_quantity']; ?></span>
                </td>
            </tr>

        <?php } ?>
    </table>

    <?php if ($order_status == "Chưa thanh toán") { ?>
        <form style="float: right;" method="POST" action="payment.php">
            <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>">
            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
            <input type="submit" name="order_pay_btn" class="btn btn-dark" value="Thanh toán ngay">
        </form>
    <?php } ?>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->