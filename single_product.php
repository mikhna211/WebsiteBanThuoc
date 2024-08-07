<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

include('server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    $stmt->execute();

    $product = $stmt->get_result(); //[]
    //no product id was given
} else {
    header('location: index.php');
}

?>


<style>
    #related-products .product {
        margin-bottom: 20px;
        margin: 10px;
        padding: 10px;
        border: 1px solid #1d1d1d;
        border-radius: 10px;
        background-color: #fff;
        width: 280px;
        height: auto;
    }

    #related-products {
        margin-left: 70px;
    }
</style>

<!--Single Product-->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

        <?php while ($row = $product->fetch_assoc()) { ?>

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img style="width: 500px;" class="img-fluid pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg">
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100px" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100px" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100px" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100px" class="small-img">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <h2><?php echo $row['product_name']; ?></h2>
                <h4 class="py-3">Giá: <?php echo $row['product_price']; ?>đ / <?php echo $row['product_specifications']; ?></h4>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                    <input type="number" name="product_quantity" value="1">
                    <button class="buy-btn" type="submit" name="add_to_cart">Thêm vào giỏ hàng</button>
                </form>
                <h4 class="py-3">Danh mục: <?php echo $row['product_category']; ?></h4>
                <h4 class="py-3">Nước sản xuất: <?php echo $row['manufacturing_country']; ?></h4>
                <h4 class="py-3">Công ty sản xuất: <?php echo $row['product_company']; ?></h4>
                <h4 class="py-3" style="text-align: justify;">Mô tả sản phẩm: <?php echo $row['product_description']; ?></h4>
            </div>
            </form>

        <?php } ?>
    </div>
</section>

<!--Related Product-->
<section id="related-products" class="my-3 py-3">
    <div class="container text-center mt-3 py-3" style="padding-right: 85px;">
        <h2>Gợi ý sản phẩm</h2>
        <hr class="mx-auto">
    </div>
    <div class="row mx-auto container">
        <?php include('server/get_relative.php'); ?>

        <?php while ($row = $relatived_products->fetch_assoc()) { ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="/assets/imgs/<?php echo $row['product_image']; ?>">
                <h4 class="p-name"><?php echo $row['product_name']; ?></h4>
                <h5 class="p-price" style="color: blue;"><?php echo $row['product_price']; ?>đ / <?php echo $row['product_specifications']; ?></h5>
                <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Mua ngay</button></a>
            </div>

        <?php } ?>
    </div>
</section>

<script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for (let i = 0; i < 4; i++) {
        smallImg[i].onclick = function() {
            mainImg.src = smallImg[i].src;
        }
    }
</script>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->