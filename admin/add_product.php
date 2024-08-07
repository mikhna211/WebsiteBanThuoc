<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include('sidemenu.php') ?>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <h2>Thêm sản phẩm</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
                        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                } ?></p>
                        <div class="form-group mt-3">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Tên sản phẩm" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Quy cách</label>
                            <input type="text" class="form-control" id="product-specifications" name="specifications" placeholder="Quy cách" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Giá</label>
                            <input type="number" class="form-control" id="product-price" name="price" placeholder="Giá" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Nước sản xuất</label>
                            <input type="text" class="form-control" id="manufacturing-country" name="country" placeholder="Nước sản xuất" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Hãng</label>
                            <input type="text" class="form-control" id="product-company" name="company" placeholder="Hãng" required>
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
                            <textarea rows="3" class="form-control" id="product-description" name="description"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label>Hình ảnh 1</label>
                            <input type="file" class="form-control" id="image1" name="image1" placeholder="Hình ảnh 1" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Hình ảnh 2</label>
                            <input type="file" class="form-control" id="image2" name="image2" placeholder="Hình ảnh 2" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Hình ảnh 3</label>
                            <input type="file" class="form-control" id="image3" name="image3" placeholder="Hình ảnh 2" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>Hình ảnh 4</label>
                            <input type="file" class="form-control" id="image4" name="image4" placeholder="Hình ảnh 3" required>
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="add_product" value="Thêm">
                        </div>
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