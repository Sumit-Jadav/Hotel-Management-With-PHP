<?php
    require("admin/inc/essentials.php");
    session_start();
    // print_r($_SESSION);
    if ($_SESSION["login"]) { 
        session_destroy();
        redirect("index.php");
    }
    else{
        redirect("index.php");
    }
?>