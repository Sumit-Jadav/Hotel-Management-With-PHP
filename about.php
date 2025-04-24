<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- ! Slider js cdn -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <?php require("inc/links.php");?>
    <title><?php echo $settings_r["site_title"]?>-About</title>

    <style type="text/css">
      .box:hover {
        background-color: #fff;
        border-top-color: var(--teal) !important;
      }
    </style>
  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  require("inc/header.php");?>
    </header>
    <!-- ! Header section end  -->

    <main>
      <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque fugiat
          enim culpa expedita nam. <br />
          Tempore quisquam architecto voluptate aliquid perspiciatis!
        </p>
      </div>
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
            <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore,
              similique assumenda ullam magni officiis cumque voluptas?
            </p>
          </div>
          <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
            <img src="images/about/about.jpg" class="w-100" alt="" />
          </div>
        </div>
      </div>
      <div class="container mt-5">
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div
              class="bg-white rounded shadow p-4 border-top border-4 text-center box"
            >
              <img
                src="images/about/hotel.svg"
                style="width: 70px"
                alt="Hotel image "
              />
              <h3 class="mt-3">100+ Rooms</h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div
              class="bg-white rounded shadow p-4 border-top border-4 text-center box"
            >
              <img
                src="images/about/customers.svg"
                style="width: 70px"
                alt="Hotel image "
              />
              <h3 class="mt-3"><nobr>200+ CUSTOMERS</nobr></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div
              class="bg-white rounded shadow p-4 border-top border-4 text-center box"
            >
              <img
                src="images/about/rating.svg"
                style="width: 70px"
                alt="Hotel image "
              />
              <h3 class="mt-3">150+ REVIEWS</h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div
              class="bg-white rounded shadow p-4 border-top border-4 text-center box"
            >
              <img
                src="images/about/staff.svg"
                style="width: 70px"
                alt="Hotel image "
              />
              <h3 class="mt-3">200+ STAFFS</h3>
            </div>
          </div>
        </div>
      </div>

      <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>
      <div class="container px-4">
        <div class="swiper mySwiper">
          <div class="swiper-wrapper mb-5">
            <?php
              $about_r = selectAll("team_details");
              while($row = mysqli_fetch_assoc($about_r)){
                  $path = ABOUT_IMG_PATH;
                echo <<<data
                  <div
                    class="swiper-slide bg-white flex-column text-center overflow-hidden rounded"
                  >
                    <img src="$path$row[picture]" class="w-100 rounded" alt="" />
                    <h5 class="mt-2">$row[name]</h5>
                  </div>
                data;
              }
            ?>
            
            
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </main>

    <footer>
      <?php require("inc/footer.php");?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/about.swiper.js"></script>
  </body>
</html>
