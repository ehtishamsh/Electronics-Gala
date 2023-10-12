<?php
include('header.php');
include('nav.php');
?>
<div id="cart-items">&nbsp;</div>
<div class="container py-5">
  <div class="row d-flex justify-content-center align-items-center h-100 p-5">
    <div class="col col-xl-10">
      <div class="card" style="border-radius: 1rem;">
        <div class="row g-0">
          <div class="col-md-6 col-lg-5 d-none d-md-block">
            <img src="images/loginformImg.png" alt="login form" class="img-fluid"
              style="border-radius: 1rem 0 0 1rem;" />
          </div>
          <div class="col-md-6 col-lg-7 d-flex align-items-center">
            <div class="card-body p-4 p-lg-5 text-black">
              <div class="error-con">
                <?php if (isset($_GET['message']) && $_GET['message'] == '1') { ?>
                  <div class="alert alert-danger">Invalid Credentials</div>
                </div>
              <?php } ?>
              <form action='loginprocess.php' method='post'>
                <div class="d-flex align-items-center mb-3 pb-1">
                  <img src="images/logo.png" alt="" class="logo-form">
                </div>
                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                <div class="form-outline mb-4">
                  <label for="email" class="form-label">E-mail Address</label>
                  <input type="text" class="form-control form-control-lg" id="email" name="email">
                </div>
                <div class="form-outline mb-4">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control form-control-lg" id="password" name="password">
                </div>
                <div class="pt-1 mb-4">
                  <input type="hidden" name="refPage" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                  <input class="btn btn-dark btn-lg btn-block w-100" type="submit" value="Login" name="submit">
                  <p class="mb-5 pb-lg-2 mt-2" style="color: #393f81;">Don't have an account? <a href="register.php"
                      style="color: #393f81;">Register here</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php include('footer.php'); ?>