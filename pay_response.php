<?php
    require("admin/inc/db_config.php");
    require("admin/inc/essentials.php");
    require_once __DIR__ . "\config.php";
    require_once __DIR__. '\vendor\autoload.php'; // Include Composer autoloader
    date_default_timezone_set("Asia/Kolkata");

    use PhonePe\payments\v1\PhonePePaymentClient;

    
    session_start();

    function regerate_session($uid){
        $user_q = select("SELECT * FROM `user_cred` WHERE `id` = ? LIMIT 1",[$uid],"i");
        $user_fetch = mysqli_fetch_assoc($user_q);
        $_SESSION["login"] = true;
        $_SESSION["uid"] = $user_fetch["id"];
        $_SESSION["uName"] = $user_fetch["name"];
        $_SESSION["uPic"] = $user_fetch["profile"];
        $_SESSION["uPhone"] = $user_fetch["phonenum"];
    }

    unset($_SESSION["room"]);
    header("Pragma:no-cache");
    header("Cache-Control:no-cache");
    header("Expires:0"); 

    try 
    {
        if(empty($_GET['order_id'])){
            echo "No Transaction Id Found in URL";
            redirect(__DIR__."index.php");
            exit;
        }
        $phonePePaymentsClient = new PhonePePaymentClient(API_MERCHAT_ID, API_KEY, API_KEY_INDEX, ENV,true);
        $order_id = $_GET['order_id'];
        $checkStatus = $phonePePaymentsClient->statusCheck($order_id);
        $select_res = select("SELECT `booking_id`,`user_id` FROM `booking_order` WHERE `order_id`=?",[$_GET['order_id']],"s");
        if (mysqli_num_rows($select_res) == 0) {
            redirect(__DIR__."index.php");
        }
        $select_fetch = mysqli_fetch_assoc($select_res);
        $booking_id = $select_fetch['booking_id'];
        // regenerate session
        if (!isset($_SESSION["login"]) && $_SESSION["login"] == true) {
            regerate_session($select_fetch["user_id"]);
        }
        if($checkStatus->getState()!=='COMPLETED'){
            $update_query = "UPDATE `booking_order` SET `booking_status`=?,`trans_id`=?,`trans_amt`=?,`trans_status`=?,`trans_resp_msg`=? WHERE `booking_id` = ?";
            update($update_query,['payment failed',$checkStatus->getTransactionId(),$checkStatus->getAmount(),$checkStatus->getState(),"Payment Failed due to error",$booking_id],"ssissi");
        }else{
            
            $update_query = "UPDATE `booking_order` SET `booking_status`=?,`trans_id`=?,`trans_amt`=?,`trans_status`=?,`trans_resp_msg`=? WHERE `booking_id` = ?";
            update($update_query,['booked',$checkStatus->getTransactionId(),$checkStatus->getAmount(),$checkStatus->getState(),"Payment Successful",$booking_id],"ssissi");
        }
        $order_id = $_GET['order_id'];
        redirect("pay_status.php?order=".$order_id);
        
        
        
    }catch(Exception $e){
        echo "Error : ". $e->getMessage();
        exit;
    }






?>
