<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

include('server/connection.php');

if (isset($_POST['register'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  //nếu mật khẩu không phù hợp
  if ($password !== $confirmPassword) {
    header('location: register.php?error=Mật khẩu không khớp');


    //nếu mật khẩu có ít hơn 6 ký tự
  } else if (strlen($password) < 6) {
    header('location: register.php?error=Mật khẩu phải có ít nhất 6 ký tự');

    //nếu không có lỗi
  } else {
    //kiểm tra xem có người dùng có email này hay không
    $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    //nếu có người dùng đã đăng ký bằng email này
    if ($num_rows != 0) {
      header('location: register.php?error=Người dùng địa chỉ email này đã tồn tại');

      //nếu trước đây không có người dùng nào đăng ký bằng email này
    } else {

      //tạo tài khoản mới
      $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password) VALUES (?, ?, ?)");

      $stmt->bind_param('sss', $name, $email, md5($password));

      //nếu tài khoản đã tạo thành công
      if ($stmt->execute()) {
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        header('location: account.php?register_success=Bạn đã đăng ký thành công');

        //không thể tạo tài khoản
      } else {
        header('location: register.php?error=không thể tạo tài khoản vào lúc này');
      }
    }
  }

  //nếu người dùng đã đăng ký, sau đó đưa người dùng đến trang tài khoản
} else if (isset($_SESSION['loggged_in '])) {
  header('location: account.php');
  exit;
}

?>

<!--Register-->
<section class="mt-5 py-3 py-md-5">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <div class="card border border-light-subtle rounded-3 shadow-sm">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="text-center mb-5">
              <h2>Đăng ký</h2>
            </div>
            <form method="POST" action="register.php">
              <p style="color: red;"><?php if (isset($_GET['error'])) {
                                        echo $_GET['error'];
                                      } ?></p>
              <div class="row gy-2 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Tên người dùng" required>
                    <label>Tên người dùng</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
                    <label>Email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Mật khẩu" required>
                    <label>Mật khẩu</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Nhập lại mật khẩu" required>
                    <label>Nhập lại mật khẩu</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid my-3">
                    <input type="submit" class="btn btn-dark" id="register-btn" name="register" value="Đăng ký">
                  </div>
                </div>
                <div class="col-12">
                  <p class="m-0 text-secondary text-center">Đã có tài khoản? <a href="login.php" class="link-primary text-decoration-none">Đăng nhập</a></p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->