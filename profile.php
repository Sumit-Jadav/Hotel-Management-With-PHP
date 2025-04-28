<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require("inc/links.php");?>
    <title><?php echo $settings_r["site_title"]?>-Profile</title>
  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  
      $u_fetch = [];
        require("inc/header.php");
        if(!(isset($_SESSION["login"]) && $_SESSION["login"] == true)){
          redirect("index.php");
        }
        $u_exist = select("SELECT * FROM `user_cred` WHERE `id` = ? LIMIT 1",[$_SESSION["uid"]],"i");
        if (mysqli_num_rows($u_exist) == 0) {
          redirect("index.php");
        }
        $u_fetch = mysqli_fetch_assoc($u_exist);
      ?>
    </header>
    <!-- ! Header section end  -->

    <main>
      <div class="container">
        <div class="row">
          <div class="col-12 my-5 px-4">
            <h2 class="fw-bold">PROFILE</h2>
            <div style="font-size: 14px">
              <a href="index.php" class="text-secondary text-decoration-none"
                >Home</a
              >
              <span class="text-secondary"> > </span>
              <a href="#" class="text-secondary text-decoration-none"
                >PROFILE</a
              >
              <span> > </span>
            </div>
          </div>

          <div class="col-12 mb-5 px-4">
            <div class="bg-white p-3 p-md-4 rounded shadow-sm">
              <form action="" id="info-form">
                <h5 class="mb-3 fw-bold">Basic Information</h5>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                      type="text"
                      class="form-control shadow-none"
                      id="name"
                      name="name"
                      value="<?php echo $u_fetch['name'] ?>"
                      required 
                    />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="phonenum" class="form-label"
                      >Phone Number</label
                    >
                    <input
                      type="number"
                      class="form-control shadow-none"
                      id="phonenum"
                      name="phonenum"
                      value="<?php echo $u_fetch['phonenum'] ?>"

                      required
                    />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="InputDOB" class="form-label"
                      >Date of Birth</label
                    >
                    <input
                      type="date"
                      class="form-control shadow-none"
                      id="InputDOB"
                      name="dob"
                      value="<?php echo $u_fetch['dob'] ?>"
                      required
                    />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="InputPincode" class="form-label"
                      >Pin Code</label
                    >
                    <input
                      type="number"
                      class="form-control shadow-none"
                      id="InputPincode"
                      name="pincode"
                      value="<?php echo $u_fetch['pincode'] ?>"
                      required
                    />
                  </div>
                  <div class="col-md-8 mb-4">
                    <label for="InputAddress" class="form-label">Address</label>
                    <textarea
                      class="form-control shadow-none"
                      id="InputAddress"
                      rows="1"
                      name="address"
                      required
                    ><?php echo $u_fetch['address'] ?></textarea>
                  </div>
                </div>
                <button
                  type="submit"
                  class="btn custome-button text-white shadow-none my-1"
                >
                  Save Changes
                </button>
              </form>
            </div>
          </div>

          <div class="col-md-4 mb-5 px-4">
            <div class="bg-white p-3 p-md-4 rounded shadow-sm">
              <form action="" id="profile-form">
                <h5 class="mb-3 fw-bold">Picture Information</h5>
                <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile']?>" class="img-fluid rounded-circle" alt="user image">
                <label for="InputPhoto" class="mt-4 fw-bold form-label">New Image</label>
                <input
                  type="file"
                  class="form-control shadow-none mb-4"
                  id="InputPhoto"
                  name="profile"
                  accept=".jpg,.jpeg,.png,.webp"
                  required
                />
                  
                <button
                  type="submit"
                  class="btn custome-button text-white shadow-none my-1"
                >
                  Save Changes
                </button>
              </form>
            </div>
          </div>

          <div class="col-md-8 mb-5 px-4">
            <div class="bg-white p-3 p-md-4 rounded shadow-sm">
              <form action="" id="pass-form">
                <h5 class="mb-3 fw-bold">Change Password</h5>
                <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="new_pass" class="form-label">New Password</label>
                    <input
                      type="password"
                      class="form-control shadow-none"
                      id="new_pass"
                      name="new_pass"
                      required 
                    />
                  </div>
                  <div class="col-md-6 mb-3">
                  <label for="confirm_pass" class="form-label">Confirm Password</label>
                    <input
                      type="password"
                      class="form-control shadow-none"
                      id="confirm_pass"
                      name="confirm_pass"
                      required 
                    />
                  </div>
                </div>
             
                <button
                  type="submit"
                  class="btn custome-button text-white shadow-none my-1"
                >
                  Save Changes
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </main>

    <footer>
      <?php require("inc/footer.php");?>
    </footer>

    <script src="js/profile.js"></script>
  </body>
</html>
