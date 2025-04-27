<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require("inc/links.php");?>
    <title><?php echo $settings_r["site_title"]?>-Booking</title>

  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  require("inc/header.php");?>
    </header>
    <!-- ! Header section end  -->

    <main>
      <?php
      /*
        check if room id is present in the url or not
        check for shutdown mode
        user is logged in or not


      */
        if (!isset($_GET["id"]) || ($settings_r["shutdown"] == true)) {
          redirect("rooms.php");
        }
        else if(!(isset($_SESSION["login"]) && $_SESSION["login"] == true)){
          redirect("rooms.php");
        }
        // filter and get room data

        $data = filteration($_GET);
        $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data["id"],1,0],"iii");

        if (mysqli_num_rows($room_res) == 0) {
          redirect("rooms.php");
        }
        
        $room_data = mysqli_fetch_assoc($room_res);
        $_SESSION["room"] = [
          "id" => $room_data["id"],
          "name" => $room_data["name"],
          "price" => $room_data["price"],
          "payment" => null,
          "available" => false,
        ];

        // print_r($_SESSION["room"]);
        // print_r($_SESSION);
        $user_res = select("SELECT * FROM `user_cred` WHERE `id` = ? LIMIT 1 ",[$_SESSION["uid"]],"i");
        $user_data = mysqli_fetch_assoc($user_res);

      ?>
      
      <div class="container">
        <div class="row">
          <div class="col-12 my-4 px-4">
            <h2 class="fw-bold ">CONFIRM BOOKING</h2>
            <div style="font-size:14px">
              <a href="index.php" class="text-secondary text-decoration-none">Home</a>
              <span class="text-secondary"> > </span>
              <a href="rooms.php" class="text-secondary text-decoration-none">Room</a>
              <span> > </span>
              <a href="#" class="text-secondary text-decoration-none">Confirm</a>
              <span> > </span>
            </div>
          </div>
          <div class="col-lg-7 col-md-12 px-4 ">
            <?php
              $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
              $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
                WHERE `room_id` = '{$room_data['id']}' AND `thumb` = 1");


              if (mysqli_num_rows($thumb_q) > 0) {
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
              }
              echo <<< data
                <div class="card p-3 shadow-sm rounded">
                    <img src="$room_thumb" class="mb-3 img-fluid rounded" />
                    <h5>$room_data[name]</h5>
                    <h5>&#8377;$room_data[price] per night</h5>

                </div>
              data;
            
            ?>
          </div>
          <div class="col-lg-5 col-md-12">
            <div class="card mb-4 border-0 rounded-3 shadow-sm">
              <div class="card-body">
                <form action="pay_now.php" id="booking_form" method="POST" >
                  <h6 class="mb-3">BOOKING DETAILS</h6>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="name" class="form-label ">Name</label>
                      <input
                        type="text"
                        class="form-control shadow-none"
                        id="name"
                        name="name"
                        value="<?php echo $user_data["name"];?>"
                        required
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="phonenum" class="form-label ">Phone Number</label>
                      <input
                        type="text"
                        class="form-control shadow-none"
                        id="phonenum"
                        name="phonenum"
                        value="<?php echo $user_data["phonenum"];?>"
                        required
                      />
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="Address" class="form-label">Address</label>
                      <textarea
                        class="form-control shadow-none"
                        id="Address"
                        rows="1"
                        name="address"
                        
                        required
                      ><?php echo $user_data["address"];?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="checkin" class="form-label ">Check-In</label>
                      <input
                        type="date"
                        class="form-control shadow-none"
                        id="checkin"
                        name="checkin"
                        onchange="check_availability()"
                        required
                      />
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="checkout" class="form-label ">Check-Out</label>
                      <input
                        type="date"
                        class="form-control shadow-none"
                        id="checkout"
                        name="checkout"
                        onchange="check_availability()"

                        required
                      />
                    </div>
                    <div class="col-12">
                    <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                      <h6 class="text-danger mb-3" id="pay_info">Provide check-in and check-out date !</h6>
                      <button name="pay_now"  class="btn w-100 text-white custome-button mb-1 shadow-none" disabled >Pay Now</button>

                    </div>
                  </div>
                </form>
              </div>
          </div>
          </div>
          
        </div>
      </div>
    </main>

    <footer>
      <?php require("inc/footer.php");?>
    </footer>
    <script src="js/booking_form.js"></script>
  </body>
</html>
