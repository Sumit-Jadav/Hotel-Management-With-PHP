let registe_form = document.getElementById("register-form");
registe_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let data = new FormData();
  data.append("name", registe_form.elements["name"].value);
  data.append("email", registe_form.elements["email"].value);
  data.append("phonenum", registe_form.elements["phonenum"].value);
  data.append("profile", registe_form.elements["profile"].files[0]);
  data.append("address", registe_form.elements["address"].value);
  data.append("pincode", registe_form.elements["pincode"].value);
  data.append("dob", registe_form.elements["dob"].value);
  data.append("pass", registe_form.elements["pass"].value);
  data.append("cpass", registe_form.elements["cpass"].value);
  data.append("register", "");
  let myModal = document.getElementById("registerModal");
  let modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/login_register.php", true);

  xhr.onload = function () {
    if (this.responseText == "pass_mismatch") {
      alert("danger", "Password Mismatch", document.get);
    } else if (this.responseText == "email_already") {
      alert("danger", "Email Already Registered!!");
    } else if (this.responseText == "phone_already") {
      alert("danger", "Phone Already Registered!!");
    } else if (this.responseText == "inv_img") {
      alert("danger", "Invalid Image!!");
    } else if (this.responseText == "upd_failed") {
      alert("danger", "Upload Failed");
    } else if (this.responseText == "mail_failed") {
      alert("danger", "Cannot send varification mail!! Server Dpwn!!!");
    } else if (this.responseText == "inv_failed") {
      alert("danger", "Phone Already Registered!!");
    } else {
      alert(
        "success",
        "Registration Successfully. Varification link send to email."
      );
      registe_form.reset();
    }
  };
  xhr.send(data);
});
