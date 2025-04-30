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
  <title>Admin Panel - Dashboard</title>
  <?php require("inc/links.php"); ?>
</head>

<body class="bg-white">
  <?php

  require("inc/header.php");
  $is_shutdown = mysqli_fetch_assoc(mysqli_query($con, "SELECT `shutdown` FROM `settings`"));

  $current_bookings = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(CASE WHEN booking_status='booked' AND arrival = 0 THEN 1 END) AS `new_bookings` , COUNT(CASE WHEN booking_status='cancelled' AND refund = 0 THEN 1 END) AS `refund_bookings` FROM `booking_order`"));

  $unread_queries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `user_queries` WHERE `seen` = 0"));

  $unread_reviews = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `rating_review` WHERE `seen` = 0"));

  $current_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) AS `total` , COUNT(CASE WHEN status = 1 THEN 1 END) AS `active` , COUNT(CASE WHEN status = 0 THEN 1 END) AS `inactive` , COUNT(CASE WHEN is_verified = 0  THEN 1 END) AS `unverified` FROM `user_cred`"));

  ?>
  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h3 class="">DASHBOARD</h3>
          <?php
          if ($is_shutdown["shutdown"]) {
            echo <<<data

              <h6 class="badge py-2 bg-danger px-3 rounded">
                Shutdown mode is active
              </h6>

            data;
          }
          ?>
        </div>

        <div class="row mb-4">
          <div class="col-md-3 mb-4">
            <a href="new_bookings.php" class="text-decoration-none">
              <div class="card text-center p-3 text-success">
                <h6>New Bookings</h6>
                <h1 class="mt-2 mb-0"><?php echo $current_bookings["new_bookings"]; ?></h1>
              </div>
            </a>
          </div>
          <div class="col-md-3 mb-4">
            <a href="refund_bookings.php" class="text-decoration-none">
              <div class="card text-center p-3 text-warning">
                <h6>Refund Bookings</h6>
                <h1 class="mt-2 mb-0"><?php echo $current_bookings["refund_bookings"]; ?></h1>
              </div>
            </a>
          </div>
          <div class="col-md-3 mb-4">
            <a href="user_queries.php" class="text-decoration-none">
              <div class="card text-center p-3 text-info">
                <h6>User Queries</h6>
                <h1 class="mt-2 mb-0"><?php echo $unread_queries["count"] ?></h1>
              </div>
            </a>
          </div>
          <div class="col-md-3 mb-4">
            <a href="rate_review.php" class="text-decoration-none">
              <div class="card text-center p-3 text-info">
                <h6>Rating & Review</h6>
                <h1 class="mt-2 mb-0"><?php echo $unread_reviews["count"]; ?></h1>
              </div>
            </a>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h5>Booking Analytics</h5>
          <select class="form-select shadow-none bg-light w-auto" onchange="booking_alalytics(this.value)">
            <option value="1">Past 30 Days</option>
            <option value="2">Past 90 Days</option>
            <option value="3">Past 1 Year</option>
            <option value="3">All Time</option>
          </select>
        </div>
        <div class="row mb-4">
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-primary">
              <h6>Total Bookings</h6>
              <h1 class="mt-2 mb-0" id="total_bookings">0</h1>
              <h4 class="mt-2 mb-0" id="total_amt">&#8377;0</h4>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-success">
              <h6>Active Bookings</h6>
              <h1 class="mt-2 mb-0" id="active_bookings">0</h1>
              <h4 class="mt-2 mb-0" id="active_amt">&#8377;0</h4>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-danger">
              <h6>Cancelled Bookings</h6>
              <h1 class="mt-2 mb-0" id="cancelled_bookings">0</h1>
              <h4 class="mt-2 mb-0" id="cancelled_amt">&#8377;0</h4>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h5>User,Queries,Review Analytics</h5>
          <select class="form-select shadow-none bg-light w-auto" onchange="user_analytics(this.value)">
            <option value="1">Past 30 Days</option>
            <option value="2">Past 90 Days</option>
            <option value="3">Past 1 Year</option>
            <option value="3">All Time</option>
          </select>
        </div>
        <div class="row mb-4">
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-success">
              <h6>New Registration</h6>
              <h1 class="mt-2 mb-0" id="total_new_reg">0</h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-primary">
              <h6>Queries</h6>
              <h1 class="mt-2 mb-0" id="total_queries">0</h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-primary">
              <h6>Reviews</h6>
              <h1 class="mt-2 mb-0" id="total_reviews">0</h1>
            </div>
          </div>
        </div>
        <h5>Users</h5>
        <div class="row mb-4">
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-info">
              <h6>Total</h6>
              <h1 class="mt-2 mb-0"><?php echo $current_users["total"]; ?></h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-success">
              <h6>Active</h6>
              <h1 class="mt-2 mb-0"><?php echo $current_users["active"]; ?></h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-warning">
              <h6>Inactive</h6>
              <h1 class="mt-2 mb-0"><?php echo $current_users["inactive"]; ?></h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-danger">
              <h6>Unverified</h6>
              <h1 class="mt-2 mb-0"><?php echo $current_users["unverified"]; ?></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require("inc/scripts.php"); ?>
  <script src="scripts/dashboard.js"></script>
</body>

</html>