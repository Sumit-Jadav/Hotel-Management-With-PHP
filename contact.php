<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TJ Hotel-Contact</title>

    <?php require("inc/links.php");?>
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
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59286.189511497665!2d72.12112333121826!3d21.765284248894506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f5081abb84e2f%3A0xf676d64c6e13716c!2sBhavnagar%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1743500016069!5m2!1sen!2sin"
                height="450"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
              <h5>Address</h5>
              <a
                href="https://maps.app.goo.gl/rpsPGPoZJ3dT7KBq7"
                target="_blank"
                class="d-inline-block text-decoration-none text-dark mb-2"
              >
                <i class="bi bi-geo-alt-fill"></i>
                XYZ,Bhavnagar,Gujarat</a
              >
              <h5 class="mt-4">Call Us</h5>
              <a
                href="tel:+919879034393"
                class="d-inline-block mb-2 text-decoration-none text-dark"
                ><i class="bi bi-telephone-forward-fill"></i> +919879034393</a
              >
              <br />
              <a
                href="tel:+919879034393"
                class="d-inline-block mb-2 text-decoration-none text-dark"
                ><i class="bi bi-telephone-forward-fill"></i> +919879034393</a
              >
              <h4 class="mt-4">E-Mail</h4>
              <a
                href="mailto:jadavsumit777@gmail.com"
                class="d-inline-block mb-2 text-decoration-none text-dark"
                ><i class="bi bi-envelope"></i> jadavsumit777@gmail.com</a
              >
              <h5 class="mt-4">Follow Us</h5>
              <a href="#" class="d-inline-block text-dark fs-5 me-2"
                ><i class="bi bi-twitter-x me-1"></i>
              </a>

              <a href="#" class="d-inline-block text-dark fs-5 me-2"
                ><i class="bi bi-facebook me-1"></i>
              </a>

              <a href="#" class="d-inline-block text-dark fs-5 me-2"
                ><i class="bi bi-instagram me-1"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 mb-5 px-4">
            <div class="bg-white rounded shaow p-4">
              <form action="" class="">
                <h5>Send A message</h5>
                <div class="mt-3">
                  <label for="name" style="font-weight: 500" class="form-label"
                    >Name</label
                  >
                  <input
                    type="text"
                    class="form-control shadow-none"
                    id="name"
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
                  ></textarea>
                </div>
                <button
                  type="submit"
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

    <footer>
      <?php require("inc/footer.php");?>
    </footer>
  </body>
</html>
