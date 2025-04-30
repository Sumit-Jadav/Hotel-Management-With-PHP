<?php
require("../inc/essentials.php");
require("../inc/db_config.php");
adminLogin();

if (isset($_POST['booking_analytics'])) {
  $frm_data = filteration($_POST);

  $condition = "";
  if ($frm_data["period"] == 1) {
    $conditon = "WHERE datentime BETWEEN DATE_SUB(NOW() , INTERVAl 30 DAY) AND NOW()";
  } else if ($frm_data["period"] == 2) {
    $conditon = "WHERE datentime BETWEEN DATE_SUB(NOW() , INTERVAl 90 DAY) AND NOW()";
  } else if ($frm_data["period"] == 3) {
    $conditon = "WHERE datentime BETWEEN DATE_SUB(NOW() , INTERVAl 1 YEAR) AND NOW()";
  }

  $current_bookings = mysqli_fetch_assoc(mysqli_query($con, "SELECT 
      COUNT(CASE WHEN booking_status !='pending' AND booking_status !='payment failed' THEN 1 END) AS `total_bookings` ,
      SUM(CASE WHEN booking_status !='pending' AND booking_status !='payment failed' THEN `trans_amt` END) AS `total_amt` ,
      COUNT(CASE WHEN booking_status='booked' AND arrival = 1 THEN 1 END) AS `active_bookings` , 
      SUM(CASE WHEN booking_status='booked' AND arrival = 1 THEN `trans_amt` END) AS `active_amt` ,
      COUNT(CASE WHEN booking_status='cancelled' AND refund = 0 THEN 1 END) AS `cancelled_bookings`,
      SUM(CASE WHEN booking_status='cancelled' AND refund = 0 THEN `trans_amt` END) AS `cancelled_amt` FROM `booking_order` $conditon"));

  $output = json_encode($current_bookings);
  echo $output;
}


if (isset($_POST['user_analytics'])) {
  $frm_data = filteration($_POST);

  $condition = "";
  if ($frm_data["period"] == 1) {
    $conditon = "WHERE datentime BETWEEN NOW() - INTERVAl 30 DAYS AND NOW()";
  } else if ($frm_data["period"] == 2) {
    $conditon = "WHERE datentime BETWEEN NOW() - INTERVAl 90 DAYS AND NOW()";
  } else if ($frm_data["period"] == 3) {
    $conditon = "WHERE datentime BETWEEN NOW() - INTERVAl 1 YEAR AND NOW()";
  }

  $total_review = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `rating_review` $condition"));

  $total_queries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` FROM `user_queries` $condition"));


  $total_new_reg = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) AS `count` FROM `user_cred` $condition"));



  $output = json_encode(["total_queries" => $total_queries["count"], "total_reviews" => $total_review["count"], "total_new_reg" => $total_new_reg["count"]]);
  echo $output;
}


?>