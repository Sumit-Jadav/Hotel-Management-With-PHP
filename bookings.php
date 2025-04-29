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
                  
                  ";
                  if ($data["rate_review"] == 0) {
                    $btn .=  "<button type='button' onclick='review_room($data[booking_id],$data[room_id])' class='btn btn-sm btn-dark  fw-bold  shadow-none ms-2' data-bs-toggle='modal' data-bs-target='#reviewModal' >
                      Rate And Review
                    </button>";  
                  }
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
      else if(isset($_GET["review_status"])) {
        alert("success","Thank you for rating!!");
      }
    ?>


      <!-- Review Modal -->
<div
  class="modal fade"
  id="reviewModal"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" id="review-form">
        <div class="modal-header">
          <h1 class="modal-title fs-5 d-flex align-items-center">
            <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i>Rate & Review
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
            <label for="InputRating" class="form-label">Rating</label>
            <select class="form-select shadow-nonde" name="rating" id="InputRating">
              <option value="5">Excellent</option>
              <option value="4">Good</option>
              <option value="3">Ok</option>
              <option value="2">Poor</option>
              <option value="1">Bad</option>

            </select>
          </div>
          <div class="mb-3">
            <label for="InputReview" class="form-label">Review</label>
            <textarea
              class="form-control shadow-none"
              id="InputReview"
              rows="3"
              name="review"
              required
            ></textarea>
          </div>
          <input type="hidden" name="booking_id">
          <input type="hidden" name="room_id">
          <div class="text-end">
            <button type="submit" class="btn custome-button text-white btn-dark shadow-none">
              SUBMIT
            </button>
           
            
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



    <footer>
      <?php require("inc/footer.php");?>
    </footer>

    <script src="js/bookings.js"></script>
  </body>
</html>
