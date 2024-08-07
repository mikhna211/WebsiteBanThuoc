<?php include('header.php'); ?>

<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();

    $products = $stmt->get_result(); //[]

}else if (isset($_POST['edit_btn'])) {

    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $country = $_POST['country'];
    $company = $_POST['company'];
    $category = $_POST['category'];
    $description = $_POST['description'];


    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?,
                            manufacturing_country=?, product_company=?, product_category=?, product_description=? WHERE product_id=?");
    $stmt->bind_param('ssssssi', $name, $price, $country, $company, $category, $description, $product_id);

    if ($stmt->execute()) {
        header('location: products.php?edit_success_message=Sản phẩm đã được sửa');
    } else {
        header('location: products.php?edit_failure_message=Có lỗi, hãy thử lại!');
    }

} else {
    header('products.php');
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

            <h2>Sửa sản phẩm</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-product-form" method="POST" action="edit_product.php">
                        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                } ?></p>
                        <div class="form-group mt-3">
                        <?php foreach($products as $product) { ?>

                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" id="product_name" value="<?php echo $product['product_name'] ?>" name="name" placeholder="Tên" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Giá</label>
                            <input type="number" class="form-control" id="product_price" value="<?php echo $product['product_price'] ?>" name="price" placeholder="Giá" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Nước sản xuất</label>
                            <input type="text" class="form-control" id="manufacturing_country" value="<?php echo $product['manufacturing_country'] ?>" name="country" placeholder="Nước sản xuất" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Hãng</label>
                            <input type="text" class="form-control" id="product_company" value="<?php echo $product['product_company'] ?>" name="company" placeholder="Hãng" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Loại</label>
                            <select class="form-select" require name="category">
                                <option value="Thuốc">Thuốc</option>
                                <option value="Dược mỹ phẩm">Dược Mỹ Phẩm</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label>Mô tả</label>
                            <textarea rows="3" class="form-control" id="product_description" name="description"><?php echo $product['product_description'] ?></textarea>
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="edit_btn" value="Sửa">
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