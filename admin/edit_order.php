<?php include('header.php'); ?>

<?php

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();

    $orders = $stmt->get_result(); //[]
} else if (isset($_POST['edit_order'])){

    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param('si', $order_status, $order_id);

    if ($stmt->execute()) {
        header('location: index.php?order_updated=Đơn hàng đã được sửa');
    } else {
        header('location: products.php?order_failed=Có lỗi, hãy thử lại!');
    }
} else {
    header('location: index.php');
    exit;
}

?>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include('sidemenu.php') ?>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <h2>Sửa đơn hàng</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-order-form" method="POST" action="edit_order.php">

                    <?php foreach($orders as $r) { ?>

                        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                } ?></p>
                        <div class="form-group my-3">
                            <label>Mã đơn hàng</label>
                            <p class="my-4"><?php echo $r['order_id']; ?></p>
                        </div>

                        <div class="form-group my-3">
                            <label>Giá</label>
                            <p class="my-4"><?php echo $r['order_cost']."đ"; ?></p>
                        </div>

                        <input type="hidden" name="order_id" value="<?php echo $r['order_id']; ?>">

                        <div class="form-group my-3">
                            <label>Trạng thái đơn hàng</label>
                            <select class="form-select" required name="order_status">
                                <option value="Chưa thanh toán" <?php if($r['order_status'] == 'Chưa thanh toán') { echo "selected";} ?>>Chưa thanh toán</option>
                                <option value="Đã thanh toán" <?php if($r['order_status'] == 'Đã thanh toán') { echo "selected";} ?>>Đã thanh toán</option>
                                <option value="Đã giao" <?php if($r['order_status'] == 'Đã giao') { echo "selected";} ?>>Đã giao</option>
                                <option value="Đang giao hàng" <?php if($r['order_status'] == 'Đang giao hàng') { echo "selected";} ?>>Đang giao hàng</option>
                            </select>
                        </div>

                        <div class="form-group my-3">
                            <label>Ngày</label>
                            <p class="my-4"><?php echo $r['order_date']; ?></p>
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="edit_order" value="Sửa">
                        </div>

                        <?php } ?>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>




<script src="admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>