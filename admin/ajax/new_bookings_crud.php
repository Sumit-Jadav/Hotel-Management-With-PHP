<?php
    require("../inc/essentials.php");
    require("../inc/db_config.php");
    adminLogin();

    if(isset($_POST['get_bookings'])){
        $frm_data = filteration($_POST);
        $query = "SELECT bo.*,bd.* FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ? ) AND ( bo.booking_status  = ? AND bo.arrival = ?) ORDER BY bo.booking_id ASC";
        $res = select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","booked",0],"sssss");
        $i = 1;
        $table_data = "";

      if (mysqli_num_rows($res) == 0) {
        echo "<b>No data found!</b>";
        exit();
      }

        while ($data = mysqli_fetch_assoc($res)) {
          $date = date("d-m-Y",strtotime($data["datentime"]));
          $checkin = date("d-m-Y",strtotime($data["check_in"]));
          $checkout = date("d-m-Y",strtotime($data["check_out"]));
          $table_data .= "
            <tr>
              <td>$i</td>
              <td>
                <span class='badge bg-primary'>Order Id : $data[order_id]</span><br>
                <b>Name :</b> $data[user_name] <br>
                <b>Phone No. :</b> $data[phonenum] 
              </td>
              <td>
                <b>Room Name : </b>$data[room_name] <br>
                <b>Price : &#8377;</b>$data[price] 
              </td>
              <td>
                <b>Check-In : </b>$checkin <br>
                <b>Check-Out : </b>$checkout <br>
                <b>Paid : </b>&#8377;$data[trans_amt] <br>
                <b>Date :</b> $date
              </td>
              <td>
                <button type='button' onclick='assign_room($data[booking_id])' class='btn btn-sm fw-bold custome-button shadow-none text-white' data-bs-toggle='modal' data-bs-target='#assign-room'>
                  <i class = 'bi bi-check2-square'></i>Assign Room
                </button>
                <br>
                <button type='button' onclick='cancle_booking($data[booking_id])' class='btn btn-sm btn-outline-danger fw-bold mt-2 shadow-none ' >
                  <i class = 'bi bi-trash'></i>Cancel Booking
                </button>
              </td>
            </tr>
          " ;
          $i++;
        }
       echo $table_data;
    }

    if (isset($_POST["assign_room"])) {
      $frm_data = filteration($_POST);
      $query = "UPDATE `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id SET bo.arrival = ? , bo.rate_review = ?, bd.room_no = ? WHERE bo.booking_id = ?";
      $values = [1,0,$frm_data["room_no"],$frm_data["booking_id"]];
      $res = update($query,$values,"iisi");  //update 2 rows so return 2
      echo ($res == 2) ? 1 : 0;
    }

    if (isset($_POST["cancle_booking"])) {
        $frm_data = filteration($_POST);
        
        $q = "UPDATE `booking_order`  SET `booking_status` = ? , `refund`= ? WHERE booking_id = ?";
        $values= ["cancelled",0,$frm_data["booking_id"]];
        $res = update($q,$values,"sii");
        echo $res;
        
      
    }

 

?>