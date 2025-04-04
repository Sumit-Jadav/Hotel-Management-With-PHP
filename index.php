<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TJ Hotel</title>
    <!-- ! Bootstrap Cdn -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- ! Google Font   -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- ! Bootstrap icon cdn -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <!-- ! Slider js cdn -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <!-- ! My stylesheet -->
    <link rel="stylesheet" href="./css/style.css" />
  </head>
  <body class="bg-light">
    <!-- ! Header Section -->
    <header>
      <nav
        class="navbar navbar-expand-lg bg-body-tertiary bg-white px-lg-3 py-lg-2 shadow-sm sticky-top"
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
                <a class="nav-link active me-2" aria-current="page" href="#"
                  >Home</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link me-2" href="#">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-2" href="#">Facilities</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-2" href="#">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-2" href="#">About</a>
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
                  <label for="InputEmail" class="form-label"
                    >Email address</label
                  >
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
                <div
                  class="d-flex align-items-center justify-content-between mb-2"
                >
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
            <form action="">
              <div class="modal-header">
                <h1 class="modal-title fs-5 d-flex align-items-center">
                  <i class="bi bi-person-lines-fill fs-3 me-2">
                    User Registration
                  </i>
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
                  >Your detail must match with your
                  ID(Aadharcard,Passport,Driving licence etc.)that will be
                  required duringcheck-in.
                </span>
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-6 ps-0 mb-3">
                      <label for="InputEmail" class="form-label">Name</label>
                      <input
                        type="text"
                        class="form-control shadow-none"
                        id="InputEmail"
                      />
                    </div>
                    <div class="col-md-6 p-0 mb-3">
                      <label for="InputEmail" class="form-label">Email</label>
                      <input
                        type="email"
                        class="form-control shadow-none"
                        id="InputEmail"
                      />
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label for="InputPhone" class="form-label"
                        >Phone Number</label
                      >
                      <input
                        type="number"
                        class="form-control shadow-none"
                        id="InputPhone"
                      />
                    </div>
                    <div class="col-md-6 p-0 mb-3">
                      <label for="InputPhoto" class="form-label">Photo</label>
                      <input
                        type="file"
                        class="form-control shadow-none"
                        id="InputPhoto"
                      />
                    </div>
                    <div class="col-md-12 p-0 mb-3">
                      <label for="InputAddress" class="form-label"
                        >Address</label
                      >
                      <textarea
                        class="form-control shadow-none"
                        id="InputAddress"
                        rows="1"
                      ></textarea>
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label for="InputPincode" class="form-label"
                        >Pin Code</label
                      >
                      <input
                        type="number"
                        class="form-control shadow-none"
                        id="InputPincode"
                      />
                    </div>
                    <div class="col-md-6 p-0 mb-3">
                      <label for="InputDOB" class="form-label"
                        >Date of Birth</label
                      >
                      <input
                        type="date"
                        class="form-control shadow-none"
                        id="InputDOB"
                      />
                    </div>
                    <div class="col-md-6 ps-0 mb-3">
                      <label for="InputPassword" class="form-label"
                        >Password</label
                      >
                      <input
                        type="password"
                        class="form-control shadow-none"
                        id="InputPassword"
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
    </header>
    <!-- ! Header section end  -->

    <main>
      <!-- ! Start of slider -->
      <section class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="images/carousel/1.png" alt="Image-1" />
            </div>
            <div class="swiper-slide">
              <img src="images/carousel/2.png" alt="Image-2" />
            </div>
            <div class="swiper-slide">
              <img src="images/carousel/3.png" alt="Image-3" />
            </div>
            <div class="swiper-slide">
              <img src="images/carousel/4.png" alt="Image-4" />
            </div>
            <div class="swiper-slide">
              <img src="images/carousel/5.png" alt="Image-5" />
            </div>
            <div class="swiper-slide">
              <img src="images/carousel/6.png" alt="Image-6" />
            </div>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <!-- <div class="swiper-pagination"></div> -->
        </div>
      </section>
      <!-- ! End of slider section -->

      <!-- ! Check booking availabilty  -->
      <section class="container availibility-form">
        <div class="row">
          <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Check Booking Availability</h5>
            <form action="">
              <div class="row">
                <div class="col-lg-3 mt-2">
                  <label
                    for="CheckInDate"
                    class="form-label"
                    style="font-weight: 500"
                    >Check-in</label
                  >
                  <input
                    type="date"
                    id="CheckInDate"
                    class="form-control shadow-none"
                  />
                </div>
                <div class="col-lg-3 mt-2">
                  <label
                    for="checkOutDate"
                    class="form-label"
                    style="font-weight: 500"
                    >Check-out</label
                  >
                  <input
                    type="date"
                    id="checkOutDate"
                    class="form-control shadow-none"
                  />
                </div>
                <div class="col-lg-3 mt-2">
                  <label for="adult" class="form-label" style="font-weight: 500"
                    >Adult</label
                  >
                  <select class="form-select shadow-none" id="adult">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col-lg-2 mt-2">
                  <label
                    for="children"
                    class="form-label"
                    style="font-weight: 500"
                    >Children</label
                  >
                  <select class="form-select shadow-none" id="children">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div
                  class="col-lg-1 col-md-12 d-flex justify-content-center mt-2 mt-lg-0 align-self-end"
                >
                  <button
                    type="submit"
                    class="btn text-white shadow-none custome-button"
                  >
                    Check
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>

      <!-- ! End Check booking availabilty  -->

      <!-- ! Room  Cards -->
      <section>
        <h2 class="mt-5 pt-4 mb-4 text-center h-font fw-bold">OUR ROOMS</h2>
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
              <div
                class="card border-0 shadow"
                style="max-width: 350px; margin: auto"
              >
                <img
                  src="./images/rooms/1.jpg"
                  class="card-img-top"
                  alt="Room Image"
                />
                <div class="card-body">
                  <h5 class="card-title">Simple Room name</h5>
                  <h6 class="mb-4">&#8377;200 per night</h6>
                  <div class="features mb-4">
                    <h6 class="mb-1">Features</h6>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      2 Rooms
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      1 Bathroom
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      1 Balcony
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      3 Sofa
                    </span>
                  </div>
                  <div class="facilities mb-4">
                    <h6 class="mb-1">Facilities</h6>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Wi-Fi
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Television
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      AC
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Room Heater
                    </span>
                  </div>
                  <div class="rating mb-4">
                    <h6 class="mb-1">Ratings</h6>
                    <span class="badge rounded-pill bg-light">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                    </span>
                  </div>
                  <div class="d-flex justify-content-evenly mb-2">
                    <a
                      href="#"
                      class="btn btn-sm text-white custome-button shadow-none"
                      >Book Now</a
                    >
                    <a href="#" class="btn btn-sm btn-outline-dark shadow-none"
                      >More Details</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
              <div
                class="card border-0 shadow"
                style="max-width: 350px; margin: auto"
              >
                <img
                  src="./images/rooms/1.jpg"
                  class="card-img-top"
                  alt="Room Image"
                />
                <div class="card-body">
                  <h5 class="card-title">Simple Room name</h5>
                  <h6 class="mb-4">&#8377;200 per night</h6>
                  <div class="features mb-4">
                    <h6 class="mb-1">Features</h6>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      2 Rooms
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      1 Bathroom
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      1 Balcony
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      3 Sofa
                    </span>
                  </div>
                  <div class="facilities mb-4">
                    <h6 class="mb-1">Facilities</h6>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Wi-Fi
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Television
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      AC
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Room Heater
                    </span>
                  </div>
                  <div class="rating mb-4">
                    <h6 class="mb-1">Ratings</h6>
                    <span class="badge rounded-pill bg-light">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                    </span>
                  </div>
                  <div class="d-flex justify-content-evenly mb-2">
                    <a
                      href="#"
                      class="btn btn-sm text-white custome-button shadow-none"
                      >Book Now</a
                    >
                    <a href="#" class="btn btn-sm btn-outline-dark shadow-none"
                      >More Details</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
              <div
                class="card border-0 shadow"
                style="max-width: 350px; margin: auto"
              >
                <img
                  src="./images/rooms/1.jpg"
                  class="card-img-top"
                  alt="Room Image"
                />
                <div class="card-body">
                  <h5 class="card-title">Simple Room name</h5>
                  <h6 class="mb-4">&#8377;200 per night</h6>
                  <div class="features mb-4">
                    <h6 class="mb-1">Features</h6>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      2 Rooms
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      1 Bathroom
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      1 Balcony
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      3 Sofa
                    </span>
                  </div>
                  <div class="facilities mb-4">
                    <h6 class="mb-1">Facilities</h6>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Wi-Fi
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Television
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      AC
                    </span>
                    <span
                      class="badge rounded-pill bg-light text-dark text-wrap"
                    >
                      Room Heater
                    </span>
                  </div>
                  <div class="rating mb-4">
                    <h6 class="mb-1">Ratings</h6>
                    <span class="badge rounded-pill bg-light">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                    </span>
                  </div>
                  <div class="d-flex justify-content-evenly mb-2">
                    <a
                      href="#"
                      class="btn btn-sm text-white custome-button shadow-none"
                      >Book Now</a
                    >
                    <a href="#" class="btn btn-sm btn-outline-dark shadow-none"
                      >More Details</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 text-center mt-5">
              <a
                href="#"
                class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none"
                >More Rooms >>>
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- ! End of Room Cards -->
      <!-- ! Our Facilities -->
      <section>
        <h2 class="mt-5 pt-4 mb-4 text-center h-font fw-bold">
          OUR FACILITIES
        </h2>
        <div class="container">
          <div class="row px-lg-0 justify-content-evenly px-md-0 px-5">
            <div
              class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3"
            >
              <img
                src="images/facilities/IMG_43553.svg"
                alt="Facilities"
                width="80px"
              />
              <h5 class="mt-3">Wi-Fi</h5>
            </div>
            <div
              class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3"
            >
              <img
                src="images/facilities/IMG_43553.svg"
                alt="Facilities"
                width="80px"
              />
              <h5 class="mt-3">Wi-Fi</h5>
            </div>
            <div
              class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3"
            >
              <img
                src="images/facilities/IMG_43553.svg"
                alt="Facilities"
                width="80px"
              />
              <h5 class="mt-3">Wi-Fi</h5>
            </div>
            <div
              class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3"
            >
              <img
                src="images/facilities/IMG_43553.svg"
                alt="Facilities"
                width="80px"
              />
              <h5 class="mt-3">Wi-Fi</h5>
            </div>
            <div
              class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3"
            >
              <img
                src="images/facilities/IMG_43553.svg"
                alt="Facilities"
                width="80px"
              />
              <h5 class="mt-3">Wi-Fi</h5>
            </div>
            <div class="col-lg-12 text-center mt-5">
              <a
                href="#"
                class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none"
                >More Facilities >>>
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- ! End of Our facilities -->

      <!-- ! Testimonials -->
      <section>
        <h2 class="mt-5 pt-4 mb-4 text-center h-font fw-bold">Testimonial</h2>
        <div class="container">
          <div class="swiper swiper-testimonial">
            <div class="swiper-wrapper mb-5">
              <div class="swiper-slide bg-white p-4" style="display: block">
                <div class="profile d-flex align-items-center mb-3">
                  <img
                    src="./images/facilities/IMG_27079.svg"
                    alt=""
                    style="width: 30px"
                  />
                  <h6 class="m-0 ms-2">Randome User1</h6>
                </div>
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et,
                  beatae?Lorem ipsum, dolor sit amet consectetur adipisicing
                  elit. Esse, ut.
                </p>
                <div class="rating">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>
              <div class="swiper-slide bg-white p-4" style="display: block">
                <div class="profile d-flex align-items-center mb-3">
                  <img
                    src="./images/facilities/IMG_27079.svg"
                    alt=""
                    style="width: 30px"
                  />
                  <h6 class="m-0 ms-2">Randome User1</h6>
                </div>
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et,
                  beatae?Lorem ipsum, dolor sit amet consectetur adipisicing
                  elit. Esse, ut.
                </p>
                <div class="rating">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>
              <div class="swiper-slide bg-white p-4" style="display: block">
                <div class="profile d-flex align-items-center mb-3">
                  <img
                    src="./images/facilities/IMG_27079.svg"
                    alt=""
                    style="width: 30px"
                  />
                  <h6 class="m-0 ms-2">Randome User1</h6>
                </div>
                <p>
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et,
                  beatae?Lorem ipsum, dolor sit amet consectetur adipisicing
                  elit. Esse, ut.
                </p>
                <div class="rating">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
          <div class="col-lg-12 text-center mt-5">
            <a
              href="#"
              class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none"
              >know More &gt;&gt;&gt;
            </a>
          </div>
        </div>
      </section>

      <!-- ! Reach Us  -->
      <section>
        <h2 class="mt-5 pt-4 mb-4 text-center h-font fw-bold">REACH US</h2>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
              <iframe
                class="w-100 rounded"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59286.189511497665!2d72.12112333121826!3d21.765284248894506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f5081abb84e2f%3A0xf676d64c6e13716c!2sBhavnagar%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1743500016069!5m2!1sen!2sin"
                height="450"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
            <div class="col-lg-4 col-md-4 bg-white p-5">
              <div class="bg-white p-4 mb-4 rounded">
                <h5>Call Us</h5>
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
              </div>
              <div class="bg-white p-4 mb-4 rounded">
                <h5>Follow Us</h5>
                <a href="#" class="d-inline-block mb-3"
                  ><span class="badge bg-light text-dark fs-6 p-2"
                    ><i class="bi bi-twitter-x me-1"></i> Twitter</span
                  >
                </a>
                <br />
                <a href="#" class="d-inline-block mb-3"
                  ><span class="badge bg-light text-dark fs-6 p-2"
                    ><i class="bi bi-facebook me-1"></i> Facebook</span
                  >
                </a>
                <br />
                <a href="#" class="d-inline-block mb-3"
                  ><span class="badge bg-light text-dark fs-6 p-2"
                    ><i class="bi bi-instagram me-1"></i> Instagram</span
                  >
                </a>
                <br />
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer>
      <div class="container-fluid bg-white mt-5">
        <div class="row">
          <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2">TJ HOTEL</h3>
            <p>&copy;All Rights Reserved</p>
          </div>
          <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a
              href="#"
              class="d-inline-block text-decoration-none mb-2 text-dark"
              >Home</a
            ><br />
            <a
              href="#"
              class="d-inline-block text-decoration-none mb-2 text-dark"
              >Rooms</a
            ><br />
            <a
              href="#"
              class="d-inline-block text-decoration-none mb-2 text-dark"
              >Facilities</a
            ><br />
            <a
              href="#"
              class="d-inline-block text-decoration-none mb-2 text-dark"
              >Contact Us</a
            ><br />
            <a
              href="#"
              class="d-inline-block text-decoration-none mb-2 text-dark"
              >About</a
            ><br />
          </div>
          <div class="col-lg-4 p-4">
            <h5>Follow Us</h5>
            <a
              href="#"
              class="d-inline-block mb-2 text-dark text-decoration-none"
              ><i class="bi bi-twitter-x me-1"></i> Twitter
            </a>
            <br />
            <a
              href="#"
              class="d-inline-block mb-2 text-dark text-decoration-none"
              ><i class="bi bi-facebook me-1"></i> Facebook
            </a>
            <br />
            <a
              href="#"
              class="d-inline-block mb-2 text-dark text-decoration-none"
              ><i class="bi bi-instagram me-1"></i> Instagram
            </a>
            <br />
          </div>
        </div>
      </div>
    </footer>
    <!-- ! Bootstrap javascript -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <!-- ! Slider js Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- ! Swiper.js link -->
    <script src="./js/swiper.js"></script>
    <!-- ! Testimonial Swiper -->
    <script src="./js/swiper-testimonial.js"></script>
  </body>
</html>
