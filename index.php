<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<style>
    #shop .product {
        margin-bottom: 20px;
        margin: 10px;
        padding: 10px;
        border: 1px solid #1d1d1d;
        border-radius: 10px;
        background-color: #fff;
        width: 300px;
        height: auto;
    }

    #shop-medicine .product {
        margin-bottom: 20px;
        margin: 10px;
        padding: 10px;
        border: 1px solid #1d1d1d;
        border-radius: 10px;
        background-color: #fff;
        width: 300px;
        height: auto;
    }

    #shop-cosmetics .product {
        margin-bottom: 20px;
        margin: 10px;
        padding: 10px;
        border: 1px solid #1d1d1d;
        border-radius: 10px;
        background-color: #fff;
        width: 300px;
        height: auto;
    }

    #shop {
        margin-left: 100px;
    }

    #shop-medicine {
        margin-left: 100px;
    }

    #shop-cosmetics {
        margin-left: 100px;
    }

    #news .card {
        margin-bottom: 20px;
        background-color: #fff;
    }

    #news {
        margin-left: 20px;
        padding: 0 80px;
    }
</style>

<!--Home-->
<section id="home">
    <div class="container">
        <h5>SẢN PHẨM MỚI NHẤT!!!</h5>
        <h1>Giá tốt nhất cho mùa hè này!!!</h1>
        <p>Sức khỏe của bạn, sứ mệnh của chúng tôi.</p>
        <button>Mua ngay</button>
    </div>
</section>

<!--Featured-->
<section id="featured" class="section-p1">
    <div class="fe-box">
        <img src="assets/imgs/f1.png" alt="">
        <h6 style="color: black;">Free Shipping</h6>
    </div>
    <div class="fe-box">
        <img src="assets/imgs/f2.png" alt="">
        <h6 style="color: black;">Online Order</h6>
    </div>
    <div class="fe-box">
        <img src="assets/imgs/f3.png" alt="">
        <h6 style="color: black;">Save Money</h6>
    </div>
    <div class="fe-box">
        <img src="assets/imgs/f4.png" alt="">
        <h6 style="color: black;">Promotions</h6>
    </div>
    <div class="fe-box">
        <img src="assets/imgs/f5.png" alt="">
        <h6 style="color: black;">Happy Sell</h6>
    </div>
    <div class="fe-box">
        <img src="assets/imgs/f6.png" alt="">
        <h6 style="color: black;">24/7 Support</h6>
    </div>
</section>

<!--Newshop-->
<section id="shop" class="my-5">
    <div class="container mt-5 py-3" style="margin-left: 30px;">
        <h3><i class="fa-solid fa-heart" style="margin-right: 5px; margin-bottom: 40px;"></i>SẢN PHẨM BÁN CHẠY</h3>
    </div>
    <div class="row mx-auto container-fluid" style="margin-top: -50px;">

        <?php include('server/get_featured_products.php'); ?>

        <?php while ($row = $featured_products->fetch_assoc()) { ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="/assets/imgs/<?php echo $row['product_image']; ?>">
                <h4 class="p-name"><?php echo $row['product_name']; ?></h4>
                <h5 class="p-price" style="color: blue;"><?php echo $row['product_price']; ?>đ / <?php echo $row['product_specifications']; ?></h5>
                <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Mua ngay</button></a>
            </div>

        <?php } ?>
    </div>
</section>

<!--Thuốc-->
<section id="shop-medicine" class="my-5">
    <div class="container mt-5 py-5" style="margin-left: 30px;">
        <h3><i class="fa-solid fa-capsules" style="margin-right: 5px;"></i>Thuốc</h3>
    </div>
    <div class="row mx-auto container-fluid" style="margin-top: -50px;">

        <?php include('server/get_medicine.php'); ?>

        <?php while ($row = $medicine_products->fetch_assoc()) { ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="/assets/imgs/<?php echo $row['product_image']; ?>">
                <h4 class="p-name"><?php echo $row['product_name']; ?></h4>
                <h5 class="p-price" style="color: blue;"><?php echo $row['product_price']; ?>đ / <?php echo $row['product_specifications']; ?></h5>
                <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Mua ngay</button></a>
            </div>

        <?php } ?>
    </div>
</section>

<!--Banner-->
<section id="banner" class="section-m1"></section>

<!--Mỹ phẩm-->
<section id="shop-cosmetics" class="my-5">
    <div class="container mt-5 py-5" style="margin-left: 30px;">
        <h3><i class="fa-solid fa-mortar-pestle" style="margin-right: 5px;"></i>Dược mỹ phẩm</h3>
    </div>
    <div class="row mx-auto container-fluid" style="margin-top: -50px;">

        <?php include('server/get_cosmetics.php'); ?>
        <?php while ($row = $cosmetics->fetch_assoc()) { ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="/assets/imgs/<?php echo $row['product_image']; ?>">
                <h4 class="p-name"><?php echo $row['product_name']; ?></h4>
                <h5 class="p-price" style="color: blue;"><?php echo $row['product_price']; ?>đ / <?php echo $row['product_specifications']; ?></h5>
                <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Mua ngay</button></a>
            </div>

        <?php } ?>
    </div>
</section>

<!--News-->
<section id="news" class="my-5">
    <div class="container mt-5 py-5" style="margin-left: 30px;">
        <h3><i class="fa-solid fa-eye" style="margin-right: 5px;"></i>Góc tin tức</h3>
    </div>

    <div class="row mx-auto container-fluid" style="margin-top: -45px;">
        <div class="news-card col-lg-3 col-md-4 col-sm-12">
            <div class="card" style="width: 18rem;">
                <img src="assets/imgs/news1.jpg" alt="" class="card-img-top">
                <div class="card-body">
                    <h5 style="font-size: 1.2rem;" class="card-title">Tâm lý - Tâm Thần</h5>
                    <p class="card-text">Sự cô đơn kéo dài có liên quan đến nguy cơ đột quỵ cao hơn?</p>
                    <a href="#" class="btn btn-primary">Xem thêm</a>
                </div>
            </div>
        </div>
        <div class="news-card col-lg-3 col-md-4 col-sm-12">
            <div class="card" style="width: 18rem;">
                <img src="assets/imgs/news2.jpg" alt="" class="card-img-top">
                <div class="card-body">
                    <h5 style="font-size: 1.2rem;" class="card-title">Chăm sóc cơ thể</h5>
                    <p class="card-text">Tác dụng bất ngờ của phương pháp đi bộ leo dốc</p>
                    <a href="#" class="btn btn-primary">Xem thêm</a>
                </div>
            </div>
        </div>
        <div class="news-card col-lg-3 col-md-4 col-sm-12">
            <div class="card" style="width: 18rem;">
                <img src="assets/imgs/news3.jpg" alt="" class="card-img-top">
                <div class="card-body">
                    <h5 style="font-size: 1.2rem;" class="card-title">Dinh dưỡng</h5>
                    <p class="card-text">Ăn cà rốt hỗ trợ giảm cân như thế nào?</p>
                    <a href="#" class="btn btn-primary">Xem thêm</a>
                </div>
            </div>
        </div>
        <div class="news-card col-lg-3 col-md-4 col-sm-12">
            <div class="card" style="width: 18rem;">
                <img src="assets/imgs/news4.jpg" alt="" class="card-img-top">
                <div class="card-body">
                    <h5 style="font-size: 1.2rem;" class="card-title">Ăn ngon khỏe</h5>
                    <p class="card-text">6 loại trái cây giúp bạn có giấc ngủ ngon</p>
                    <a href="#" class="btn btn-primary">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->