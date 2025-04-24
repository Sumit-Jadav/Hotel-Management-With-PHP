<!-- ! Bootstrap Cdn -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
  crossorigin="anonymous"
/>
<!-- ! Google Font   -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
  rel="stylesheet"
/>
<!-- ! Bootstrap icon cdn -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
/>
<!-- ! My stylesheet -->
<link rel="stylesheet" href="./css/style.css" />

<?php
  require("admin/inc/db_config.php");
  require("admin/inc/essentials.php");

  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no` = ?";
  $values = [1];
  $contact_r = mysqli_fetch_assoc(select($contact_q,$values,"i"));
  $settings_q = "SELECT * FROM `settings` WHERE `sr_no` = ?";
  $settings_r = mysqli_fetch_assoc(select($settings_q,$values,"i"));
?>