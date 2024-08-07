<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

include('server/connection.php');

//use the search section
if (isset($_POST['search'])) {

    //1. determine page number
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        //if user has already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    } else {
        //if user just entered the page then default page is 1
        $page_no = 1;
    }

    $category = $_POST['category'];
    $price = $_POST['price'];

    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products WHERE product_category=? AND product_price<=?");
    $stmt1->bind_param('si', $category, $price);
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3. products
    $total_records_per_page = 8;
    
    $offset = ($page_no-1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_page = ceil($total_records/$total_records_per_page);

    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price <=? LIMIT $offset, $total_records_per_page");
    $stmt2->bind_param("si", $category, $price);
    $stmt2->execute();
    $products = $stmt2->get_result();//[]

    //return all products
} else {

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
    $total_records_per_page = 8;
    
    $offset = ($page_no-1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_page = ceil($total_records/$total_records_per_page);

    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $products = $stmt2->get_result();
}

?>

<style>
    .product img {
        width: 100%;
        height: auto;
        box-sizing: border-box;
        object-fit: cover;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-left: 130px;
        margin-bottom: 70px;
        margin-top: -50px;
    }

    .pagination a {
        color: blue;
    }

    .pagination li:hover {
        color: #fff;
        background-color: blue;
    }

    #shop {
        margin-left: 210px;
    }

    #shop .product {
        margin-bottom: 20px;
        margin: 10px;
        padding: 10px;
        border: 1px solid #1d1d1d;
        border-radius: 10px;
        background-color: #fff;
        width: 280px;
    }
</style>

<!--Search-->
<section id="search" class="my-5 py-5 ms-2">
    <div class="container mt-5 py-5">
        <p style="margin-top: 50px;">Tìm sản phẩm</p>
        <hr style="margin-bottom: -10px;">
    </div>

    <form action="shop.php" method="POST">
        <div class="row mx-auto">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p>Loại sản phẩm</p>

                <div class="form-check">
                    <input class="form-check-input" value="Thuốc" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='Thuốc') echo 'checked'; ?>>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Thuốc
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" value="Dược mỹ phẩm" type="radio" name="category" id="category_two" <?php if(isset($category) && $category=='Dược mỹ phẩm') echo 'checked'; ?>>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Dược mỹ phẩm
                    </label>
                </div>
            </div>
        </div>

        <div class="row mx-auto mt-3">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p>Giá</p>
                <input type="range" class="form-range w-100" name="price" value="<?php if(isset($price)) { echo $price; } else { echo "100";} ?>" min="1" max="500000" id="customRange2">
                <div class="w-100">
                    <span style="float: left;">1</span>
                    <span style="float: right;">500000</span>
                </div>
            </div>
        </div>

        <div class="form-group my-3 mx-3">
            <input type="submit" name="search" value="Tìm" class="btn btn-primary">
        </div>
    </form>
</section>

<!--Shop-->
<section id="shop" class="my-5 py-5">
    <div class="container mt-5 py-5" style="margin-left: 20px;">
        <h3><i class="fa-solid fa-capsules" style="margin-right: 5px;"></i>Danh sách sản phẩm</h3>
    </div>
    <div class="row mx-auto container-fluid" style="margin-top: -50px;">

        <?php while ($row = $products->fetch_assoc()) { ?>

            <div onclick="window.location.href='single_product.php';" class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="/assets/imgs/<?php echo $row['product_image']; ?>">
                <h4 class="p-name"><?php echo $row['product_name']; ?></h4>
                <h5 class="p-price" style="color: blue;"><?php echo $row['product_price']; ?>đ / <?php echo $row['product_specifications']; ?></h5>
                <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Mua ngay</button></a>
            </div>

        <?php } ?>
    </div>
</section>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item <?php if($page_no<=1){echo 'disabled';} ?>">
            <a class="page-link" href="<?php if($page_no<=1) { echo '#'; } else { echo "?page_no".($page_no-1); } ?>">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

        <?php if($page_no >=3) { ?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
        <?php } ?>

        <li class="page-item <?php if($page_no >= $total_no_of_page){echo 'disabled';} ?>">
            <a class="page-link" href="<?php if($page_no >= $total_no_of_page) { echo '#'; } else { echo "?page_no=".($page_no+1); } ?>">Next</a>
        </li>
    </ul>
</nav>
</div>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->