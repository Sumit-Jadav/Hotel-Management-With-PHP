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
    <title>Admin Panel - Features & Facilities</title>
    <?php require("inc/links.php");?>
  </head>
  <body class="bg-white">
    <?php require("inc/header.php")?>
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">FEATURES & FACILITIES</h3>

          <!-- Feature Card -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="d-flex align-items-center justify-content-between mb-3"
              >
                <h5 class="card-title m-0">Features</h5>
                <button
                  type="button"
                  class="btn btn-dark shadow-none btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#feature-s"
                >
                  <i class="bi bi-plus-square">Add</i>
                </button>
              </div>

              <div
                class="table-responsive-md"
                style="height: 350px; overflow-y: scroll"
              >
                <table class="table table-hover border">
                  <thead class="sticky-top z-0">
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Name</th>

                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="feature-data"></tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Facilities Card -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="d-flex align-items-center justify-content-between mb-3"
              >
                <h5 class="card-title m-0">Facilities</h5>
                <button
                  type="button"
                  class="btn btn-dark shadow-none btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#facility-s"
                >
                  <i class="bi bi-plus-square">Add</i>
                </button>
              </div>

              <div
                class="table-responsive-md"
                style="height: 350px; overflow-y: scroll"
              >
                <table class="table table-hover border">
                  <thead class="sticky-top">
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Icon</th>
                      <th scope="col">Name</th>
                      <th scope="col" width="40%">Description</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="facilities-data"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Feature Modal -->
    <div
      class="modal fade"
      id="feature-s"
      data-bs-backdrop="static"
      data-bs-keyboard="true"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <form action="" id="feature_s_form">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Feature</h5>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="facility_name_inp" class="form-label">Name</label>
                <input
                  type="text"
                  name="feature_name"
                  class="form-control shadow-none"
                  id="feature_name_inp"
                  required
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="reset"
                class="btn text-secondary shadow-none"
                data-bs-dismiss="modal"
              >
                Cancle
              </button>
              <button
                type="submit"
                class="btn custome-button text-white shadow-none"
              >
                Submit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Faclitiy Modal -->
    <div
      class="modal fade"
      id="facility-s"
      data-bs-backdrop="static"
      data-bs-keyboard="true"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <form action="" id="facilities_s_form">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Facility</h5>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="facility_name_inp" class="form-label">Name</label>
                <input
                  type="text"
                  name="facility_name"
                  class="form-control shadow-none"
                  id="facility_name_inp"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="facility_icon_inp" class="form-label fw-bold"
                  >Icon</label
                >
                <input
                  type="file"
                  name="facility_icon"
                  class="form-control shadow-none"
                  id="facility_icon_inp"
                  accept=".jpg,.png,.webp,.jpeg,.svg"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="facility-description" class="form-label"
                  >Description</label
                >
                <textarea
                  name="facility_desc"
                  class="form-control shadow-none"
                  id="facility-description"
                  rows="3"
                ></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="reset"
                class="btn text-secondary shadow-none"
                data-bs-dismiss="modal"
              >
                Cancle
              </button>
              <button
                type="submit"
                class="btn custome-button text-white shadow-none"
              >
                Submit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
  <script src="./scripts/features_facilities.js"></script>
  <?php require("inc/scripts.php");?>
</html>
