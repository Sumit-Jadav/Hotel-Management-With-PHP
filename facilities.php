<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TJ Hotel-Facilities</title>

    <?php require("inc/links.php");?>
    <style type="text/css">
      .pop:hover {
        border-top-color: var(--teal) !important;
        scale: 1.03;
        transition: all 0.3s;
      }
    </style>
  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <?php  require("inc/header.php");?>
    </header>
    <!-- ! Header section end  -->

    <main>
      <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Atque fugiat
          enim culpa expedita nam. <br />
          Tempore quisquam architecto voluptate aliquid perspiciatis!
        </p>
      </div>
      <div class="container">
        <div class="row">
          <?php
            $res = selectAll("facilities");
            $path = FACILITIES_IMG_PATH;
            while ($row = mysqli_fetch_assoc($res)) {
              echo <<<data
                <div class="col-lg-4 col-md-6 mb-5 px-4">
                  <div
                    class="bg-white rounded shaow p-4 border-top border-4 border-dark pop"
                  >
                    <div class="d-flex align-items-center mb-2">
                      <img
                        src="$path$row[icon]"
                        style="width: 40px"
                      />
                      <h5 class="m-0 ms-3">$row[name]</h5>
                    </div>
                    <p>
                      $row[description]
                    </p>
                  </div>
                </div>
              data;
            }
          
          ?>
          
         
        </div>
      </div>
    </main>

    <footer>
      <?php require("inc/footer.php");?>
    </footer>
  </body>
</html>
