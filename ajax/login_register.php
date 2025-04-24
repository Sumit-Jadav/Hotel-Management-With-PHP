<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("../admin/inc/essentials.php");
require("../admin/inc/db_config.php");
require("../PHPMailer/Exception.php");
require("../PHPMailer/PHPMailer.php");
require("../PHPMailer/SMTP.php");

function send_mail($email,$name,$token){
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'demoemail478@gmail.com';                    
    $mail->Password   = 'eioydxxpewqqauko';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    
    $mail->setFrom('demoemail478@gmail.com', 'TJ HOTEL');
    $mail->addAddress($email,$name);       

    
    $url = SITE_URL."email_confirm.php?email=".$email."&token=".$token."&email_confirmation";
    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = 'Account Varification Link';
    $mail->Body    = 'Click the link to verify your email<br><a href="' . $url . '">CLICK ME</a>';

    if($mail->send()){
        return 1;
    }else{
        return 0;
    }
    // echo 'Message has been sent';
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return 0;
}
    
}


if (isset($_POST["register"])) {
    $data = filteration($_POST);

    // Password And Confirm Password
    if ($data["pass"] != $data["cpass"]) {
        echo "pass_mismatch";
        exit;
    }

    // Check if user exist
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? AND `phonenum` = ? LIMIT 1",[$data["email"],$data["phonenum"]],"ss");

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch =  mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch["email"] == $data["email"])? "email_already" : "phone_already";
        exit;
    }

    // Upload user image to the server

    $img = uploadUserImage($_FILES["profile"]);
    if ($img == "inv_img") {
        echo "Invalid Image";
        exit;
    }
    else if($img == "upd_failed"){
        echo "upd_failed";
    }

    // Send confirmation link to the user
    $token = bin2hex(random_bytes(16));
   if(!send_mail($data["email"],$data["name"],$token)){
    echo "Mail Failed";
    exit;
   }

   $enc_pass = password_hash($data["pass"],PASSWORD_BCRYPT);
   $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";
   $values = [$data["name"],$data["email"],$data["address"],$data["phonenum"],$data["pincode"],$data["dob"],$img,$enc_pass,$token];
   if(insert($query,$values,"sssssssss")){
    echo 1;
   }
   else{
    echo "ins_failed";
   }
}

?>