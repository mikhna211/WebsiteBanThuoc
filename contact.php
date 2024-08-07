<!--Header-->
<?php include('layouts/header.php'); ?>
<!--Header-->

<!--Contact-->
<section id="contact" class="container mt-5 py-3 py-md-5">
  <div class="row justify-content-center mt-5">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-5">
      <div class="card border border-light-subtle rounded-3 shadow-sm">
        <div class="card-body p-3 p-md-4 p-xl-5">
          <div class="text-center mb-5">
            <h2>LIÊN HỆ TÔI</h2>
          </div>
          <div class="col-12">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="contact-name" name="name" placeholder="Tên người dùng"
                required>
              <label>Tên</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="contact-email" name="email" placeholder="Email" required>
              <label>Email</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating mb-3">
              <input type="tel" class="form-control" id="contact-phone" name="phone" placeholder="Số điện thoại"
                required>
              <label>Số điện thoại</label>
            </div>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
          </div>
          <div class="col-12">
            <div class="d-grid my-3">
              <input type="submit" class="btn btn-dark" id="contact-btn" value="Gửi">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Footer-->
<?php include('layouts/footer.php'); ?>
<!--Footer-->