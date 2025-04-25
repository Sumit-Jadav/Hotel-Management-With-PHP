<?php
    require("inc/essentials.php");
    require("inc/db_config.php");
    adminLogin();

    if (isset($_GET["seen"])) {
        $frm_data = filteration($_GET);
        if ($frm_data["seen"] == "all") {
            $q = "UPDATE `user_queries` SET `seen`=?";
            $values = [1];
            if (update($q,$values,"i")) {
                alert("success","All Marked as Readed");
            }
            else{
                alert("danger","Mark as Read Operation Failed!!");
            }
        }
        else{
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
            $values = [1,$frm_data["seen"]];
            if (update($q,$values,"ii")) {
                alert("success","Mark as Read");
            }
            else{
                alert("danger","Mark as Read Operation Failed!!");
            }
        }
    }

    if (isset($_GET["del"])) {
        $frm_data = filteration($_GET);
        if ($frm_data["del"] == "all") {
            $q = "DELETE FROM `user_queries`";
            
            if (mysqli_query($con,$q)) {
                alert("success","All Deleted");
            }
            else{
                alert("danger","Delete All Failed!!");
            }
        }
        else{
            $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
            $values = [$frm_data["del"]];
            if (deleteq($q,$values,"i")) {
                alert("success","Deleted");
            }
            else{
                alert("danger","Delete Operation Failed!!");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - USERS</title>
    <?php require("inc/links.php");?>
  </head>
  <body class="bg-white">
    <?php require("inc/header.php")?>
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">USERS</h3>

          <!-- Feature Card -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="text-end mb-4"
              >
                <input type="text" oninput="search_user(this.value)" name="search" class="form-control shadow-none w-25 ms-auto" placeholder="type to search" id="searchUser">
              </div>

              <div
                class="table-responsive"
                style="height: 450px; overflow-y: scroll"
              >
                <table class="table table-hover border text-center" style="min-width: 1300px;">
                  <thead class="sticky-top z-0">
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Name</th>

                      <th scope="col">Email</th>
                      <th scope="col">Phone No.</th>
                      <th scope="col">Location</th>
                      <th scope="col">DOB</th>
                      <th scope="col">Varified</th>
                      <th scope="col">Status</th>
                      <th scope="col">Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="users-data"></tbody>
                </table>
              </div>
            </div>
          </div>

         
        </div>
      </div>
    </div>


    
  </body>
  <script src="scripts/users.js"></script>
  <?php require("inc/scripts.php");?>
</html>
