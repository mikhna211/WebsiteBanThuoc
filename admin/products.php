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
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
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
$stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$products = $stmt2->get_result();

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
            <h1 class="h2">Tất cả sản phẩm</h1>
            <?php if(isset($_GET['edit_success_message'])) { ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['edit_failure_message'])) { ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_massage']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['deleted_successfully'])) { ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['deleted_failure'])) { ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['product_created'])) { ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['product_created']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['product_failed'])) { ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['product_failed']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['images_updated'])) { ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['images_updated']; ?></p>
            <?php } ?>

            <?php if(isset($_GET['images_failed'])) { ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['images_failed']; ?></p>
            <?php } ?>

            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Mã sản phẩm</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Loại</th>
                        <th scope="col">Nước sản xuất</th>
                        <th scope="col">Hãng</th>
                        <th scope="col">Sửa hình ảnh</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product){ ?>
                    <tr class="text-center">
                        <th><?php echo $product['product_id']; ?></th>
                        <td><img src="<?php echo "../assets/imgs/". $product['product_image']; ?>" style="width: 70px; height: 70px;"></td>
                        <td><?php echo $product['product_name']; ?></td>
                        <td><?php echo $product['product_price']."đ"; ?></td>
                        <td><?php echo $product['product_category']; ?></td>
                        <td><?php echo $product['manufacturing_country']; ?></td>
                        <td><?php echo $product['product_company']; ?></td>

                        <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name']; ?>">Sửa hình ảnh</a></td>
                        <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Sửa</a></td>
                        <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Xóa</a></td>
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