<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require("inc/links.php");?>
    <title><?php echo $settings_r["site_title"]?>-Bookings</title>

  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  
        require("inc/header.php");
        if(!(isset($_SESSION["login"]) && $_SESSION["login"] == true)){
          redirect("index.php");
        }
      
      ?>
    </header>
    <!-- ! Header section end  -->

    <main>
      
      <div class="container">
        <div class="row">
          <div class="col-12 my-5 px-4">
            <h2 class="fw-bold ">BOOKINGS</h2>
            <div style="font-size:14px">
              <a href="index.php" class="text-secondary text-decoration-none">Home</a>
              <span class="text-secondary"> > </span>
              <a href="#" class="text-secondary text-decoration-none">Bookings</a>
              <span> > </span>
            </div>
          </div>
        <?php
          $query = "SELECT bo.*,bd.* FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id WHERE ( (bo.booking_status  = 'booked') OR (bo.booking_status = 'cancelled') OR (bo.booking_status = 'payment failed')) AND (bo.user_id = ?) ORDER BY bo.booking_id DESC";
          $res = select($query,[$_SESSION["uid"]],"i");
          while ($data = mysqli_fetch_assoc($res)) {
            $date = date("d-m-Y",strtotime($data["datentime"]));
            $checkin = date("d-m-Y",strtotime($data["check_in"]));
            $checkout = date("d-m-Y",strtotime($data["check_out"]));
            $status_bg = "";
            $btn = "";
            if ($data["booking_status"] == "booked") {
              $status_bg = "bg-success";
              if ($data["arrival"] == 1) {
                $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-sm btn-dark   shadow-none ' >
                    Download PDF
                  </a>
                  <button type='button' class='btn btn-sm btn-dark fw-bold  shadow-none ' >
                    Rate And Review
                  </button>
                  ";
              }else{
                $btn = "<button onclick='cancel_booking($data[booking_id])' type='button' class='btn btn-sm btn-danger fw-bold  shadow-none ' >
                    Cancel
                  </button>
                  ";
              }
            }
            else if($data["booking_status"] == "cancelled"){
              $status_bg = "bg-danger";
              if ($data["refund"] == 0) {
                $btn = "<span class='badge bg-primary'>Refund In Progress</span>";
              }else{
                $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-sm btn-dark   shadow-none ' >
                    Download PDF
                  </a>";
              }
            }
            else{
              $status_bg = "bg-warning";
              $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-sm btn-dark   shadow-none ' >
                    Download PDF
                  </a>";
            }

            echo <<< data
              <div class="col-md-4 px-4 mb-4">
                <div class="bg-white p-3 rounded shadow-sm">
                  <h5 class="fw-bold">$data[room_name]</h5>
                  <p>&#8377;$data[price] per night</p>
                  <p>
                    <b>Check-In :</b>$checkin <br>
                    <b>Check-Out :</b>$checkout
                  </p>
                  <p>
                    <b>Amount : </b>$data[price] <br>
                    <b>Order-Id : </b>$data[order_id]<br>
                    <b>Date : </b>$date
                  </p>
                  <p>
                    <span class="badge $status_bg">$data[booking_status]</span>
                  </p>
                  $btn
                </div>
              </div>


            data;

          }        
        ?>
          
          
        </div>
      </div>
    </main>
    <?php
      if (isset($_GET["cancel_status"])) {
        alert("success","Booking Cancelled!!");
      }
          
    
    ?>
    <footer>
      <?php require("inc/footer.php");?>
    </footer>

    <script src="js/bookings.js"></script>
  </body>
</html>
