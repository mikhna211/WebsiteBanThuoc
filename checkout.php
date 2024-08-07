<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

if (!empty($_SESSION['cart'])) {

    //let user in


    //send user to home page
} else {
    header('location: index.php');
}


?>

<!--Checkout-->
<section class="mt-5 py-3 py-md-5">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-5">
            <div class="card border border-light-subtle rounded-3 shadow-sm">
                <div class="card-body p-3 p-md-4 p-xl-5">
                    <div class="text-center mb-5">
                        <h2>Thanh toán</h2>
                    </div>
                    <form method="POST" action="server/place_order.php">
                        <p class="text-center" style="color: red; padding-bottom: 20px; display: flex; align-items: center; justify-content: center;">
                            <?php if (isset($_GET['message'])) {
                                echo $_GET['message'];
                            } ?>
                            <?php if (isset($_GET['message'])) { ?>
                                <a style="margin-left: 5px;" href="login.php" class="btn btn-primary">Đăng nhập</a>
                            <?php } ?>
                        </p>
                        <div class="row gy-1 overflow-hidden">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Tên người dùng" required>
                                    <label>Tên người dùng</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                                    <label>Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Số điện thoại" required>
                                    <label>Số điện thoại</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Thành phố" required>
                                    <label>Thành phố</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Địa chỉ" required>
                                    <label>Địa chỉ</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <p>Tổng tiền: <?php echo $_SESSION['total']; ?>đ</p>
                                    <input type="submit" class="btn btn-dark" id="checkout-btn" name="place_order" value="Đặt hàng">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->