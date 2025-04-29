<?php

require("../admin/inc/essentials.php");
require("../admin/inc/db_config.php");
date_default_timezone_set("Asia/Kolkata");
if (isset($_POST["check_availibility"])) {
    $frm_data = filteration($_POST);
    $status = "";
    $result = "";

    // checkin and out validation

    $today_date = new DateTime(date("Y-m-d"));    
    $checkin_date = new DateTime($frm_data["check_in"]);
    $checkout_date = new DateTime($frm_data["check_out"]);
    if ($checkin_date == $checkout_date) {
        $status = "check_in_out_equal";
        $result = json_encode(["status"=> $status] );
    }
    else if($checkin_date > $checkout_date) {
        $status = "check_out_earlier";
        $result = json_encode(["status"=> $status] );
    }
    else if($checkin_date < $today_date){
        $status = "check_in_earlier";
        $result = json_encode(["status"=> $status] );
    }
    // Check booking availibiliy if status is blank else return error
    if ($status != "") {
        echo $result;
    }else{
        session_start();
        $tb_q = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order` WHERE `booking_status` = ? AND `room_id` = ? AND check_out > ? AND check_in < ?";

        $values = ["booked",$_SESSION["room"]["id"],$frm_data["check_in"],$frm_data["check_out"]];

        $tb_fetch = mysqli_fetch_assoc(select($tb_q , $values ,"siss"));

        $rq_res = mysqli_fetch_assoc(select("SELECT `quantity` FROM `rooms` WHERE `id` = ? ",[$_SESSION["room"]["id"]],"i"));

        if (($rq_res["quantity"] - $tb_fetch["total_bookings"]) <= 0) {
            $status = "unavailable";
            $result = json_encode(["status"=> $status]);
            echo $result;
            exit;
        }

        // Run query to check if room is available 



        $count_days = date_diff($checkin_date,$checkout_date)->days;
        $payment = $_SESSION["room"]["price"] * $count_days;
        $_SESSION["room"]["payment"] = $payment; 
        $_SESSION["room"]["available"] = true; 
        $result = json_encode(["status"=>"available","days"=> $count_days,"payment"=> $payment]);
        echo $result;
    }
}



?>