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
          <h3 class="mb-4">Settings</h3>
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
                                type="text"
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
                                type="text"
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
  <script>
    let general_data;
    let siteTitle = document.getElementById("site_title");
    let siteAbout = document.getElementById("site_about");
    let siteTitleInp = document.getElementById("site_title_inp");
    let siteAboutInp = document.getElementById("site_about_inp");
    let shutdown_toggle = document.getElementById("shutdown-toggle");
    let general_s_form = document.getElementById("general-s-form");

    // Contacts Details
    let contact_data;
    let contact_ids = [
      "address",
      "gmap",
      "pn1",
      "pn2",
      "email",
      "fb",
      "insta",
      "tw",
    ];
    let iframe = document.getElementById("iframe");
    let contact_form = document.getElementById("contacts_s_form");

    // Team Member Section
    let team_s_form = document.getElementById("team_s_form");
    let member_name = document.getElementById("member_name_inp");
    let member_picture = document.getElementById("member_picture_inp");
    //  Event Listners
    general_s_form.addEventListener("submit", function (e) {
      e.preventDefault();
      upd_general(siteTitleInp.value, siteAboutInp.value);
    });
    contact_form.addEventListener("submit", function (e) {
      e.preventDefault();
      upd_contacts();
    });
    team_s_form.addEventListener("submit", function (e) {
      e.preventDefault();
      add_member();
    });
    // Functions for general settings
    function get_general() {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        general_data = JSON.parse(this.responseText);
        console.log(general_data);
        siteTitle.innerText = general_data.site_title;
        siteAbout.innerText = general_data.site_about;
        siteTitleInp.value = general_data.site_title;
        siteAboutInp.value = general_data.site_about;
        if (general_data.shutdown == 0) {
          shutdown_toggle.checked = false;
          shutdown_toggle.value = 0;
        } else {
          shutdown_toggle.checked = true;
          shutdown_toggle.value = 1;
        }
      };
      xhr.send("get_general");
    }

    function upd_general(title, about) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        let myModal = document.getElementById("general-s");
        let modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        if (this.responseText == 1) {
          alert("success", "Changes Saved!!");
          get_general();
        } else {
          alert("danger", "No Changes Made!!");
        }
        console.log(this.responseText);
      };
      // console.log(title + " , " + about);
      xhr.send("site_title=" + title + "&site_about=" + about + "&upd_general");
    }

    function upd_shutdown(val) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        // Here responseText will always return 1 because 1 row is always affected so to check if previous shutdown is 0 then shutdown site.
        if (this.responseText == 1 && general_data.shutdown == 0) {
          alert("success", "Site has been shutdown");
        } else {
          alert("success", "Shutdown mode off!!");
        }
        get_general();
      };
      xhr.send("upd_shutdown=" + val);
    }

    // Functions for Contact details
    function get_contacts() {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        contact_data = JSON.parse(this.responseText);
        contact_data = Object.values(contact_data);
        console.log(contact_data);
        for (i = 0; i < contact_ids.length; i++) {
          document.getElementById(contact_ids[i]).innerText =
            contact_data[i + 1];
        }
        iframe.src = contact_data[contact_data.length - 1];
        contact_inp(contact_data);
      };
      xhr.send("get_contacts");
    }

    function contact_inp(data) {
      let contact_inp_id = [
        "address_inp",
        "gmap_inp",
        "pn1_inp",
        "pn2_inp",
        "email_inp",
        "fb_inp",
        "insta_inp",
        "tw_inp",
        "iframe_inp",
      ];
      for (let i = 0; i < contact_inp_id.length; i++) {
        document.getElementById(contact_inp_id[i]).value = data[i + 1];
      }
    }

    function upd_contacts() {
      let index = [
        "address",
        "gmap",
        "pn1",
        "pn2",
        "email",
        "fb",
        "insta",
        "tw",
        "iframe",
      ];
      let contacts_inp_id = [
        "address_inp",
        "gmap_inp",
        "pn1_inp",
        "pn2_inp",
        "email_inp",
        "fb_inp",
        "insta_inp",
        "tw_inp",
        "iframe_inp",
      ];
      let data_str = "";
      for (i = 0; i < index.length; i++) {
        data_str +=
          index[i] +
          "=" +
          document.getElementById(contacts_inp_id[i]).value +
          "&";
      }
      console.log(data_str);
      console.log(data_str.split("&"));
      data_str += "upd_contacts";
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        let mymodal = document.getElementById("contact-s");
        let modal = bootstrap.Modal.getInstance(mymodal);
        modal.hide();
        if (this.responseText == 1) {
          alert("success", "Changes Saved");
          get_contacts();
        } else {
          alert("danger", "No Changes Made");
        }
      };
      xhr.send(data_str);
    }

    // Team Member Add section

    function add_member() {
      let data = new FormData();
      data.append("name", member_name.value);
      //  .files[0] will select only first file
      data.append("picture", member_picture.files[0]);
      data.append("add_member", "");
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);

      xhr.onload = function () {
        let myModal = document.getElementById("team-s");
        let modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        if (this.responseText == "inv_img") {
          alert("danger", "Invalid Extension!!");
          get_general();
        } else if (this.responseText == "inv_size") {
          alert("danger", "Size should be less than 2MB!!");
        } else if (this.responseText == "upd_faildes") {
          alert("danger", "Image Upload Failed");
        } else {
          alert("success", "New Member Added");
          member_name.value = "";
          member_picture.value = "";
          get_members();
        }

        console.log(this.responseText);
      };
      xhr.send(data);
    }

    function get_members() {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        document.getElementById("team-data").innerHTML = this.responseText;
      };
      xhr.send("get_members");
    }

    function rem_member($val) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/settings_crud.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (this.responseText == 1) {
          alert("success", "Member Remove");
          get_members();
        } else {
          alert("danger", "Server Down");
        }
      };
      xhr.send("rem_member=" + $val);
    }
    window.onload = function () {
      get_general();
      get_contacts();
      get_members();
    };
  </script>
  <?php require("inc/scripts.php");?>
</html>
