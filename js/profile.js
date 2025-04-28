let info_form = document.getElementById("info-form");
info_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let data = new FormData();
  data.append("info_form", "");
  data.append("name", info_form.elements["name"].value);
  data.append("phonenum", info_form.elements["phonenum"].value);
  data.append("dob", info_form.elements["dob"].value);
  data.append("pincode", info_form.elements["pincode"].value);
  data.append("address", info_form.elements["address"].value);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/profile_crud.php", true);
  xhr.onload = function () {
    console.log(typeof this.responseText);
    if (this.responseText == "phone_already") {
      alert("danger", "Phone Already Registered!!");
    } else if (this.responseText == 0) {
      alert("danger", "No Changes Made");
    } else {
      alert("success", "Changes Saved");
      window.location.href = "profile.php";
    }
  };
  xhr.send(data);
});

let profile_form = document.getElementById("profile-form");
profile_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let data = new FormData();
  data.append("profile", profile_form.elements["profile"].files[0]);
  data.append("profile_form", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/profile_crud.php", true);

  xhr.onload = function () {
    if (this.responseText == "inv_img") {
      alert("danger", "Invalid Image Only jpeg,jpg,png or webp allowed!!");
    } else if (this.responseText == "upd_failed") {
      alert("danger", "Upload Failed");
    } else if (this.responseText == 0) {
      alert("danger", "Updation Failed");
    } else {
      window.location.href = window.location.pathname;
    }
  };
  xhr.send(data);
});

let pass_form = document.getElementById("pass-form");
pass_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let new_pass = pass_form.elements["new_pass"].value;
  let confirm_pass = pass_form.elements["confirm_pass"].value;
  if (new_pass != confirm_pass) {
    alert("Password do not match");
    return false;
  }
  let data = new FormData();
  data.append("new_pass", new_pass);
  data.append("confirm_pass", confirm_pass);
  data.append("pass_form", "");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/profile_crud.php", true);

  xhr.onload = function () {
    if (this.responseText == "mismatch") {
      alert("danger", "Password do not match!!");
    } else if (this.responseText == 0) {
      alert("danger", "Updation Failed");
    } else {
      alert("success", "Changes Saved");
      pass_form.reset();
    }
  };
  xhr.send(data);
});
