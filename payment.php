<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

if (isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
}

?>

<!--Payment-->
<section class="my-5 py-5">
    <div class="container text-center mt-5 pt-5">
        <h2 class="form-weight-bold">Thanh toán</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center" style="margin-bottom: 85px;">

        <?php if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
            <p>Tổng tiền thanh toán: <?php echo $_SESSION['total']; ?>đ</p>
            <input class="btn btn-primary" type="submit" value="Thanh toán ngay">

        <?php } else if (isset($_POST['order_status']) && $_POST['order_status'] == "Chưa thanh toán") { ?>
            <p>Tổng tiền thanh toán: <?php echo $_POST['order_total_price']; ?>đ</p>
            <input class="btn btn-primary" type="submit" value="Thanh toán ngay">
        <?php } else { ?>
            <p>Bạn không có đơn đặt hàng</p>
        <?php } ?>
    </div>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->