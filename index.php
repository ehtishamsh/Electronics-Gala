<?php
include 'header.php';
include 'nav.php';
?>
<!-- Hero Section -->
<div class="container hero_container py-2">
  <div class="row cate-row no-gutters overflow-hidden" style="box-shadow: 0 0px 10px rgba(0, 0, 0, 0.15)">
    <div class="col-md-12 banner-img-container h-100">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators align-items-center">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
            class="btn_carousel active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"
            class="btn_carousel"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"
            class="btn_carousel"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/TV's And Entertainment (1200 × 400px) (1200 × 525px) (1200 × 400px).png"
              class="d-block w-100" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="images/fridge.png" class="d-block w-100" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="images/ddd.png" class="d-block w-100" alt="..." />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Brand Images -->
<div class="container hero_container blur">
  <div class="row cate-row no-gutters overflow-hidden my-5 py-5">
    <div class="col-md-12 brand-images d-flex justify-content-between align-items-center">
      <img src="images/BRAND/d7fb148a-5c08-4cef-beda-60e1ae12eb71.png" alt="" class="brand-img" />
      <img src="images/BRAND/favpng_logo-dawlance-brand-pakistan-company.png" alt="" class="brand-img" />
      <img src="images/BRAND/pngegg (5).png" alt="" class="brand-img" />
      <img src="images/BRAND/pngwing.com (19).png" alt="" class="brand-img" />
      <img src="images/BRAND/Xiaomi_logo_PNG3.png" alt="" class="brand-img" />
      <img src="images/BRAND/pngwing.com (20).png" alt="" class="brand-img" />
    </div>
  </div>
</div>
<main>
  <div class="container custom-container mt-3">
    <!-- Catrgories Images -->
    <div class="row no-gutters blur" style="gap: 2rem">
      <?php getCategoryWithImages() ?>
    </div>
    <div class="row no-gutters my-4 blur py-5">
      <div class="col-md-12 img-con">
        <img src="images/Untitled-1 copy.pdf (1600 × 300px).png" alt="" class="img-fluid banner_img w-100" />
      </div>
    </div>
    <!-- Top products -->
    <div class="row no-gutters my-5 py-5 blur">
      <div class="col-md-12" style="border: 1px solid #ededed">
        <div class="top-products-title d-flex justify-content-between">
          <div class="product-text-con d-flex justify-content-center">
            <p class="top-products-text">Top Products</p>
          </div>
          <a href="filter.php" class="top-products-view">View All</a>
        </div>
        <div class="top-prducts-2">
          <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row no-gutters py-2 px-4 justify-content-center product-row column-gap-2 overflow-hidden">
                  <?php
                  getTopProducts(0, 5) ?>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row no-gutters py-2 px-4 justify-content-center product-row column-gap-2 overflow-hidden">
                  <?php
                  getTopProducts(10, 5) ?>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="main-heading text-center mx-4 pt-5 ">
      <h3>POPULAR CATEGORIES</h3>
    </div>
    <?php include 'popularCate.php.php'; ?>
  </div>
</main>
<?php
include 'footer.php';
?>