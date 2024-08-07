<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

include('server/connection.php');

session_start();

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
  }
}

if (isset($_POST['change_password'])) {
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $user_email = $_SESSION['user_email'];

  if ($password !== $confirmPassword) {
    header('location: account.php?error=Mật khẩu không khớp');


    //nếu mật khẩu có ít hơn 6 ký tự
  } else if (strlen($password) < 6) {
    header('location: account.php?error=Mật khẩu phải có ít nhất 6 ký tự');

    //không có lỗi
  } else {
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss', md5($password), $user_email);

    if ($stmt->execute()) {
      header('location: account.php?message=mật khẩu đã được đổi');
    } else {
      header('location: account.php?error=không thể đổi được mật khẩu');
    }
  }
}

//lấy đơn hàng
if (isset($_SESSION['logged_in'])) {
  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

  $stmt->bind_param('i', $user_id);

  $stmt->execute();

  $orders = $stmt->get_result(); //[]
}

?>

<!--Account-->
<section class="my-5 py-5">
  <div class="row container mx-auto">
    <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
      <p class="text-center" style="color: green"><?php if (isset($_GET['register_success'])) {
                                                    echo $_GET['register_success'];
                                                  } ?></p>
      <p class="text-center" style="color: green"><?php if (isset($_GET['login_success'])) {
                                                    echo $_GET['login_success'];
                                                  } ?></p>
      <h2 class="font-weight-bold">Thông tin tài khoản</h2>
      <hr class="mx-auto">
      <div class="account-info">
        <p>Tên: <span> <?php if (isset($_SESSION['user_name'])) {
                          echo $_SESSION['user_name'];
                        } ?></span></p>
        <p>Email: <span> <?php if (isset($_SESSION['user_email'])) {
                            echo $_SESSION['user_email'];
                          } ?></span></p>
        <p><a href="#orders" id="orders-btn">Đơn hàng</a></p>
        <p><a href="account.php?logout=1" id="logout-btn">Đăng xuất</a></p>
      </div>
    </div>

    <div class="col-lg-6 col-md-12 col-sm-12">
      <form id="account-form" method="POST" action="account.php">
        <p class="text-center" style="color: red"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                  } ?></p>
        <p class="text-center" style="color: green"><?php if (isset($_GET['message'])) {
                                                      echo $_GET['message'];
                                                    } ?></p>
        <h2>Đổi mật khẩu</h2>
        <hr class="mx-auto">
        <div class="form-group">
          <label>Mật khẩu</label>
          <input type="password" class="form-control" id="account-password" name="password" required>
        </div>
        <div class="form-group">
          <label>Nhập lại mật khẩu</label>
          <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" required>
        </div>
        <div class="form-group">
          <input type="submit" value="Đổi mật khẩu" name="change_password" class="btn" id="change-pass-btn">
        </div>
      </form>
    </div>
  </div>
</section>

<!--Orders-->
<section id="orders" class="orders container my-5 py-3">
  <div class="container mt-2">
    <h2 class="font-weight-bolde text-center">Đơn hàng của bạn</h2>
    <hr class="mx-auto">
  </div>

  <table class="mt-5 pt-5">
    <tr>
      <th>Mã đơn hàng</th>
      <th>Giá</th>
      <th>Trạng thái</th>
      <th>Ngày đặt</th>
      <th>Chi tiết đơn hàng</th>
    </tr>

    <?php while ($row = $orders->fetch_assoc()) { ?>
      <tr>
        <td>
          <!--<div class="product-info">
            <img src="assets/imgs/thuoc1.jpg">
            <div>
              <p class="mt-3"><?php echo $row['order_id']; ?></p>
            </div>
          </div>-->
          <span><?php echo $row['order_id']; ?></span>
        </td>

        <td>
          <span><?php echo $row['order_cost']; ?>đ</span>
        </td>

        <td>
          <span><?php echo $row['order_status']; ?></span>
        </td>

        <td>
          <span><?php echo $row['order_date']; ?></span>
        </td>

        <td>
          <form method="POST" action="order_details.php">
            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
            <input class="btn order-details-btn" name="order_details_btn" type="submit" value="Chi tiết">
          </form>
        </td>
      </tr>

    <?php } ?>
  </table>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->