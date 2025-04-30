<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require("inc/links.php");?>
    <title><?php echo $settings_r["site_title"]?>-Rooms</title>

  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  require("inc/header.php");?>
    </header>
    <!-- ! Header section end  -->

    <main>
      <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ROOMS</h2>
        <div class="h-line bg-dark"></div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 ps-4">
            <nav
              class="navbar navbar-expand-lg bg-white rounded shadow bg-body-tertiary"
            >
              <div class="container-fluid flex-lg-column align-items-stretch">
                <h4 class="mt-2">FILTERS</h4>
                <button
                  class="navbar-toggler shadow-none"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#filterDropDown"
                  aria-controls="navbarNav"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div
                  class="collapse navbar-collapse flex-column mt-2 align-items-stretch"
                  id="filterDropDown"
                >
                  <div class="border bg-light p-3 rounded mb-3">
                    <h5 class="mb-3 d-flex align-items-center justify-content-between" style="font-size: 18px">
                      <span>CHECK AVAILABILITY</span>
                      <button type="reset" onclick="chk_avail_clear()" class="btn btn-sm text-secondary d-none shadow-none" id="chk_avail_btn">Reset</button>
                    </h5>

                    <label for="checkin" class="form-label">Check-In</label>
                    <input
                      type="date"
                      class="form-control mb-3 shadow-none"
                      id="checkin"
                      onchange="chk_avail_filter()"
                      name="checkin"
                    />
                    <label for="checkout" class="form-label">Check-Out</label>
                    <input
                      type="date"
                      class="form-control shadow-none"
                      id="checkout"
                      name="checkout"
                      onchange="chk_avail_filter()"
                    />
                  </div>
                  <div class="border bg-light p-3 rounded mb-3">
                    <h5 class="mb-3 d-flex align-items-center justify-content-between"  style="font-size: 18px">
                          <span>FACILITIES</span>
                          <button type="reset" onclick="facilities_clear()" class="btn btn-sm text-secondary d-none shadow-none" id="facilities_btn">Reset</button>
                    </h5>
                    <?php
                      $facilities_q = selectAll("facilities");
                      while ($row = mysqli_fetch_assoc($facilities_q)) {
                        echo <<< facilities
                          <div class="mb-2">
                            <input
                              type="checkbox"
                              id="$row[id]"
                              onclick="fetch_room()"
                              name = "facilities"
                              value = "$row[id]"
                              class="form-check-input me-1 shadow-none"
                              
                            />
                            <label for="$row[id]" class="form-check-label"
                              >$row[name]</label
                            >
                          </div>
                        facilities;
                      }
                    
                    
                    ?>
                    
                    
                  </div>
                  <div class="border bg-light p-3 rounded mb-3">
                    <h5 class="mb-3 d-flex align-items-center justify-content-between"  style="font-size: 18px">
                        <span>GUESTS</span>
                        <button type="reset" onclick="guests_clear()" class="btn btn-sm text-secondary d-none shadow-none" id="guest_btn">Reset</button>
                    </h5>
                    <div class="d-flex">
                      <div class="me-3">
                        <label class="form-label">Adults</label>
                        <input type="number" id="adults" min="1" oninput="gusets_filter()" class="form-control shadow-none" />
                      </div>
                      <div>
                        <label class="form-label">Childrens</label>
                        <input type="number" id="children"  min="1" oninput="gusets_filter()" class="form-control shadow-none" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
          <div class="col-lg-9 col-md-12 px-4" id="rooms-data">
          
          </div>
        </div>
      </div>
    </main>
  
    <footer>
      <?php require("inc/footer.php");?>
    </footer>
    <script>
      let rooms_data = document.getElementById("rooms-data");
      let checkin = document.getElementById("checkin");
      let checkout = document.getElementById("checkout");
      let chk_avail_btn = document.getElementById("chk_avail_btn");
      let adults = document.getElementById("adults");
      let children = document.getElementById("children");
      let guests_btn = document.getElementById("guest_btn");
      
      let facilities_btn = document.getElementById("facilities_btn");
      
      function fetch_room() {
        let chk_avail = JSON.stringify({
          checkin : checkin.value,
          checkout : checkout.value
        });
        let guests = JSON.stringify({
          adults : adults.value,
          children : children.value
        });
        let facility_list = {facilities : []};
        let get_facilities = document.querySelectorAll("[name='facilities']:checked")
        if (get_facilities.length > 0) {
          get_facilities.forEach(facility => {
            facility_list.facilities.push(facility.value);
          });
          facilities_btn.classList.remove("d-none")
        }else{
          facilities_btn.classList.add("d-none")
        }

        facility_list = JSON.stringify(facility_list);


        let xhr = new XMLHttpRequest();
        xhr.open("GET", "ajax/rooms_crud.php?fetch_rooms&chk_avail="+chk_avail+"&guests="+guests+"&facility_list="+facility_list, true);
        xhr.onprogress = function(){
          rooms_data.innerHTML = `<div class="spinner-border text-info mb-3 d-block mx-auto my-auto "  id="loader" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>`;
        }
        xhr.onload = function () {
          rooms_data.innerHTML  = this.responseText;
        }
        xhr.send();
      }

      function chk_avail_clear() {
        checkin.value = "";
        checkout.value = "";
        chk_avail_btn.classList.add("d-none")
        fetch_room();
      }


      function chk_avail_filter() {
        if (checkin.value != "" && checkout.value != "") {
          fetch_room();
          chk_avail_btn.classList.remove("d-none")
        }
      }
      function gusets_filter(){
        if (adults.value > 0 || children.value > 0) {
          fetch_room();
          guests_btn.classList.remove("d-none");
        }
      }

      function guests_clear(){
        adults.value = "";
        children.value = "";
        guests_btn.classList.add("d-none");
        fetch_room();

      }

      function facilities_clear(){
        let get_facilities = document.querySelectorAll("[name='facilities']:checked")
        get_facilities.forEach(facility => {
            facility.checked = false;
          });
        guests_btn.classList.add("d-none");
        fetch_room();
      }

      fetch_room();
    </script>
  </body>
</html>
