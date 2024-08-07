<?php include('header.php'); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}
?>

<?php

//1. determine page number
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    //if user has already entered page then page number is the one that they selected
    $page_no = $_GET['page_no'];
} else {
    //if user just entered the page then default page is 1
    $page_no = 1;
}

//2. return number of products
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

//3. products
$total_records_per_page = 5;

$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$adjacents = "2";

$total_no_of_page = ceil($total_records / $total_records_per_page);

//4. get all products
$stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$orders = $stmt2->get_result();

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

            <!-- Dashboard Content -->
            <h1 class="h2">Đơn hàng</h1>

            <?php if(isset($_GET['order_updated'])) { ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['order_updated']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['order_failed'])) { ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['order_failed']; ?></p>
            <?php } ?>

            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Mã khách hàng</th>
                        <th scope="col">Ngày</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $orders){ ?>
                    <tr class="text-center">
                        <th><?php echo $orders['order_id']; ?></th>
                        <td><?php echo $orders['order_status']; ?></td>
                        <td><?php echo $orders['user_id']; ?></td>
                        <td><?php echo $orders['order_date']; ?></td>
                        <td><?php echo $orders['user_phone']; ?></td>
                        <td><?php echo $orders['user_address']; ?></td>

                        <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $orders['order_id']; ?>">Sửa</a></td>
                        <td><a class="btn btn-danger">Xóa</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation example" style="padding-top: 20px;">
                <ul class="pagination">
                    <li class="page-item <?php if ($page_no <= 1) {
                                                echo 'disabled';
                                            } ?>">
                        <a class="page-link" href="<?php if ($page_no <= 1) {
                                                        echo '#';
                                                    } else {
                                                        echo "?page_no" . ($page_no - 1);
                                                    } ?>">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

                    <?php if ($page_no >= 3) { ?>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a></li>
                    <?php } ?>

                    <li class="page-item <?php if ($page_no >= $total_no_of_page) {
                                                echo 'disabled';
                                            } ?>">
                        <a class="page-link" href="<?php if ($page_no >= $total_no_of_page) {
                                                        echo '#';
                                                    } else {
                                                        echo "?page_no=" . ($page_no + 1);
                                                    } ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </main>
    </div>
</div>
<script src="admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>