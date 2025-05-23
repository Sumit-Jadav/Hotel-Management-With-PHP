<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-4 p-4">
      <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r["site_title"]?></h3>
      <p><?php echo $settings_r["site_about"]?></p>
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

  function alert(type,message,position='body'){
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div')
    element.innerHTML = `
      <div class="alert ${bs_class} custome-alert alert-dismissible fade show"  role="alert">
        <strong class="me-3">${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `
    if (position == 'body') {
      
      document.body.append(element);
      element.classList.add("custome-alert");
    }
    else{
      document.getElementById(position).appendChild(element);
      
    }
    setTimeout(remAlert,5000);
  }

  function checkLoginToBook(status,room_id) {
    if (status) {
      window.location.href="confirm_booking.php?id="+room_id;
    }
    else{
      alert("danger","Please login to book room");
    }
  }


  function remAlert() {
    document.getElementsByClassName("alert")[0].remove();
  }

</script>
<script src="./js/user_registration.js"></script>
<script src="./js/login_form.js"></script>
<script src="./js/forgot_form.js"></script>