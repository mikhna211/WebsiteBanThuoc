<?php include('header.php'); ?>

<?php

include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
    header('location: index.php');
    exit;
}

if (isset($_POST['login_btn'])) {

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");

  $stmt->bind_param('ss', $email, $password);

  if ($stmt->execute()) {
    $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
      $stmt->fetch();

      $_SESSION['admin_id'] = $admin_id;
      $_SESSION['admin_name'] = $admin_name;
      $_SESSION['admin_email'] = $admin_email;
      $_SESSION['admin_logged_in'] = true;

      header('location: index.php?login_success=đăng nhập thành công');
    } else {
      header('location: login.php?message=không thể xác thực tài khoản của bạn');
    }
  } else {
    //error
    header('location: login.php?error=đã có lỗi xảy ra');
  }
}

?>

    <section class="mt-3 py-5 py-md-5">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-5">
                                <h2>Đăng nhập</h2>
                            </div>
                            <form id="login-form" method="POST" action="login.php">
                                <p style="color: red" class="text-center"><?php if (isset($_GET['error'])) {
                                                                                echo $_GET['error'];
                                                                            } ?></p>
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
                                            <label>Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                                            <label>Mật khẩu</label>
                                        </div>
                                    </div>
                                
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <input type="submit" class="btn btn-dark" id="login-btn" name="login_btn" value="Đăng nhập">
                                        </div>
                                    </div>
                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>