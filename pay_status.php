<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require("inc/links.php");?>
    <title><?php echo $settings_r["site_title"]?>-Booking Status</title>

  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  require("inc/header.php");?>
    </header>
    <!-- ! Header section end  -->

    <main>
     
      <div class="container">
        <div class="row">
          <div class="col-12 mb-3 px-4">
            <h2 class="fw-bold mt-3">BOOKING STATUS</h2>
          </div>
          <?php
          
            $frm_data = filteration($_GET);
            if(!(isset($_SESSION["login"]) && $_SESSION["login"] == true)){
              redirect("index.php");
            }
            $booking_q = "SELECT bo.* , bd.* FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id=bd.booking_id WHERE bo.order_id = ? AND bo.user_id = ? AND bo.booking_status!=?";

            $booking_res = select($booking_q,[$frm_data["order"],$_SESSION["uid"],"pending"],"sis");
            if (mysqli_num_rows($booking_res) == 0) {
              redirect("index.php");
            }
            $booking_fetch = mysqli_fetch_assoc($booking_res);
            if ($booking_fetch["trans_status"] == "COMPLETED") {
              echo <<<data
                <div class="col-12 px-4">
                  <p class="pw-bold alert alert-success"><i class="bi bi-check-circle-fill me-2"></i>Payment done!Bookking successful<br><br><a href="bookings.php">Go To Bookings</a></p>
                </div>
              data;
            }else{
              echo <<<data
                <div class="col-12 px-4">
                  <p class="pw-bold alert alert-danger"><i class="bi bi-exclamation-triangle-fill"></i>Payment Failed!$booking_fetch[trans_resp_msg]<br><br><a href="bookings.php">Go To Bookings</a></p>
                </div>
              data;
            }



          ?>
        
          
        </div>
      </div>
    </main>

    <footer>
      <?php require("inc/footer.php");?>
    </footer>
  </body>
</html>
