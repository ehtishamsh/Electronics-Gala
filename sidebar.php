<?php
include('header.php');
if (!isset($_SESSION['customerid']) || $_SESSION['customerid'] === null) {
  // Redirect the user to the login page
  header("Location: login.php"); // Replace 'login.php' with your login page URL
  exit();
}


include('nav.php');

?>
<div class="container-fluid h-100">
  <div class="row flex-nowrap">
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 py-4 custom-sidebar-acc">
      <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <span class="fs-6 d-none d-sm-inline">Welcome,
            <?php $c_id = $_SESSION['customerid'];
            $sql = "SELECT * FROM users WHERE id='$c_id'";
            $result3 = mysqli_query($con, $sql);
            $names = mysqli_fetch_assoc($result3);
            echo $names["name"]; ?>
          </span>
        </a>
        <ul
          class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start account-sidebar-list"
          id="menu">
          <li>
            <a href="cus_information.php" class="nav-link px-3 align-middle">
              <div class="container-acc-links">
                <i class="fs-4 bi-person-circle"></i> <span class="ms-1 d-none d-sm-inline text-sidebar">Profile</span>
              </div>
            </a>
          </li>
          <li>
            <a href="cus_order.php" class="nav-link px-3 align-middle ">
              <div class="container-acc-links">
                <i class="fs-4 bi-clock-history"></i> <span class="ms-1 d-none d-sm-inline text-sidebar">Orders
                  History</span>
              </div>
            </a>
          </li>
        </ul>
        <hr>
      </div>
    </div>
    <div class="col p-5 my-2 acc-container-col">
      <!-- content -->