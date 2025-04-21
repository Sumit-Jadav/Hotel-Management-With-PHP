<?php

    //For Forntend use
    define("SITE_URL","http://127.0.0.1/HB/");
    define("ABOUT_IMG_PATH",SITE_URL."images/about/");
    define("CAROUSEL_IMG_PATH",SITE_URL."images/carousel/");

    // For Backend picture upload

    define("UPLOAD_IMAGE_PATH",$_SERVER['DOCUMENT_ROOT']."/HB/images/");
    define("ABOUT_FOLDER","about/");
    define("CAROUSEL_FOLDER","carousel/");
    function alert($type,$message){
        $bs_class = ($type == "success")?"alert-success":"alert-danger";
        echo <<<alert
                <div class="alert $bs_class custome-alert alert-dismissible fade show" role="alert">
                    <strong class="me-3">$message</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                alert;
    }

    function redirect($url){
        echo "
            <script>window.location.href='$url'</script>
        ";
    }

    function adminLogin(){
        session_start();
        if (!(isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)) {
            redirect("index.php");
        }
    }

    function uploadImage($image,$folder){
        $valid = ["image/jpeg","image/jpg","image/png","image/webp"];
        $img_mime = $image["type"];
        if(!in_array($img_mime,$valid)){
            return "inv_img";
        }
        else if (($image["size"]/(1024*1024)) > 2) {
            return "inv_size";  //Invalid size
        }
        else{
            $ext = pathinfo($image["name"],PATHINFO_EXTENSION);  // will return extension without dot
            $rname = "IMG_".random_int(11111,99999).".$ext";
            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image["tmp_name"],$img_path)){
                return $rname;
            }else{
                return "upd_failed";
            }


        }
    }

    function deleteImage($image,$folder){
        if (unlink(UPLOAD_IMAGE_PATH.$folder.$image)) {
            return true;
        }
        else{
            return false;
        }
    }
?>