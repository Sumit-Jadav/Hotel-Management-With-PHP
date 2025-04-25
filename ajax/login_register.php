<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("../admin/inc/essentials.php");
require("../admin/inc/db_config.php");
require("../PHPMailer/Exception.php");
require("../PHPMailer/PHPMailer.php");
require("../PHPMailer/SMTP.php");

date_default_timezone_set("Asia/Kolkata");



function send_mail($email,$token,$type){
    $page = "";
    $subject = "";
    $content = "";
    $mail = new PHPMailer(true);
    if ($type == "email_confirmation") {
        $page = "email_confirm.php";
        $subject = "Email Verification Link";
        $content = "verify your account";
    }
    else{
        $page = "index.php";
        $subject = "Password Reset Link";
        $content = "reset your password";
    }
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = FROM_MAIL;                    
    $mail->Password   = APP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    
    $mail->setFrom(FROM_MAIL, MAILER_NAME);
    // $mail->addAddres($email,$name);       
    $mail -> addAddress($email);
    
    $url = SITE_URL.$page."?email=".$email."&token=".$token."&".$type;
    //Content
    $mail->isHTML(true);                                 
    $mail->Subject = $subject;
    $mail->Body    = "Click the link to $content<br><a href='" . $url . "'>CLICK ME</a>";

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
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum` = ? LIMIT 1",[$data["email"],$data["phonenum"]],"ss");

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
   if(!send_mail($data["email"],$token,"email_confirmation")){
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

if (isset($_POST["login"])) {
    $data = filteration($_POST);
    
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum` = ? LIMIT 1",[$data["email_mob"],$data["email_mob"]],"ss");

    if (mysqli_num_rows($u_exist) == 0) {
        echo "inv_email_mob";
        exit;
    }else{
        $u_fetch =  mysqli_fetch_assoc($u_exist);
       
        if ($u_fetch["is_verified"] == 0) {
            echo "not_verified";
        }
        else if($u_fetch["status"] == 0){
            echo "inactive";
        }
        else{
            if (!password_verify($data["pass"],$u_fetch["password"])) {
                echo "invalid_pass";
            }else{
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["uid"] = $u_fetch["id"];
                $_SESSION["uName"] = $u_fetch["name"];
                $_SESSION["uPic"] = $u_fetch["profile"];
                $_SESSION["uPhone"] = $u_fetch["phonenum"];
                echo 1;

            }
        }
        exit;
    }

}

if (isset($_POST["forgot_pass"])) {
    $data = filteration($_POST);
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1",[$data["email"]],"s");
    if (mysqli_num_rows($u_exist) == 0) {
        echo "inv_email";
        exit;
    }
    else{
        $u_fetch =  mysqli_fetch_assoc($u_exist);
       
        if ($u_fetch["is_verified"] == 0) {
            echo "not_verified";
        }
        else if($u_fetch["status"] == 0){
            echo "inactive";
        }else{
            // Send Reset link through email
            $token = bin2hex(random_bytes(16));
            if(!send_mail($data["email"],$token,"account_recovery")){
                echo "mail_failed";
            }else{
                $date = date("Y-m-d");
                $query = mysqli_query($con,"UPDATE `user_cred` SET `token`='$token',`t_expire`='$date' WHERE `id`='$u_fetch[id]'");
                if ($query) {
                    echo 1;
                }
                else{
                    echo "upd_failed";
                }
            }
        }

    }
}

if (isset($_POST["recover_user"])) {
    $data = filteration($_POST);
    $enc_pass = password_hash($data["pass"],PASSWORD_BCRYPT);
    $query = "UPDATE `user_cred` SET `password`=?,`token`=?,`t_expire`=? WHERE `email`=? AND `token`=?";
    $values = [$enc_pass,null,null,$data["email"],$data["token"]];
    if (update($query,$values,"sssss")) {
        echo 1;
    }
    else{
        echo "failed";
    }
}

?>