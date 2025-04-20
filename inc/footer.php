<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-4 p-4">
      <h3 class="h-font fw-bold fs-3 mb-2">TJ HOTEL</h3>
      <p>&copy;All Rights Reserved</p>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Links</h5>
      <a href="index.php" class="d-inline-block text-decoration-none mb-2 text-dark"
        >Home</a
      ><br />
      <a href="rooms.php" class="d-inline-block text-decoration-none mb-2 text-dark"
        >Rooms</a
      ><br />
      <a href="facilities.php" class="d-inline-block text-decoration-none mb-2 text-dark"
        >Facilities</a
      ><br />
      <a href="contact.php" class="d-inline-block text-decoration-none mb-2 text-dark"
        >Contact Us</a
      ><br />
      <a href="about.php" class="d-inline-block text-decoration-none mb-2 text-dark"
        >About</a
      ><br />
    </div>
    <div class="col-lg-4 p-4">
      <h5>Follow Us</h5>
      <?php
        if ($contact_r["tw"] != "") {
          echo <<< data
            <a href="$contact_r[tw]" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none"
              ><i class="bi bi-twitter-x me-1"></i> Twitter
            </a>
            <br />
          data;
        }
      
      ?>
      <a href="<?php echo $contact_r['fb'] ?>" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none"
        ><i class="bi bi-facebook me-1"></i> Facebook
      </a>
      <br />
      <a href="<?php echo $contact_r['insta'] ?>" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none"
        ><i class="bi bi-instagram me-1"></i> Instagram
      </a>
      <br />
    </div>
  </div>
</div>

<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"
></script>
<script>
  function setActive(params) {
    let navbar = document.getElementById("nav-bar");
    let a_tag = navbar.getElementsByTagName("a");
    for(i=0;i<a_tag.length;i++){
      let file = a_tag[i].href.split("/").pop();
      let file_name = file.split(".")[0];
      if(document.location.href.indexOf(file_name) >= 0){
        a_tag[i].classList.add("active");
      }
    }
  }
  setActive();
</script>