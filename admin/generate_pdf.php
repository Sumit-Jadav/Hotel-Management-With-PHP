<?php
    require("inc/essentials.php");
    require("inc/db_config.php");
    require("inc/mpdf/vendor/autoload.php");
    adminLogin();

    if (isset($_GET["gen_pdf"]) && isset($_GET["id"])) {
        $frm_data = filteration($_GET);
        $query = "SELECT bo.*,bd.*,uc.email FROM `booking_order` bo INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id INNER JOIN `user_cred` uc ON bo.user_id = uc.id WHERE ( (bo.booking_status  = 'booked' AND bo.arrival = 1) OR (bo.booking_status = 'canclled' AND bo.refund = 1) OR (bo.booking_status = 'payment failed')) AND bo.booking_id = '$frm_data[id]'";
        $res = mysqli_query($con ,  $query);
        $total_rows = mysqli_num_rows($res);
        if ($total_rows == 0) {
            header("location:dashboard.php");
            exit;
        }
        $data = mysqli_fetch_assoc($res);
        $date = date("d-m-Y",strtotime($data["datentime"]));
        $checkin = date("d-m-Y",strtotime($data["check_in"]));
        $checkout = date("d-m-Y",strtotime($data["check_out"]));

        $style = "
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                h2 {
                    text-align: center;
                    color: #333;
                }
                table {
                    width: 80%;
                    margin: 20px auto;
                    border-collapse: collapse;
                    font-size: 16px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                table, th, td {
                    border: 1px solid #888;
                }
                td {
                    padding: 10px;
                    vertical-align: top;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
                tr:hover {
                    background-color: #ddd;
                }
            </style>
        ";

        $table_data ="
            $style
            <h2>BOOKING RECEIPT</h2>
            <table border = '1'>
                <tr>
                    <td>Order Id : $data[order_id]</td>
                    <td>Booking Date : $date</td>
                    
                </tr>
                <tr>
                    <td colspan='2'>Status : $data[booking_status]</td>
                </tr>
                <tr>
                    <td>Name : $data[user_name] </td>
                    <td>Email : $data[email]</td>
                </tr>
                <tr>
                    <td>Phone Number : $data[phonenum] </td>
                    <td>Address : $data[address]</td>
                </tr>
                <tr>
                    <td>Room Name : $data[room_name] </td>
                    <td>Cost : &#8377;$data[price] per night</td>
                </tr>
                <tr>
                    <td>Check-In : $checkin </td>
                    <td>Check-Out :$checkout</td>
                </tr>
        ";
        if ($data['booking_status'] == "canclled") {
            $refund = ($data["refund"]) ? "Amount Refunded" : "Not Yet Refunded";
            $table_data .= "
                <tr>
                    <td>Amount Piad: &#8377;$data[trans_amt]</td>
                    <td>Refund :$refund</td>
                </tr>
            ";
        }else if ($data['booking_status'] == "payment failed") {
            $table_data .= "
                <tr>
                    <td>Trnsaction Amount: &#8377;$data[trans_amt]</td>
                    <td>Failure Response :$data[trans_resp_msg]</td>
                </tr>
            ";
        }else{
            $table_data .= "
                <tr>
                    <td>Room Number :$data[room_no]</td>
                    <td>Amount Paid :$data[trans_amt]</td>
                </tr>
            ";
        }
        $table_data .= "</table>";

        $mpdf = new \Mpdf\Mpdf();
        $mpdf -> WriteHTML($table_data);
        $mpdf -> Output($data["order_id"].'.pdf','D');

        echo $table_data;
    }
    else{
        header("location:dashboard.php");
    }

?>