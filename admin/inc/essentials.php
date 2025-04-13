<?php
    function alert($type,$message){
        $bs_class = ($type == "sucsess")?"alert-success":"alert-danger";
        echo <<<alert
                <div class="alert $bs_class custome-alert alert-dismissible fade show" role="alert">
                    <strong class="me-3">$message</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
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
        session_regenerate_id(true);

    }
?>