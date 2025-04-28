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
    <title>Admin Panel - Rooms</title>
    <?php require("inc/links.php");?>
  </head>
  <body class="bg-white">
    <?php require("inc/header.php")?>
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">ROOMS</h3>

          <!-- Feature Card -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="text-end mb-4"
              >
                
                <button
                  type="button"
                  class="btn btn-dark shadow-none btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#add-room"
                >
                  <i class="bi bi-plus-square me-1"></i>Add
                </button>
              </div>

              <div
                class="table-responsive-lg"
                style="height: 450px; overflow-y: scroll"
              >
                <table class="table table-hover border text-center">
                  <thead class="sticky-top z-0">
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Name</th>

                      <th scope="col">Area</th>
                      <th scope="col">Guests</th>
                      <th scope="col">Price</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>

                    </tr>
                  </thead>
                  <tbody id="room-data"></tbody>
                </table>
              </div>
            </div>
          </div>

         
        </div>
      </div>
    </div>

    <!-- Add Room Modal -->
    <div
      class="modal fade"
      id="add-room"
      data-bs-backdrop="static"
      data-bs-keyboard="true"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <form action="" id="add_room_form" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Room</h5>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                      <label for="room_inp" class="form-label">Name</label>
                      <input
                        type="text"
                        name="name"
                        class="form-control shadow-none"
                        id="room_inp"
                        required
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="area_inp" class="form-label">Area</label>
                      <input
                        type="number"
                        name="area"
                        class="form-control shadow-none"
                        id="area_inp"
                        required
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="price_inp" class="form-label">Price</label>
                      <input
                        type="number"
                        name="price"
                        min="1"
                        class="form-control shadow-none"
                        id="price_inp"
                        required
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="quantity_inp" class="form-label">Quantity</label>
                      <input
                        type="number"
                        name="quantity"
                        min="1"
                        class="form-control shadow-none"
                        id="quantity_inp"
                        required
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="adult_inp" class="form-label">Adult(Max.)</label>
                      <input
                        type="number"
                        name="adult"
                        min="1"
                        class="form-control shadow-none"
                        id="adult_inp"
                        required
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="children_inp" class="form-label">Children(Max.)</label>
                      <input
                        type="number"
                        name="children"
                        min="1"
                        class="form-control shadow-none"
                        id="children_inp"
                        required
                      />
                    </div>
                    <div class="col-12 mb-3">
                        <label for="features_inp" class="form-label fw-bold">Features</label>
                        <div class="row">
                            <?php
                                $res = selectAll("features");
                                while($opt = mysqli_fetch_assoc($res)){
                                    echo <<<data
                                        <div class="col-md-3 mb-1">
                                            <label>
                                                <input type="checkbox" name="features" value="$opt[id]" class="form-check-input shadow-none">$opt[name]</input>
                                            </label>
                                        </div>
                                    data;
                                }   

                            ?>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="facilities_inp" class="form-label fw-bold">Facilities</label>
                        <div class="row">
                            <?php
                                $res = selectAll("facilities");
                                while($opt = mysqli_fetch_assoc($res)){
                                    echo <<<data
                                        <div class="col-md-3 mb-1">
                                            <label>
                                                <input type="checkbox" name="facilities" value="$opt[id]" class="form-check-input shadow-none">$opt[name]</input>
                                            </label>
                                        </div>
                                    data;
                                }   

                            ?>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="children_inp" class="form-label">Description</label>
                        <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button
                type="reset"
                class="btn text-secondary shadow-none"
                data-bs-dismiss="modal"
              >
                Cancel
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


        <!-- Edit Room Modal -->
    <div
        class="modal fade"
        id="edit-room"
        data-bs-backdrop="static"
        data-bs-keyboard="true"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <form action="" id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="room_inp" class="form-label">Name</label>
                                <input
                                type="text"
                                name="name"
                                class="form-control shadow-none"
                                id="room_inp"
                                required
                                />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="area_inp" class="form-label">Area</label>
                                <input
                                type="number"
                                name="area"
                                class="form-control shadow-none"
                                id="area_inp"
                                required
                                />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price_inp" class="form-label">Price</label>
                                <input
                                type="number"
                                name="price"
                                min="1"
                                class="form-control shadow-none"
                                id="price_inp"
                                required
                                />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="quantity_inp" class="form-label">Quantity</label>
                                <input
                                type="number"
                                name="quantity"
                                min="1"
                                class="form-control shadow-none"
                                id="quantity_inp"
                                required
                                />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="adult_inp" class="form-label">Adult(Max.)</label>
                                <input
                                type="number"
                                name="adult"
                                min="1"
                                class="form-control shadow-none"
                                id="adult_inp"
                                required
                                />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="children_inp" class="form-label">Children(Max.)</label>
                                <input
                                type="number"
                                name="children"
                                min="1"
                                class="form-control shadow-none"
                                id="children_inp"
                                required
                                />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="features_inp" class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll("features");
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo <<<data
                                                <div class="col-md-3 mb-1">
                                                    <label>
                                                        <input type="checkbox" name="features" value="$opt[id]" class="form-check-input shadow-none">$opt[name]</input>
                                                    </label>
                                                </div>
                                            data;
                                        }   

                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="facilities_inp" class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll("facilities");
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo <<<data
                                                <div class="col-md-3 mb-1">
                                                    <label>
                                                        <input type="checkbox" name="facilities" value="$opt[id]" class="form-check-input shadow-none">$opt[name]</input>
                                                    </label>
                                                </div>
                                            data;
                                        }   

                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="children_inp" class="form-label">Description</label>
                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                            </div>
                            <input type="hidden" name="room_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                        type="reset"
                        class="btn text-secondary shadow-none"
                        data-bs-dismiss="modal"
                        >
                        Cancel
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

    <!-- Manage Room images modal -->

    <div class="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" id="room-images">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Name</h5>
                <button
                    type="reset"
                    class="btn-close shadow-none"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                
            </div>
            <div class="modal-body">
                <div id="image-alert"></div>
                <div class="border-bottom border-3 pb-3 mb-3">
                    <form action="" id="add_image_form">
                    <label for="member_picture_inp" class="form-label fw-bold"
                            >Add Image</label
                          >
                          <input
                            type="file"
                            name="image"
                            class="form-control shadow-none mb-3"
                            
                            accept=".jpg,.png,.webp,.jpeg"
                            required
                          />
                          <button type="submit" class="btn custome-button text-white shadow-none">ADD</button>
                          <input type="hidden" name="room_id">
                    </form>
                </div>
                <div
                class="table-responsive-lg"
                style="height: 350px; overflow-y: scroll"
                >
                    <table class="table table-hover border text-center">
                    <thead class="sticky-top z-0">
                        <tr class="bg-dark text-light sticky-top">
                            <th scope="col" width="60%">Image</th>
                            <th scope="col">Thumb</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="room-image-data"></tbody>
                    </table>
                </div>
            </div>
           
            </div>
        </div>
    </div>
    
  </body>
  <script src="scripts/rooms.js"></script>
  <?php require("inc/scripts.php");?>
</html>
