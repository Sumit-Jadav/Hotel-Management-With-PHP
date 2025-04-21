<?php
    require("inc/essentials.php");
    adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Carousel</title>
    <?php require("inc/links.php");?>
  </head>
  <body class="bg-white">
    <?php require("inc/header.php")?>
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">CAROUSEL</h3>
          <!-- Carousel Team  section -->

          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="d-flex align-items-center justify-content-between mb-3"
              >
                <h5 class="card-title m-0">Images</h5>
                <button
                  type="button"
                  class="btn btn-dark shadow-none btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#carousel-s"
                >
                  <i class="bi bi-plus-square">Add</i>
                </button>
              </div>
              <div class="row" id="carousel-data"></div>
            </div>
          </div>

          <!-- Carousel  Modal -->
          <div
            class="modal fade"
            id="carousel-s"
            data-bs-backdrop="static"
            data-bs-keyboard="true"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <form action="" id="carousel_s_form">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Image</h5>
                  </div>
                  <div class="modal-body">
                    
                    <div class="mb-3">
                      <label for="carousel_picture_inp" class="form-label fw-bold"
                        >Picture</label
                      >
                      <input
                        type="file"
                        name="carousel_picture"
                        class="form-control shadow-none"
                        id="carousel_picture_inp"
                        accept=".jpg,.png,.webp,.jpeg"
                        required
                      />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      onclick="carousel_picture.value=''"
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
        </div>
      </div>
    </div>
  </body>
  <script src="scripts/carousel.js"></script>
  <?php require("inc/scripts.php");?>
</html>
