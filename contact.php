<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require("inc/links.php");?>
    <title><?php echo $settings_r["site_title"]?>-Contact</title>

  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  require("inc/header.php");?>
    </header>
    <!-- ! Header section end  -->

    <main>
      <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque fugiat
          enim culpa expedita nam. <br />
          Tempore quisquam architecto voluptate aliquid perspiciatis!
        </p>
      </div>

      

      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shaow p-4">
              <iframe
                class="w-100 rounded mb-4"
                src="<?php echo $contact_r['iframe'] ?>"
                height="450"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
              <h5>Address</h5>
              <a
                href="<?php echo $contact_r['gmap'] ?>"
                target="_blank"
                class="d-inline-block text-decoration-none text-dark mb-2"
              >
                <i class="bi bi-geo-alt-fill"></i>
                <?php echo $contact_r['address'] ?></a
              >
              <h5 class="mt-4">Call Us</h5>
              <a
                href="tel:+919879034393"
                class="d-inline-block mb-2 text-decoration-none text-dark"
                ><i class="bi bi-telephone-forward-fill"></i> +<?php echo $contact_r['pn1'] ?></a
              >
              <br />
              <?php
                if ($contact_r["pn2"] != "") {
                  echo <<<data
                    <a
                    href="tel:+$contact_r[pn2]"
                    class="d-inline-block mb-2 text-decoration-none text-dark"
                    ><i class="bi bi-telephone-forward-fill"></i> +$contact_r[pn2]</a
                    > 
                  data;
                }

              ?>
              
              <h4 class="mt-4">E-Mail</h4>
              <a
                href="mailto:<?php echo $contact_r['email'] ?>"
                class="d-inline-block mb-2 text-decoration-none text-dark"
                ><i class="bi bi-envelope me-2"></i><?php echo $contact_r['email']; ?></a
              >
              <h5 class="mt-4">Follow Us</h5>
              <?php
                if ($contact_r["tw"] != "") {
                  echo <<< data
                    <a href="$contact_r[tw]" target="_blank" class="d-inline-block text-dark fs-5 me-2"
                      ><i class="bi bi-twitter-x me-1"></i>
                    </a>
                  data;
                }
                
              ?>


              <a href="<?php echo $contact_r['fb'] ?>" target="_blank" class="d-inline-block text-dark fs-5 me-2"
                ><i class="bi bi-facebook me-1"></i>
              </a>

              <a href="<?php echo $contact_r['insta'] ?>" target="_blank" class="d-inline-block text-dark fs-5 me-2"
                ><i class="bi bi-instagram me-1"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shaow p-4">
              <form action="" class="" method="POST">
                <h5>Send A message</h5>
                <div class="mt-3">
                  <label for="name" style="font-weight: 500" class="form-label"
                    >Name</label
                  >
                  <input
                    type="text"
                    class="form-control shadow-none"
                    id="name"
                    name="name" required
                  />
                </div>
                <div class="mt-3">
                  <label for="email" style="font-weight: 500" class="form-label"
                    >Email</label
                  >
                  <input
                    type="email"
                    class="form-control shadow-none"
                    id="email"
                    name="email" required
                  />
                </div>
                <div class="mt-3">
                  <label
                    for="subject"
                    style="font-weight: 500"
                    class="form-label"
                    >Subject</label
                  >
                  <input
                    type="text"
                    class="form-control shadow-none"
                    id="subject"
                    name="subject" required
                  />
                </div>
                <div class="mt-3">
                  <label
                    for="message"
                    style="font-weight: 500"
                    class="form-label"
                    >Message</label
                  >
                  <textarea
                    name="message"
                    id="message"
                    class="shadow-none form-control"
                    rows="5"
                    style="resize: none"
                    required
                  ></textarea>
                </div>
                <button
                  type="submit"
                  name="send"
                  class="btn text-white custome-button mt-3"
                >
                  SEND
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php
      if (isset($_POST["send"])) {
        $frm_data = filteration($_POST);
        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data["name"],$frm_data["email"],$frm_data["subject"],$frm_data["message"]];
        $res = insert($q,$values,"ssss");
        if ($res == 1) {
          alert("success","Message Send");
        }
        else{
          alert("danger","Try again later");
        }
      }
    
    
    ?>
    <footer>
      <?php require("inc/footer.php");?>
    </footer>
  </body>
</html>
