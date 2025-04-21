<?php
    require("inc/essentials.php");
    adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Settings</title>
    <?php require("inc/links.php");?>
  </head>
  <body class="bg-white">
    <?php require("inc/header.php")?>
    <div class="container-fluid" id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">SETTINGS</h3>
          <!-- General settings sections -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="d-flex align-items-center justify-content-between mb-3"
              >
                <h5 class="card-title m-0">General Settings</h5>
                <button
                  type="button"
                  class="btn btn-dark shadow-none btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#general-s"
                >
                  <i class="bi bi-pencil-square">Edit</i>
                </button>
              </div>
              <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
              <p class="card-text" id="site_title"></p>
              <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
              <p class="card-text" id="site_about"></p>
            </div>
          </div>

          <!-- Modal for general setting button -->
          <div
            class="modal fade"
            id="general-s"
            data-bs-backdrop="static"
            data-bs-keyboard="true"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <form action="" id="general-s-form">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">General Settings</h5>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="site_title_inp" class="form-label"
                        >Site Tital</label
                      >
                      <input
                        type="text"
                        name="site_title"
                        class="form-control shadow-none"
                        id="site_title_inp"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="site_about_inp" class="form-label"
                        >About Us</label
                      >
                      <textarea
                        class="form-control shadow-none"
                        id="site_about_inp"
                        name="site_about"
                        rows="6"
                        required
                      ></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      onclick="siteTitleInp.value = general_data.site_title , siteAboutInp.value = general_data.site_about"
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

          <!-- Shutdown section -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="d-flex align-items-center justify-content-between mb-3"
              >
                <h5 class="card-title m-0">Shutdown Website</h5>
                <div class="form-check form-switch">
                  <form>
                    <input
                      type="checkbox"
                      id="shutdown-toggle"
                      onchange="upd_shutdown(this.value)"
                      class="form-check-input"
                    />
                  </form>
                </div>
              </div>

              <p class="card-text">
                No customers will be allowed to book hotel room when shutdown
                mode is turned on
              </p>
            </div>
          </div>

          <!-- Contact Details section -->
          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="d-flex align-items-center justify-content-between mb-3"
              >
                <h5 class="card-title m-0">Contact Settings</h5>
                <button
                  type="button"
                  class="btn btn-dark shadow-none btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#contact-s"
                >
                  <i class="bi bi-pencil-square">Edit</i>
                </button>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                    <p class="card-text" id="address"></p>
                  </div>
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Google MAp</h6>
                    <p class="card-text" id="gmap"></p>
                  </div>
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Phone number</h6>
                    <p class="card-text mb-1">
                      <i class="bi bi-telephone-fill"></i><span id="pn1"></span>
                    </p>
                    <p class="card-text mb-1">
                      <i class="bi bi-telephone-fill"></i><span id="pn2"></span>
                    </p>
                  </div>
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                    <p class="card-text" id="email"></p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                    <p class="card-text mb-1">
                      <i class="bi bi-facebook me-1"></i><span id="fb"></span>
                    </p>
                    <p class="card-text mb-1">
                      <i class="bi bi-instagram me-1"></i
                      ><span id="insta"></span>
                    </p>
                    <p class="card-text mb-1">
                      <i class="bi bi-twitter me-1"></i><span id="tw"></span>
                    </p>
                  </div>
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Google Map Frame</h6>
                    <iframe
                      src=""
                      loading="lazy"
                      class="border p-2 w-100"
                      frameborder="0"
                      id="iframe"
                    ></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal for contacts setting  -->
          <div
            class="modal fade"
            id="contact-s"
            data-bs-backdrop="static"
            data-bs-keyboard="true"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-lg">
              <form action="" id="contacts_s_form">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Contacts Settings</h5>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid p-0">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="address_inp" class="form-label"
                              >Address</label
                            >
                            <input
                              type="text"
                              name="address"
                              class="form-control shadow-none"
                              id="address_inp"
                              required
                            />
                          </div>
                          <div class="mb-3">
                            <label for="gmap_inp" class="form-label"
                              >Google Map Link</label
                            >
                            <input
                              type="text"
                              name="gmap"
                              class="form-control shadow-none"
                              id="gmap_inp"
                              required
                            />
                          </div>
                          <div class="mb-3">
                            <label for="address_inp" class="form-label"
                              >Phone Numbers(with country codes)</label
                            >
                            <div class="input-group mb-3">
                              <span class="input-group-text"
                                ><i class="bi bi-telephone-fill"></i
                              ></span>
                              <input
                                type="number"
                                name="pn1"
                                id="pn1_inp"
                                class="form-control shadow-nonde"
                                required
                              />
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                <i class="bi bi-telephone-fill"></i>
                              </span>
                              <input
                                type="number"
                                class="form-control"
                                name="pn2"
                                id="pn2_inp"
                              />
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="gmap_inp" class="form-label"
                              >Email</label
                            >
                            <input
                              type="email"
                              name="email"
                              class="form-control shadow-none"
                              id="email_inp"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="address_inp" class="form-label"
                              >Social Links</label
                            >
                            <div class="input-group mb-3">
                              <span class="input-group-text"
                                ><i class="bi bi-facebook"></i
                              ></span>
                              <input
                                type="text"
                                name="fb"
                                id="fb_inp"
                                class="form-control shadow-nonde"
                                required
                              />
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                <i class="bi bi-instagram"></i>
                              </span>
                              <input
                                type="text"
                                class="form-control"
                                name="insta"
                                id="insta_inp"
                                required
                              />
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                <i class="bi bi-twitter"></i>
                              </span>
                              <input
                                type="text"
                                class="form-control"
                                name="tw"
                                id="tw_inp"
                              />
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="gmap_inp" class="form-label"
                              >Location Link</label
                            >
                            <input
                              type="text"
                              name="iframe"
                              class="form-control shadow-none"
                              id="iframe_inp"
                              required
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      onclick="contact_inp(contact_data)"
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

          <!-- Management Team  section -->

          <div class="card border-0 shadow mb-4">
            <div class="card-body">
              <div
                class="d-flex align-items-center justify-content-between mb-3"
              >
                <h5 class="card-title m-0">Management Team Settings</h5>
                <button
                  type="button"
                  class="btn btn-dark shadow-none btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#team-s"
                >
                  <i class="bi bi-plus-square">Add</i>
                </button>
              </div>
              <div class="row" id="team-data"></div>
            </div>
          </div>

          <!-- Management Team Modal -->
          <div
            class="modal fade"
            id="team-s"
            data-bs-backdrop="static"
            data-bs-keyboard="true"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <form action="" id="team_s_form">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Team Member</h5>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="member_name_inp" class="form-label"
                        >Name</label
                      >
                      <input
                        type="text"
                        name="member_name"
                        class="form-control shadow-none"
                        id="member_name_inp"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="member_picture_inp" class="form-label fw-bold"
                        >Picture</label
                      >
                      <input
                        type="file"
                        name="member_picture"
                        class="form-control shadow-none"
                        id="member_picture_inp"
                        accept=".jpg,.png,.webp,.jpeg"
                        required
                      />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      onclick="member_name.value='',member_picture.value=''"
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
  <script src="scripts/settings.js"></script>
  <?php require("inc/scripts.php");?>
</html>
