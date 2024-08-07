<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<?php

include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_POST['login_btn'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        $stmt->store_result();

        if ($stmt->num_rows() == 1) {
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success=đăng nhập thành công');
        } else {
            header('location: login.php?message=không thể xác thực tài khoản của bạn');
        }
    } else {
        //error
        header('location: login.php?error=đã có lỗi xảy ra');
    }
}

?>

<!--Login-->
<section class="mt-5 py-3 py-md-5">
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
                                    <div class="d-flex gap-2 justify-content-between">
                                        <a href="#!" class="link-primary text-decoration-none">Quên mật khẩu?</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid my-3">
                                        <input type="submit" class="btn btn-dark" id="login-btn" name="login_btn" value="Đăng nhập">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="m-0 text-secondary text-center">Chưa có tài khoản? <a href="register.php" class="link-primary text-decoration-none">Đăng ký</a></p>
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