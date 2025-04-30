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
    <title><?php echo $settings_r["site_title"]?>-Home</title>
    
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
            <form action="rooms.php">
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
                    name="checkin"
                    id="CheckInDate"
                    value="<?php echo $checkin_default?>"
                    class="form-control shadow-none"
                    required
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
                    name="checkout"
                    id="checkOutDate"
                    class="form-control shadow-none"
                    required
                  />
                </div>
                <div class="col-lg-3 mt-2">
                  <label for="adult" class="form-label" style="font-weight: 500" 
                    >Adult</label
                  >
                  <select class="form-select shadow-none" name="adult" id="adult">
                    <?php
                      $guests_q = mysqli_query($con,"SELECT MAX(adult) AS `max_adult` , MAX(children) AS `max_children` FROM `rooms` WHERE `status` = 1 AND `removed` = 0");
                      $guests_res = mysqli_fetch_assoc($guests_q);
                      for ($i=1; $i <= $guests_res["max_adult"] ; $i++) { 
                          echo "<option value='$i'>$i</option>";
                      }
                    
                    ?>
                   
                  </select>
                </div>
                <div class="col-lg-2 mt-2">
                  <label
                    for="children"
                    class="form-label"
                    style="font-weight: 500"
                    >Children</label
                  >
                  <select class="form-select shadow-none" name="children" id="children">
                    <?php
                      
                      for ($i=1; $i <= $guests_res["max_children"] ; $i++) { 
                        echo "<option value='$i'>$i</option>";
                      }
                    ?>
                    
                  </select>
                </div>
                <input type="hidden" name="check_availibility">
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
                  
                  $book_btn = "";
                  if (!$settings_r["shutdown"]) {
                    $login = 0;
                    if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
                      $login = 1;
                    }
                    $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custome-button shadow-none'>Book Now</button>";
                  }

                  $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review` WHERE `room_id` = $room_data[id]  ORDER BY `sr_no` DESC LIMIT 20";

                  $rating_res = mysqli_query($con,$rating_q);
                  $rating_fetch =  mysqli_fetch_assoc($rating_res);
                  $rating_data ="";
                  if ($rating_fetch["avg_rating"] != NULL) {
                    $rating_data .= "<div class='rating mb-4'>
                            <h6 class='mb-1'>Ratings</h6>
                            <span class='badge rounded-pill bg-light'>";
                    for ($i=0; $i < $rating_fetch["avg_rating"] ; $i++) { 
                             
                      $rating_data .= " <i class='bi bi-star-fill text-warning'></i>";
                    }
                    $rating_data .= "</span>
                          </div>";
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
                          $rating_data
                          <div class="d-flex justify-content-evenly mb-2">
                            $book_btn
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
              <?php
                $review_q ="SELECT rr.* , uc.name AS uname, r.name AS rname , uc.profile  FROM `rating_review` rr INNER JOIN `user_cred` uc ON rr.user_id = uc.id INNER JOIN `rooms` r ON rr.room_id = r.id ORDER BY `sr_no` DESC LIMIT 5";
                
                $review_res = mysqli_query($con,$review_q);
                $img_path = USERS_IMG_PATH;
                if (mysqli_num_rows($review_res) == 0) {
                  echo "No reviews yet!";
                }else{
                  while ($row = mysqli_fetch_assoc($review_res)) {
                 
                    $star = "<i class='bi bi-star-fill text-warning'></i>";
                    for($i = 1 ; $i<$row["rating"] ; $i++){
                      $star .= " <i class='bi bi-star-fill text-warning'></i> ";
                    }

                    echo <<< slides
                        <div class="swiper-slide bg-white p-4" style="display: block">
                            <div class="profile d-flex align-items-center mb-3">
                              <img
                                src="$img_path$row[profile]"
                                alt=""
                                style="width: 30px"
                                loading="lazy"
                                class="rounded-circle"
                              />
                              <h6 class="m-0 ms-2">$row[uname]</h6>
                            </div>
                            <p>
                              $row[review]
                            </p>
                            <div class="rating">
                              $star                              
                            </div>
                          </div>
                    slides;

                  }
                }
              
              
              
              ?>
              
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
        
      <!-- Password Reset Modal -->
      <section>
                
        
        <div
          class="modal fade"
          id="recoveryModal"
          data-bs-backdrop="static"
          data-bs-keyboard="false"
          tabindex="-1"
          aria-labelledby="staticBackdropLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="" id="recovery-form">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 d-flex align-items-center">
                    <i class="bi bi-shield-lock fs-3 me-2"></i>Set New Password
                  </h1>
                  <button
                    type="reset"
                    class="btn-close shadow-none"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                
                  <div class="mb-3">
                    <label for="newPass" class="form-label">New Password</label>
                    <input
                      type="password"
                      class="form-control shadow-none"
                      id="newPass"
                      name="newPass"
                      required
                    />
                    <input type="hidden" name="email">
                    <input type="hidden" name="token">
                  </div>
                  <div class="text-end mb-2">
                    <button
                          type="button"
                          class="btn shadow-none   me-2"
                          data-bs-dismiss="modal"
                    >
                      Cancle
                    </button>
                    <button type="submit" class="btn btn-dark shadow-none">
                      SUBMIT
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </section>



    </main>

    <footer>
      <?php require("inc/footer.php");?>
    </footer>
    <!-- ! Bootstrap javascript in footer file-->
    
    <!-- For reset password  -->
    <?php
      if (isset($_GET["account_recovery"])) {
        $data = filteration($_GET);
        $t_data = date("Y-m-d");
        $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",[$data["email"],$data["token"],$t_data],"sss");
          // print_r (mysqli_fetch_assoc($query));
        if (mysqli_num_rows($query) == 1) {
          echo <<< showModal
            <script>
              let myModal = document.getElementById("recoveryModal");
              myModal.querySelector("input[name='email']").value = '$data[email]';
              myModal.querySelector("input[name='token']").value = '$data[token]';
              let modal = bootstrap.Modal.getOrCreateInstance(myModal);
              modal.show();
            </script>
          showModal;
        }
        else{
          alert("danger","Invalid Link!!");
        }
      }
    
    
    ?>
    

    <!-- ! Slider js Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- ! Swiper.js link -->
    <script src="./js/swiper.js"></script>
    <!-- ! Testimonial Swiper -->
    <script src="./js/swiper-testimonial.js"></script>
    <script src="js/recovery_form.js"></script>
  </body>
</html>
