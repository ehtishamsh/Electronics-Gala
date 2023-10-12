<!-- head -->
<section class="head">
  <div class="container d-flex justify-content-end py-1 head_container">
    <div class="head-row d-flex gap-4">
      <div class="phone">
        <i class="bi bi-telephone me-1"></i>
        <label>123-456-789</label>
      </div>
      <div class="mail">
        <i class="bi bi-envelope-at me-1"></i>
        <label>example@gmail.com</label>
      </div>
    </div>
  </div>
</section>
<!-- Navvar -->
<nav class="navbar navbar-expand-lg sticky-top header" id="navbar">
  <div class="container nav_container">
    <div class="dropdown-container">
      <div class="dropdown">
        <a class="navbar-brand dropdown-toggle" href="#" id="navbarIcon" role="button" data-bs-toggle="dropdown">
          <i class="bi bi-list"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-full" aria-labelledby="navbarIcon">
          <div class="container head_container">
            <div class="row flex-wrap">
              <?php getCategory2(); ?>
            </div>
          </div>
        </ul>
      </div>
    </div>
    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="" style="width: 130px" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <form class="d-flex" role="search" id="search" action="filter.php" method="get">
        <input class="form-control rounded-1 shadow-none border-0" type="search" placeholder="Search"
          aria-label="Search" name="search_query" />
        <button class="rounded-1" id="btn-search">
          <i class="bi bi-search"></i>
        </button>
      </form>
    </div>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="dropdown_nav">
      <li class="nav-item dropdown d-flex justify-content-center align-items-center" id="dropdown_margin">
        <?php if (isset($_SESSION['customer'])) {
          ?>
          <a class="nav-link dropdown-toggle" href="cus_order.php" id="navbarDropdown" role="button">
            <i class="fa-regular fa-circle-user"></i>
            <span>Welcome</span>
            <?php
        } else {
          ?>
            <a class="nav-link dropdown-toggle" href="login.php" id="navbarDropdown" role="button">
              <i class="fa-regular fa-circle-user"></i>
              <span>Guest</span>
              <?php
        }
        ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-nav" aria-labelledby="navbarDropdown">
            <?php if (isset($_SESSION['customer'])) {
              ?>
              <a class="dropdown-item" href="cus_order.php">Account</a>
              <a class="dropdown-item" href="logout.php">Logout</a>
              <?php
            } else {
              ?>
              <li><a class="dropdown-item" href="login.php">Login</a></li>
              <li><a class="dropdown-item" href="register.php">Register</a></li>
              <?php
            }
            ?>
          </ul>
      </li>
      <li class="nav-item d-flex align-items-center justify-content-center position-relative">
        <a class="nav-link" href="cart.php">
          <?php if (isset($_SESSION['cart'])) {
            $cart_count = count($_SESSION['cart']);
          } else {
            $cart_count = 0;
          } ?>
          <i class="bi bi-cart4"></i>
          <sup class="cart-count">
            <p>
              <?php echo $cart_count; ?>
            </p>
          </sup>
        </a>
      </li>
    </ul>
  </div>
</nav>