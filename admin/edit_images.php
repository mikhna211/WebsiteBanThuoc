<?php include('header.php'); ?>

<?php
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $product_name = $_GET['product_name'];
    } else {
        header('location: products.php');
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

            <h2>Sửa hình ảnh</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-image-form" enctype="multipart/form-data" method="POST" action="update_images.php">
                        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                } ?></p>

                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                        
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
                            <input type="file" class="form-control" id="image3" name="image3" placeholder="Hình ảnh 3" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>Hình ảnh 4</label>
                            <input type="file" class="form-control" id="image3" name="image4" placeholder="Hình ảnh 4" required>
                        </div>
                        
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="update_images" value="Cập nhật">
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