<?php
  require("admin/inc/db_config.php");
  require("admin/inc/essentials.php");

  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no` = ?";
  $values = [1];
  $contact_r = mysqli_fetch_assoc(select($contact_q,$values,"i"));
?>
 

<nav
  id="nav-bar" class="navbar navbar-expand-lg bg-body-tertiary bg-white px-lg-3 py-lg-2 shadow-sm sticky-top"
>
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"
      >TJ Hotel</a
    >
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link  me-2" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="rooms.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="./facilities.php">Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="contact.php">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="about.php">About</a>
        </li>
      </ul>
      <div class="d-flex" role="search">
        <button
          type="button"
          class="btn btn-outline-dark shadow-none me-lg-3 me-2"
          data-bs-toggle="modal"
          data-bs-target="#loginModal"
        >
          Login
        </button>
        <button
          type="button"
          class="btn btn-outline-dark shadow-none me-lg-2 me-3"
          data-bs-toggle="modal"
          data-bs-target="#registerModal"
        >
          Register
        </button>
      </div>
    </div>
  </div>
</nav>
<!-- Login Modal -->
<div
  class="modal fade"
  id="loginModal"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="">
        <div class="modal-header">
          <h1 class="modal-title fs-5 d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i>User Login
          </h1>
          <button
            type="reset"
            class="btn-close shadow-none"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="InputEmail" class="form-label">Email address</label>
            <input
              type="email"
              class="form-control shadow-none"
              id="InputEmail"
            />
          </div>
          <div class="mb-3">
            <label for="InputPassword" class="form-label">Password</label>
            <input
              type="password"
              class="form-control shadow-none"
              id="InputPassword"
            />
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">
              LOGIN
            </button>
            <a
              href="javascript : void(0)"
              class="text-secondary text-decoration-none"
              >Forgot Password</a
            >
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Register Modal  -->

<div
  class="modal fade modal-lg"
  id="registerModal"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" id="register-form">
        <div class="modal-header">
          <h1 class="modal-title fs-5 d-flex align-items-center">
            <i class="bi bi-person-lines-fill fs-3 me-2"> User Registration </i>
          </h1>
          <button
            type="reset"
            class="btn-close shadow-none"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <span class="badge text-bg-light mb-3 text-wrap lh-base"
            >Your detail must match with your ID(Aadharcard,Passport,Driving
            licence etc.)that will be required duringcheck-in.
          </span>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 ps-0 mb-3">
                <label for="InputEmail" class="form-label">Name</label>
                <input
                  type="text"
                  class="form-control shadow-none"
                  id="InputEmail"
                  name="name"
                  required
                />
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label for="InputEmail" class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control shadow-none"
                  id="InputEmail"
                  name="email"
                  required
                />
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label for="InputPhone" class="form-label">Phone Number</label>
                <input
                  type="number"
                  class="form-control shadow-none"
                  id="InputPhone"
                  name="phonenum"
                  required
                />
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label for="InputPhoto" class="form-label">Photo</label>
                <input
                  type="file"
                  class="form-control shadow-none"
                  id="InputPhoto"
                  name="profile"
                  accept=".jpg,.jpeg,.png,.webp"
                  required
                />
              </div>
              <div class="col-md-12 p-0 mb-3">
                <label for="InputAddress" class="form-label">Address</label>
                <textarea
                  class="form-control shadow-none"
                  id="InputAddress"
                  rows="1"
                  name="address"
                  required
                ></textarea>
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label for="InputPincode" class="form-label">Pin Code</label>
                <input
                  type="number"
                  class="form-control shadow-none"
                  id="InputPincode"
                  name="pincode"
                  required
                  />
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label for="InputDOB" class="form-label">Date of Birth</label>
                <input
                  type="date"
                  class="form-control shadow-none"
                  id="InputDOB"
                  name="dob"
                  required
                />
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input
                  type="password"
                  class="form-control shadow-none"
                  id="InputPassword"
                  name="pass"
                  required
                />
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label for="InputConformPassword" class="form-label"
                  >Conform Password</label
                >
                <input
                  type="password"
                  class="form-control shadow-none"
                  id="InputConformPassword"
                  name="cpass"
                  required
                />
              </div>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-dark shadow-none my-1">
              Register
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
