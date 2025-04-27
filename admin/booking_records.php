<?php
    require("inc/essentials.php");
    require("inc/db_config.php");
    adminLogin();


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel -Booking Records</title>
    <?php require("inc/links.php");?>
  </head>
  <body class="bg-white">
    <?php require("inc/header.php")?>
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">BOOKING RECORDS</h3>

          <!-- Feature Card -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="text-end mb-4"
              >
                <input type="text" oninput="get_bookings(this.value)" name="search" class="form-control shadow-none w-25 ms-auto" placeholder="type to search" id="search-input">
              </div>

              <div
                class="table-responsive"
                style="height: 450px; overflow-y: scroll"
              >
                <table class="table table-hover border text-center" style="min-width:1200px">
                  <thead class="sticky-top z-0">
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">User Details</th>
                      <th scope="col">Room Details</th>
                      <th scope="col">Booking Details</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="table-data"></tbody>
                </table>
              </div>
              <nav >
                <ul class="pagination mt-3" id="table-pagination">
                  
                </ul>
              </nav>
            </div>
          </div>

         
        </div>
      </div>
    </div>



    
  </body>
 <script src="scripts/booking_records.js"></script>
  <?php require("inc/scripts.php");?>
</html>
