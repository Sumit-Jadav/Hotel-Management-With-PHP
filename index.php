<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TJ Hotel</title>
    
    <!-- ! Slider js cdn -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
   <?php require("inc/links.php");?>
  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  require("inc/header.php");?>
    </header>
    <!-- ! Header section end  -->

    <main>
      <!-- ! Start of slider -->
      <section class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
          <div class="swiper-wrapper">
            <?php
              $res = selectAll("carousel");
              while($row = mysqli_fetch_assoc($res)){
                $path = CAROUSEL_IMG_PATH;
                echo <<< data
                  <div class="swiper-slide">
                    <img src="$path$row[image]" alt="Image-1" />
                  </div>    
                data;
              }
            
            ?>      
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <!-- <div class="swiper-pagination"></div> -->
        </div>
      </section>
      <!-- ! End of slider section -->

      <!-- ! Check booking availabilty  -->
      <section class="container availibility-form">
        <div class="row">
          <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Check Booking Availability</h5>
            <form action="">
              <div class="row">
                <div class="col-lg-3 mt-2">
                  <label
                    for="CheckInDate"
                    class="form-label"
                    style="font-weight: 500"
                    >Check-in</label
                  >
                  <input
                    type="date"
                    id="CheckInDate"
                    class="form-control shadow-none"
                  />
                </div>
                <div class="col-lg-3 mt-2">
                  <label
                    for="checkOutDate"
                    class="form-label"
                    style="font-weight: 500"
                    >Check-out</label
                  >
                  <input
                    type="date"
                    id="checkOutDate"
                    class="form-control shadow-none"
                  />
                </div>
                <div class="col-lg-3 mt-2">
                  <label for="adult" class="form-label" style="font-weight: 500"
                    >Adult</label
                  >
                  <select class="form-select shadow-none" id="adult">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col-lg-2 mt-2">
                  <label
                    for="children"
                    class="form-label"
                    style="font-weight: 500"
                    >Children</label
                  >
                  <select class="form-select shadow-none" id="children">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div
                  class="col-lg-1 col-md-12 d-flex justify-content-center mt-2 mt-lg-0 align-self-end"
                >
                  <button
                    type="submit"
                    class="btn text-white shadow-none custome-button"
                  >
                    Check
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>

      <!-- ! End Check booking availabilty  -->

      <!-- ! Room  Cards -->
      <section>
        <h2 class="mt-5 pt-4 mb-4 text-center h-font fw-bold">OUR ROOMS</h2>
        <div class="container">
          <div class="row">
            <?php
                $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],"ii");
                while($room_data = mysqli_fetch_assoc($room_res)){
                  // Get features from room
                  $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");
                  $features_data = "";
                  while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= "<span
                    class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'
                  >
                    $fea_row[name]
                  </span>";
                  }

                  // Get facilities for the room
                  $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = $room_data[id]");
                  $facilities_data = "";
                  while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= "<span
                    class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'
                  >
                    $fac_row[name]
                  </span>";
                  }

                  // Get thumbnail
                  $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                  $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
                    WHERE `room_id` = '{$room_data['id']}' AND `thumb` = 1");


                  if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                  }

                  // Echo card

                  echo <<< data
                    <div class="col-lg-4 col-md-6 my-3">
                      <div
                        class="card border-0 shadow"
                        style="max-width: 350px; margin: auto"
                      >
                        <img
                          src="$room_thumb"
                          class="card-img-top"
                          alt="Room Image"
                        />
                        <div class="card-body">
                          <h5 class="card-title">$room_data[name]</h5>
                          <h6 class="mb-4">&#8377;$room_data[price] per night</h6>
                          <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            $features_data
                          </div>
                          <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            $facilities_data
                          </div>
                          <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span
                              class="badge rounded-pill bg-light text-dark text-wrap"
                            >
                              $room_data[adult] Adults
                            </span>
                            <span
                              class="badge rounded-pill bg-light text-dark text-wrap"
                            >
                              $room_data[children] Childrens
                            </span>
                            
                          </div>
                          <div class="rating mb-4">
                            <h6 class="mb-1">Ratings</h6>
                            <span class="badge rounded-pill bg-light">
                              <i class="bi bi-star-fill text-warning"></i>
                              <i class="bi bi-star-fill text-warning"></i>
                              <i class="bi bi-star-fill text-warning"></i>
                              <i class="bi bi-star-fill text-warning"></i>
                            </span>
                          </div>
                          <div class="d-flex justify-content-evenly mb-2">
                            <a
                              href="#"
                              class="btn btn-sm text-white custome-button shadow-none"
                              >Book Now</a
                            >
                            <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none"
                              >More Details</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>


                      
                  data;
                    
                }
            ?>
           
            <div class="col-lg-12 text-center mt-5">
              <a
                href="rooms.php"
                class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none"
                >More Rooms >>>
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- ! End of Room Cards -->
      <!-- ! Our Facilities -->
      <section>
        <h2 class="mt-5 pt-4 mb-4 text-center h-font fw-bold">
          OUR FACILITIES
        </h2>
        <div class="container">
          <div class="row px-lg-0 justify-content-evenly px-md-0 px-5">
          <?php
            $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY id DESC LIMIT 5");
            $path = FACILITIES_IMG_PATH;
            while ($row = mysqli_fetch_assoc($res)) {
              echo <<<data
                <div
                  class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3"
                >
                  <img
                    src="$path$row[icon]"
                    alt="Facilities"
                    width="80px"
                  />
                  <h5 class="mt-3">$row[name]</h5>
                </div> 
              data;
            }
          ?>
            
            <div class="col-lg-12 text-center mt-5">
              <a
                href="facilities.php"
                class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none"
                >More Facilities >>>
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- ! End of Our facilities -->

      <!-- ! Testimonials -->
      <section>
        <h2 class="mt-5 pt-4 mb-4 text-center h-font fw-bold">Testimonial</h2>
        <div class="container">
          <div class="swiper swiper-testimonial">
            <div class="swiper-wrapper mb-5">
              <div class="swiper-slide bg-white p-4" style="display: block">
                <div class="profile d-flex align-items-center mb-3">
                  <img
                    src="./images/facilities/IMG_27079.svg"
                    alt=""
                    style="width: 30px"
                  />
                  <h6 class="m-0 ms-2">Randome User1</h6>
                </div>
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et,
                  beatae?Lorem ipsum, dolor sit amet consectetur adipisicing
                  elit. Esse, ut.
                </p>
                <div class="rating">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>
              <div class="swiper-slide bg-white p-4" style="display: block">
                <div class="profile d-flex align-items-center mb-3">
                  <img
                    src="./images/facilities/IMG_27079.svg"
                    alt=""
                    style="width: 30px"
                  />
                  <h6 class="m-0 ms-2">Randome User1</h6>
                </div>
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et,
                  beatae?Lorem ipsum, dolor sit amet consectetur adipisicing
                  elit. Esse, ut.
                </p>
                <div class="rating">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>
              <div class="swiper-slide bg-white p-4" style="display: block">
                <div class="profile d-flex align-items-center mb-3">
                  <img
                    src="./images/facilities/IMG_27079.svg"
                    alt=""
                    style="width: 30px"
                  />
                  <h6 class="m-0 ms-2">Randome User1</h6>
                </div>
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et,
                  beatae?Lorem ipsum, dolor sit amet consectetur adipisicing
                  elit. Esse, ut.
                </p>
                <div class="rating">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
          <div class="col-lg-12 text-center mt-5">
            <a
              href="about.php"
              class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none"
              >know More &gt;&gt;&gt;
            </a>
          </div>
        </div>
      </section>

      <!-- ! Reach Us  -->
      <section>
        <h2 class="mt-5 pt-4 mb-4 text-center h-font fw-bold">REACH US</h2>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
              <iframe
                class="w-100 rounded"
                src="<?php echo $contact_r["iframe"]?>"
                height="450"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
            <div class="col-lg-4 col-md-4 bg-white p-5">
              <div class="bg-white p-4 mb-4 rounded">
                <h5>Call Us</h5>
                <a
                  href="tel:+<?php echo $contact_r["pn1"]?>"
                  class="d-inline-block mb-2 text-decoration-none text-dark"
                  ><i class="bi bi-telephone-forward-fill"></i>+<?php echo $contact_r["pn1"]?></a
                >
                <br />
                <?php
                  if ($contact_r["pn2"] != "") {
                    $pn2 = $contact_r["pn2"];
                    echo <<< data
                      <a
                        href="tel:+$pn2"
                        class="d-inline-block mb-2 text-decoration-none text-dark"
                        ><i class="bi bi-telephone-forward-fill"></i>+$pn2</a
                      >
                    data;
                  }
                ?>
              </div>
              <div class="bg-white p-4 mb-4 rounded">
                <h5>Follow Us</h5>
                <?php
                  if ($contact_r["tw"] != "") {
                      echo <<< data
                        <a href="$contact_r[tw]" class="d-inline-block mb-3" target="_blank"
                        ><span class="badge bg-light text-dark fs-6 p-2"
                          ><i class="bi bi-twitter-x me-1"></i> Twitter</span
                        >
                        </a>
                        <br />
                      data;    
                  }
                
                ?>
                
                <a href="<?php echo $contact_r["fb"]?>" target="_blank" class="d-inline-block mb-3"
                  ><span class="badge bg-light text-dark fs-6 p-2"
                    ><i class="bi bi-facebook me-1"></i> Facebook</span
                  >
                </a>
                <br />
                <a href="<?php echo $contact_r["insta"]?>" target="_blank" class="d-inline-block mb-3"
                  ><span class="badge bg-light text-dark fs-6 p-2"
                    ><i class="bi bi-instagram me-1"></i> Instagram</span
                  >
                </a>
                <br />
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer>
      <?php require("inc/footer.php");?>
    </footer>
    <!-- ! Bootstrap javascript -->
    
    <!-- ! Slider js Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- ! Swiper.js link -->
    <script src="./js/swiper.js"></script>
    <!-- ! Testimonial Swiper -->
    <script src="./js/swiper-testimonial.js"></script>
  </body>
</html>
