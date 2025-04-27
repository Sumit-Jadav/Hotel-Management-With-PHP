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
    <title>Admin Panel - New Bookings</title>
    <?php require("inc/links.php");?>
  </head>
  <body class="bg-white">
    <?php require("inc/header.php")?>
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">USERS</h3>

          <!-- Feature Card -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="text-end mb-4"
              >
                <input type="text" oninput="get_bookings(this.value)" name="search" class="form-control shadow-none w-25 ms-auto" placeholder="type to search" id="searchUser">
              </div>

              <div
                class="table-responsive"
                style="height: 450px; overflow-y: scroll"
              >
                <table class="table table-hover border text-center" >
                  <thead class="sticky-top z-0">
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">User Details</th>
                      <th scope="col">Room Details</th>
                      <th scope="col">Booking Details</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="table-data"></tbody>
                </table>
              </div>
            </div>
          </div>

         
        </div>
      </div>
    </div>

      <!-- Assign Room Number  Modal -->
    <div
      class="modal fade"
      id="assign-room"
      data-bs-backdrop="static"
      data-bs-keyboard="true"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <form action="" id="assign_room_form">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Assign Room</h5>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="room_num_inp" class="form-label">Room Number</label>
                <input
                  type="text"
                  name="room_no"
                  class="form-control shadow-none"
                  id="room_num_inp"
                  required
                />
              </div>
              <span class="badge text-bg-light mb-3 text-wrap lh-base"
                >Note : Assign Room Number when user has been arrived!!!
              </span>
              <input type="hidden" name="booking_id">
            </div>
            <div class="modal-footer">
              <button
                type="reset"
                class="btn text-secondary shadow-none"
                data-bs-dismiss="modal"
              >
                Cancle
              </button>
              <button
                type="submit"
                class="btn custome-button text-white shadow-none"
              >
                Assign
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    
  </body>
 <script src="scripts/new_bookings.js"></script>
  <?php require("inc/scripts.php");?>
</html>
