<?php
    require("../admin/inc/essentials.php");
    require("../admin/inc/db_config.php");
    date_default_timezone_set("Asia/Kolkata");

    if (isset($_POST["info_form"])) {
        $data = filteration($_POST);
        session_start();
        $u_exist = select("SELECT * FROM `user_cred` WHERE `phonenum` = ? AND `id`!= ? LIMIT 1",[$data["phonenum"],$_SESSION["uid"]],"ss");

        if (mysqli_num_rows($u_exist) != 0) {
            echo "phone_already";
            exit;
        }
        $query = "UPDATE `user_cred` SET `name`=?,`address`=?,`phonenum`=?,`pincode`=?,`dob`=? WHERE `id`=?";
        $values = [$data["name"],$data["address"],$data["phonenum"],$data["pincode"],$data["dob"],$_SESSION["uid"]];
        if(update($query,$values,"sssisi")){
            $_SESSION["uName"] = $data["name"];
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if (isset($_POST["profile_form"])) {
        session_start();
       
        $img = uploadUserImage($_FILES["profile"]);
        if ($img == "inv_img") {
            echo "Invalid Image";
            exit;
        }
        else if($img == "upd_failed"){
            echo "upd_failed";
            exit;
        }
       
       
    //    Fetch old image and delete it
       
        $u_exist = select("SELECT * FROM `user_cred` WHERE  `id`= ? LIMIT 1",[$_SESSION["uid"]],"i");
        $u_fetch = mysqli_fetch_assoc($u_exist);
        deleteImage($u_fetch["profile"],USERS_FOLDER);

    // Update image in database
        
        $query = "UPDATE `user_cred` SET `profile` = ? WHERE `id`=?";
        $values = [$img,$_SESSION["uid"]];
        if(update($query,$values,"si")){
            $_SESSION["uPic"] = $img; 
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if (isset($_POST["pass_form"])) {
        $frm_data = filteration($_POST);
        session_start();

        if ($frm_data["new_pass"] != $frm_data["confirm_pass"]) {
            echo "mismatch";
            exit;
        }

        $enc_pass = password_hash($frm_data["new_pass"],PASSWORD_BCRYPT);
        
        $query = "UPDATE `user_cred` SET `password` = ? WHERE `id`=? LIMIT 1";
        $values = [$enc_pass,$_SESSION["uid"]];
        if(update($query,$values,"si")){
            echo 1;
        }
        else{
            echo 0;
        }
    }


?>