<?php


    define("UPLOAD_IMAGE_PATH",$_SERVER['DOCUMENT_ROOT']."/HB/images/");
    defile("ABOUT_FOLDER","about/");
    
    function alert($type,$message){
        $bs_class = ($type == "sucssss")?"alert-success":"alert-danger";
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

    }
?>