let feature_s_form = document.getElementById("feature_s_form");
// Facilities
let facilities_s_form = document.getElementById("facilities_s_form");

// Event Listners
feature_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_feature();
});

facilities_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_facility();
});

// Functions for features
function add_feature() {
  let data = new FormData();
  data.append("name", feature_s_form.elements["feature_name"].value);
  data.append("add_feature", "");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities_crud.php", true);

  xhr.onload = function () {
    let myModal = document.getElementById("feature-s");
    let modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == 1) {
      alert("success", "New Feature Added");
      feature_s_form.elements["feature_name"].value = "";
      get_features();
    } else {
      alert("danger", "Server Down!!!");
    }

    console.log(this.responseText);
  };
  xhr.send(data);
}

function get_features() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("feature-data").innerHTML = this.responseText;
  };
  xhr.send("get_features");
}

function rem_feature(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Feature Remove");
      get_features();
    } else if (this.responseText == "room_added") {
      alert("danger", "Feature is added in room");
    } else {
      alert("danger", "Server Down");
    }
  };
  xhr.send("rem_feature=" + val);
}

// Functions for facilities

function add_facility() {
  let data = new FormData();
  data.append("name", facilities_s_form.elements["facility_name"].value);
  data.append("icon", facilities_s_form.elements["facility_icon"].files[0]);
  data.append("desc", facilities_s_form.elements["facility_desc"].value);
  data.append("add_facility", "");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities_crud.php", true);

  xhr.onload = function () {
    let myModal = document.getElementById("facility-s");
    let modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == "inv_img") {
      alert("danger", "Only SVG allowed!!");
      get_general();
    } else if (this.responseText == "inv_size") {
      alert("danger", "Size should be less than 1MB!!");
    } else if (this.responseText == "upd_failed") {
      alert("danger", "Image Upload Failed");
    } else {
      alert("success", "New Facility Added");
      facilities_s_form.reset();
      get_facilities();
    }

    console.log(this.responseText);
  };
  xhr.send(data);
}

function get_facilities() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("facilities-data").innerHTML = this.responseText;
  };
  xhr.send("get_facilities");
}

function rem_facility(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/feature_facilities_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Facility Remove");
      get_facilities();
    } else if (this.responseText == "room_added") {
      alert("danger", "Facility is added in room");
    } else {
      alert("danger", "Server Down");
    }
  };
  xhr.send("rem_facility=" + val);
}

window.onload = function () {
  get_features();
  get_facilities();
};
