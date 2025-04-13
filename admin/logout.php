<?php
    require("inc/essentials.php");
    session_start();
    if ($_SESSION["adminLogin"] == true) {
        # code...
        session_destroy();
        redirect("index.php");
    }
    else{
        redirect("index.php");
    }
?>