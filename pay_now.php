<?php
    require("admin/inc/db_config.php");
    require("admin/inc/essentials.php");
    require_once __DIR__ . "\config.php";
    date_default_timezone_set("Asia/Kolkata");
    require_once 'vendor/autoload.php'; // Include Composer autoloader
    use PhonePe\Env;
    use PhonePe\payments\v1\models\request\builders\InstrumentBuilder;
    use PhonePe\payments\v1\models\request\builders\PgPayRequestBuilder;
    use PhonePe\payments\v1\PhonePePaymentClient;

    
    session_start();

    if (!isset($_SESSION["login"]) && $_SESSION["login"] == true) {
        redirect("index.php");
    }
    if (isset($_POST["pay_now"])) {
        header("Pragma:no-cache");
        header("Cache-Control:no-cache");
        header("Expires:0");  

        $order_id = "ORD".$_SESSION["uid"].random_int(11111,9999999);
        $order_amount = $_SESSION["room"]["payment"] * 100; // Convert to paisa
        $message = "Your order details";
        
        try {
            $phonePePaymentsClient = new PhonePePaymentClient(API_MERCHAT_ID, API_KEY, API_KEY_INDEX, ENV,true);
            
            $request = PgPayRequestBuilder::builder()
                
                ->callbackUrl(WEBHOOK_PATH) 
                ->redirectUrl(RESPONSE_PATH."?order_id=$order_id") 
                ->merchantId(API_MERCHAT_ID)
                ->amount($order_amount)
                ->merchantTransactionId($order_id)
                ->paymentInstrument(InstrumentBuilder::buildPayPageInstrument())
                ->build();


            // Insert data into database
            $frm_data = filteration($_POST);
            print_r($frm_data);
            $q1 = "INSERT INTO `booking_order` (`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) VALUES (?,?,?,?,?)";

            $cust_id = $_SESSION["uid"];
            insert($q1,[$cust_id,$_SESSION["room"]["id"],$frm_data["checkin"],$frm_data["checkout"],$order_id],"issss");
            $booking_id = mysqli_insert_id($con);
            $q2 = "INSERT INTO `booking_details` (`booking_id`, `room_name`, `price`, `total_pay`,`user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

            insert($q2,[$booking_id,$_SESSION["room"]["name"],$_SESSION["room"]["price"],$_SESSION["room"]["payment"],$frm_data["name"],$frm_data["phonenum"],$frm_data["address"]],"isiisss"); 


            $response = $phonePePaymentsClient->pay($request);
            $PagPageUrl = $response->getInstrumentResponse()->getRedirectInfo()->getUrl();
            echo "<script>location.href='".$PagPageUrl."';</script>";
            exit;   
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            exit;
        }
    
        

        
        
        
      

        


        
        
        
        
     
               
           
    }

?>